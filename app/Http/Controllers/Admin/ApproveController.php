<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Approve;
use Auth;
use Mail;

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
        // $pieces = explode(",", $request->in_bound);
        $schedule = Schedule::findOrFail($request->booking_schedule);
        $approve = new Approve;
        // $approve->booking_no = $request->booking_no;
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
}
