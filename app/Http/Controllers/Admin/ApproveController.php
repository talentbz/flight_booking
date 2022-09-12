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
        $approve->start_seat = json_encode(explode( ",", $request->in_bound ));
        $approve->start_date = $schedule->departure_date;
        $approve->return_seat = json_encode(explode( ",", $request->out_bound ));
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
        Mail::send('mail', array(
            // 'is_contact'  =>'off',
            // 'vehicle_name' => $request->get('vehicle_name'),
            // 'fob_price' => $request->get('fob_price'),
            // 'inspection' => $request->get('inspection'),
            // 'insurance' => $request->get('insurance'),
            // 'inqu_port' => $request->get('inqu_port'),
            // 'total_price' => $request->get('total_price'),
            // 'site_url' => $request->get('site_url'),
            // 'inqu_name' => $request->get('inqu_name'),
            // 'inqu_country' => $request->get('inqu_country'),
            // 'inqu_email' => $request->get('inqu_email'),
            // 'inqu_address' => $request->get('inqu_address'),
            // 'inqu_mobile' => $request->get('inqu_mobile'),
            // 'inqu_city' => $request->get('inqu_city'),
            // 'inqu_comment' => $request->get('inqu_comment'),
        ), function($message) use ($request){
            $message->from('test@topkidghana.net');
            $message->to('vadim.progev@gmail.com', 'Inquiry - Sakura')
                    ->subject('Inquiry - Sakura');
        }); 
        $approve = Approve::where('id', $request->id)
                                ->update([
                                    'status' => toBoolean($request->status),
                                ]);

        
        return response()->json(['result' => 'success']);
    }

    public function count(Request $request)
    {
        $approve_count = count(Approve::get());
        return response()->json(['count' => $approve_count]);
    }
}
