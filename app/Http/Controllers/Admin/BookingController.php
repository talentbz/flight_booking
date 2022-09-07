<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\SeatType;
use App\Models\PriceByDate;
use App\Models\Booking;
use App\Models\AirLine;
use App\Models\User;
use Carbon\Carbon;
use Auth;


class BookingController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $role = User::find($user_id);
        if($role->role == 1) {
            $booking = Booking::get(); 
        } else {
            $booking = Booking::where('created_by', $user_id)->get();
        }
        return view('admin.pages.booking.index', [
            'booking' => $booking,
        ]);
    }

    public function create(Request $request)
    {
        $schedule = Schedule::where('status', 1)->get();
        $seat_type = SeatType::get();
        $airline = AirLine::where('status', 1)->get();
        $price_by_date = PriceByDate::where('status', 1)->get();
        return view('admin.pages.booking.create', [
            'schedule' => $schedule,
            'seat_type' => $seat_type,
            'airline' => $airline,
        ]);
    }
    public function store(Request $request)
    {
        // $pieces = explode(",", $request->in_bound);
        $schedule = Schedule::findOrFail($request->booking_schedule);
        $booking = new Booking;
        $booking->booking_no = $request->booking_no;
        $booking->air_line = $request->air_line;
        $booking->schedule_id = $request->booking_schedule;
        $booking->trip_type = $request->trip_type;
        $booking->start_seat = json_encode(explode( ",", $request->in_bound ));
        $booking->start_date = $schedule->departure_date;
        $booking->return_seat = json_encode(explode( ",", $request->out_bound ));
        $booking->return_date = $schedule->return_date;
        $booking->user_email = $request->user_email;
        $booking->user_name = $request->user_name;
        $booking->phone = $request->user_phone;
        $booking->cost = $request->total_price;
        $booking->payment_type = $request->payment_method;
        $booking->payment_status = 1;
        $booking->created_by = Auth::id();
        $booking->save();
        return response()->json(['result' => 'success']);
    }
    public function schedule(Request $request)
    {
        $schedule = Schedule::where('status', 1)->where('airline_id', $request->airline_id)->get();
        return response()->json(['data' =>$schedule]);
    }

    public function seatMap(Request $request)
    {
        /*
        | add percentage by date and seat count 
        |
        */
        $current_date = Carbon::parse(Carbon::now()->format('Y-m-d'));
        $schedule = Schedule::findOrFail($request->shedule_id);
        $price_by_date = PriceByDate::where('status', 1)->get();
        $seat_type = SeatType::get();
        $bussiness_seat = [];
        $economy_seat = [];
        $percentage = 0;
        $total_seat_number = [];
        $trip_type = $request->trip_type;
        if($trip_type == "inBound"){
            $get_seat = Booking::where('start_date', $schedule->departure_date)->get();
            $departure_date = Carbon::parse($schedule->departure_date);
            $departure_diff=$current_date->diffInDays($departure_date);
            foreach($price_by_date as $row){
                if($departure_diff == $row->date){
                    $percentage = $row->percentage;
                    break;
                }
            }
            foreach($get_seat as $row){
                $seats = json_decode($row->start_seat);
                foreach($seats as $seat){
                    //scrape first string for trip type
                    $get_first_number = intval(substr($seat, 0, -1));
                    array_push($total_seat_number, $get_first_number);
                    if($get_first_number > 0 && $get_first_number < 10){
                        array_push($bussiness_seat, $seat);
                    } else {
                        array_push($economy_seat, $seat);
                    }
                }
            }
            // dd($bussiness_seat);
        } else {
            $get_seat = Booking::where('return_date', $schedule->return_date)->get();
            $return_date = Carbon::parse($schedule->return_date);
            $return_diff=$current_date->diffInDays($return_date);
            foreach($price_by_date as $row){
                if($return_diff == $row->date){
                    $percentage = $row->percentage;
                    break;
                }
            }
            foreach($get_seat as $row){
                $seats = json_decode($row->return_seat);
                foreach($seats as $seat){
                    //scrape first string for trip type
                    $get_first_number = intval(substr($seat, 0, -1));
                    array_push($total_seat_number, $get_first_number);
                    if($get_first_number > 0 && $get_first_number < 10){
                        array_push($bussiness_seat, $seat);
                    } else {
                        array_push($economy_seat, $seat);
                    }
                }
            }
        }
        return view('admin.pages.booking.seatmap', [
            'percentage' => $percentage, 
            'bussiness_seat' => $bussiness_seat,
            'economy_seat' => $economy_seat,
            'seat_type' => $seat_type,
            'total_seat_number' => $total_seat_number,
            'trip_type' => $trip_type
        ]);
    }
}
