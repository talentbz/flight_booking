<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Approve;
use Illuminate\Support\Facades\File; 
use Auth;
use Mail, PDF;

class ApproveController extends Controller
{
    public function index(Request $request)
    {
        $approve = Approve::leftJoin('users', 'users.id', 'approves.created_by')
                              ->leftJoin('air_lines', 'air_lines.id', 'approves.air_line')
                              ->select('approves.*', 'users.name', 'air_lines.name as air_line_name')->get(); 
        return view('admin.pages.approve.index', [
            'approve' => $approve,
        ]);
    }
    public function store(Request $request)
    {
        $schedule = Schedule::findOrFail($request->booking_schedule);
        $approve = new Approve;
        $approve->air_line = $request->air_line;
        $approve->schedule_id = $request->booking_schedule;
        $approve->trip_type = $request->trip_type;
        $approve->start_seat = json_encode(explode( ",", $request->out_bound ));
        $approve->start_date = $schedule->departure_date;
        $approve->return_seat = json_encode(explode( ",", $request->in_bound ));
        $approve->return_date = $schedule->return_date;
        $approve->user_email = $request->user_email;
        $approve->user_name = $request->user_name;
        $approve->phone = $request->user_phone;
        $approve->cost = $request->total_price;
        $approve->outbound_bussiness_cost = $request->outbound_bussiness_seat;
        $approve->outbound_economy_cost = $request->outbound_economy_seat;
        $approve->inbound_bussiness_cost = $request->inbound_bussiness_seat;
        $approve->inbound_economy_cost = $request->inbound_economy_seat;
        $approve->baggage_count = $request->extra_bag;
        $approve->payment_type = $request->payment_method;
        $approve->payment_status = 1;
        $approve->created_by = Auth::id();
        $approve->save();
        return response()->json(['result' => 'success']);
    }

    public function status(Request $request)
    {
        $aprove = Approve::leftJoin('users', 'approves.created_by', 'users.id')
                         ->where('approves.id', $request->id)
                         ->select('approves.*', 'users.name')
                         ->first();
        Mail::send('mail', array(
            'cost' => $aprove->cost,
            'agent_name' => $aprove->name,
            'agent_no' => $aprove->created_by,
            'outbound_seat' => json_decode($aprove->start_seat),
            'inbound_seat' => json_decode($aprove->return_seat),
        ), function($message) use ($aprove){
            $message->from(env("MAIL_USERNAME"));
            $message->to($aprove->user_email, 'Booking Invoice')
                    ->subject('Booking Invoice');
        }); 

        $approve = Approve::where('id', $request->id)
                                ->update([
                                    'status' => toBoolean($request->status),
                                ]);

        
        return response()->json(['result' => 'success']);
    }

    public function count(Request $request)
    {
        $approve_count = count(Approve::where('status', 0)->get());
        return response()->json(['count' => $approve_count]);
    }
    
    public function pdfCreate(Request $request)
    {
        $aprove = Approve::leftJoin('users', 'approves.created_by', 'users.id')
                         ->where('approves.id', 1)
                         ->select('approves.*', 'users.name')
                         ->first();
        $outbound_bussiness_price = $aprove->outbound_bussiness_cost;
        $outbound_economy_price = $aprove->outbound_economy_cost;
        $inbound_bussiness_price = $aprove->inbound_bussiness_cost;
        $inbound_economy_price = $aprove->inbound_economy_cost;
        $total_cost = $aprove->cost;
        // $seats = json_decode($row->start_seat);
        $outbound_bussiness_seat = [];
        $outbound_economy_seat = [];
        $inbound_bussiness_seat = [];
        $inbound_economy_seat = [];
        $outbound_seat = json_decode($aprove->start_seat);
        foreach($outbound_seat as $row){
            $get_first_number = intval(substr($row, 0, -1));
            if($get_first_number > 0 && $get_first_number < 10){
                array_push($outbound_bussiness_seat, $row);
            } else {
                array_push($outbound_economy_seat, $row);
            }
        }
        
        $inbound_seat = json_decode($aprove->return_seat);
        foreach($inbound_seat as $row){
            $get_first_number = intval(substr($row, 0, -1));
            if($get_first_number > 0 && $get_first_number < 10){
                array_push($inbound_bussiness_seat, $row);
            } else {
                array_push($inbound_economy_seat, $row);
            }
        }
        $bussiness_seat_count = count($outbound_bussiness_seat) + count($inbound_bussiness_seat);
        $economy_seat_count = count($outbound_economy_seat) + count($inbound_economy_seat);
        $bussiness_seat_price = count($outbound_bussiness_seat) * $outbound_bussiness_price + count($inbound_bussiness_seat) * $inbound_bussiness_price;
        $economy_seat_price = count($outbound_economy_seat) * $outbound_economy_price + count($inbound_economy_seat) * $inbound_economy_price;
        
        $pdf = PDF::loadView('admin.pages.approve.invoice', [
            'bussiness_seat_count' => $bussiness_seat_count,
            'economy_seat_count' => $economy_seat_count,
            'bussiness_seat_price' => $bussiness_seat_price,
            'economy_seat_price' => $economy_seat_price,
            'extra_bag' => $aprove->baggage_count,
            'total_cost' => $total_cost,
            'user_name' => $aprove->name,
            'user_id' => $aprove->created_by,
        ]);
        $path = public_path('uploads/pdf/');
        if(!file_exists($path)){
            File::makeDirectory($path, $mode = 0755, true, true);
        }
        $fileName = time().'.pdf';
        $pdf->save($path . '/' . $fileName);

    }

    public function pdfView(Request $request)
    {
        $user =1 ;
        return view('admin.pages.approve.invoice', [
            'user' => $user,
        ]);
    }
}
