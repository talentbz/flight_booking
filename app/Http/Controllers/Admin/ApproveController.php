<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Approve;
use App\Models\Baggage;
use App\Models\Booking;
use Illuminate\Support\Facades\File; 
use Auth;
use Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ApproveController extends Controller
{
    public function index(Request $request)
    {
        // dd(array_merge($a1,$a2));
        $approve = Approve::leftJoin('users', 'users.id', 'approves.created_by')
                              ->leftJoin('air_lines', 'air_lines.id', 'approves.air_line')
                              ->select('approves.*', 'users.name', 'air_lines.name as air_line_name')->get(); 
        return view('admin.pages.approve.index', [
            'approve' => $approve,
        ]);
    }
    public function store(Request $request)
    {
        //validation whether existing seat no
        $approve = Approve::where('schedule_id', $request->booking_schedule)->get();
        $outbound_seat =[];
        $inbound_seat =[];
        foreach($approve as $row){
            foreach(json_decode($row->return_seat) as $return_seat){
                $inbound_seat[] = $return_seat;
            } 
            foreach(json_decode($row->start_seat) as $start_seat){
                $outbound_seat[] = $start_seat;
            }
        }
        $booking = Booking::where('schedule_id', $request->booking_schedule)->get();
        foreach($booking as $row){
            foreach(json_decode($row->return_seat) as $return_seat){
                $inbound_seat[] = $return_seat;
            } 
            foreach(json_decode($row->start_seat) as $start_seat){
                $outbound_seat[] = $start_seat;
            }
        }
        $request_outbound_seat = explode( ",", $request->out_bound );
        $request_inbound_seat = explode( ",", $request->in_bound );
        foreach($request_outbound_seat as $row){
            if(in_array($row, $outbound_seat) == true){
                return response()->json(['result' => 'exist']);
            }
        }

        foreach($request_inbound_seat as $row){
            if(in_array($row, $inbound_seat) == true){
                return response()->json(['result' => 'exist']);
            }
        }

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
        $file = $this->pdfCreate($request->id);
        Mail::send('mail', array(
            'cost' => $aprove->cost,
            'agent_name' => $aprove->name,
            'agent_no' => $aprove->created_by,
            'outbound_seat' => json_decode($aprove->start_seat),
            'inbound_seat' => json_decode($aprove->return_seat),
        ), function($message) use ($aprove, $file){
            $message->from(env("MAIL_USERNAME"));
            $message->to($aprove->user_email, 'Booking Invoice')
                    ->subject('Booking Invoice');
            $message->attach($file);
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
    
    function pdfCreate($id)
    {
        $aprove = Approve::leftJoin('users', 'approves.created_by', 'users.id')
                         ->where('approves.id', $id)
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
        $bussiness_seat = [];
        $economy_seat = [];
        $outbound_seat = json_decode($aprove->start_seat);
        foreach($outbound_seat as $row){
            $get_first_number = intval(substr($row, 0, -1));
            if($get_first_number > 0 && $get_first_number < 10){
                array_push($bussiness_seat, $row);
                array_push($outbound_bussiness_seat, $row);
            } else {
                array_push($economy_seat, $row);
                array_push($outbound_economy_seat, $row);
            }
        }
        
        $inbound_seat = json_decode($aprove->return_seat);
        foreach($inbound_seat as $row){
            $get_first_number = intval(substr($row, 0, -1));
            if($get_first_number > 0 && $get_first_number < 10){
                array_push($inbound_bussiness_seat, $row);
                array_push($bussiness_seat, $row);
            } else {
                array_push($inbound_economy_seat, $row);
                array_push($economy_seat, $row);
            }
        }
        
        $bussiness_seat_count = count($outbound_bussiness_seat) + count($inbound_bussiness_seat);
        $economy_seat_count = count($outbound_economy_seat) + count($inbound_economy_seat);
        $bussiness_seat_price = count($outbound_bussiness_seat) * $outbound_bussiness_price + count($inbound_bussiness_seat) * $inbound_bussiness_price;
        $economy_seat_price = count($outbound_economy_seat) * $outbound_economy_price + count($inbound_economy_seat) * $inbound_economy_price;
        
        $baggage = Baggage::first();
        $baggage_price = $baggage->price * $aprove->baggage_count; 

        $pdf = PDF::loadView('admin.pages.approve.invoice', [
            'bussiness_seat' => $bussiness_seat,
            'economy_seat' => $economy_seat,
            'bussiness_seat_count' => $bussiness_seat_count,
            'economy_seat_count' => $economy_seat_count,
            'bussiness_seat_price' => $bussiness_seat_price,
            'economy_seat_price' => $economy_seat_price,
            'extra_bag' => $aprove->baggage_count,
            'baggage_price' => $baggage_price,
            'total_cost' => $total_cost,
            'user_name' => $aprove->name,
            'user_id' => $aprove->created_by,
        ]);
        $path = public_path('uploads/pdf/');
        if(!file_exists($path)){
            File::makeDirectory($path, $mode = 0755, true, true);
        }
        $fileName = time().'.pdf';
        $file = $path . '/' . $fileName;
        $pdf->save($file);
        return $file;
    }

    public function pdfView(Request $request)
    {
        $user =1 ;
        return view('admin.pages.approve.invoice', [
            'user' => $user,
        ]);
    }
}
