<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\SeatType;
use App\Models\PriceByDate;
use App\Models\PriceByCount;
use App\Models\Booking;
use App\Models\AirLine;
use App\Models\User;
use App\Models\Baggage;
use Carbon\Carbon;
use Auth;


class BookingController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $role = User::find($user_id);
        if($role->role == 1) {
            $booking = Booking::leftJoin('users', 'users.id', 'bookings.created_by')
                              ->leftJoin('air_lines', 'air_lines.id', 'bookings.air_line')
                              ->select('bookings.*', 'users.name', 'air_lines.name as air_line_name')->get(); 
        } else {
            $booking = Booking::leftJoin('users', 'users.id', 'bookings.created_by')
                              ->leftJoin('air_lines', 'air_lines.id', 'bookings.air_line')
                              ->where('bookings.created_by', $user_id)
                              ->select('bookings.*', 'users.name', 'air_lines.name as air_line_name')
                              ->get();
        }
        // dd(json_decode($booking[0]->return_seat));
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
        $bag = Baggage::first();
        return view('admin.pages.booking.create', [
            'schedule' => $schedule,
            'seat_type' => $seat_type,
            'airline' => $airline,
            'bag' => $bag,
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
        $booking->start_seat = json_encode(explode( ",", $request->out_bound ));
        $booking->start_date = $schedule->departure_date;
        $booking->return_seat = json_encode(explode( ",", $request->in_bound ));
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
        $price_by_count = PriceByCount::get();
        $seat_type = SeatType::get();
        $bussiness_seat = [];
        $economy_seat = [];
        $bussiness_seat_percent = 0;
        $economy_seat_percent = 0;
        $percentage = 0;
        $total_seat_number = [];
        $trip_type = $request->trip_type;
        if($trip_type == "outBound"){
            $get_seat = Booking::where('start_date', $schedule->departure_date)->get();
            $departure_date = Carbon::parse($schedule->departure_date);
            $departure_diff=$current_date->diffInDays($departure_date);

            //get percetage by date
            foreach($price_by_date as $row){
                if($departure_diff == $row->date){
                    $percentage = $row->percentage;
                    break;
                }
            }

            // get exsiting seat
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

            //get percetage by bussiness seat count
            $bussiness_seat_count = count($bussiness_seat);
            // $test = PriceByCount::where('min_count', '>=', 0)
            //                     ->where('max_count', '<=', 0)  
            //                     ->where('status', 1)
            //                     ->where('seat_type_id', 1)
            //                     ->get();
            //      dd($test);       
            if($bussiness_seat_count > 10 && $bussiness_seat_count <= 20){
                $bussiness_seat_percent = $price_by_count[1]->percentage;
            } else if($bussiness_seat_count > 20 && $bussiness_seat_count <= 30){
                $bussiness_seat_percent = $price_by_count[2]->percentage;
            } else {
                $bussiness_seat_percent = $price_by_count[0]->percentage;
            }

             //get percetage by economy seat count
             $economy_seat_percent = count($economy_seat);
             if($economy_seat_percent > 40 && $economy_seat_percent <= 90){
                 $economy_seat_percent = $price_by_count[4]->percentage;
             } else if($economy_seat_percent > 90 && $economy_seat_percent <= 140){
                 $economy_seat_percent = $price_by_count[5]->percentage;
             } else if($economy_seat_percent > 141 && $economy_seat_percent <= 190){
                 $economy_seat_percent = $price_by_count[6]->percentage;
             } else {
                $economy_seat_percent = $price_by_count[3]->percentage;
             }

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

            //get percetage by bussiness seat count
            $bussiness_seat_count = count($bussiness_seat);
            if($bussiness_seat_count > 10 && $bussiness_seat_count <= 20){
                $bussiness_seat_percent = $price_by_count[1]->percentage;
            } else if($bussiness_seat_count > 20 && $bussiness_seat_count <= 30){
                $bussiness_seat_percent = $price_by_count[2]->percentage;
            } else {
                $bussiness_seat_percent = $price_by_count[0]->percentage;
            }

             //get percetage by economy seat count
             $economy_seat_percent = count($economy_seat);
             if($economy_seat_percent > 40 && $economy_seat_percent <= 90){
                 $economy_seat_percent = $price_by_count[4]->percentage;
             } else if($economy_seat_percent > 90 && $economy_seat_percent <= 140){
                 $economy_seat_percent = $price_by_count[5]->percentage;
             } else if($economy_seat_percent > 141 && $economy_seat_percent <= 190){
                 $economy_seat_percent = $price_by_count[6]->percentage;
             } else {
                $economy_seat_percent = $price_by_count[3]->percentage;
             }
             
        }
        $bussiness_price = (int)$seat_type[0]->price + (int)$seat_type[0]->price*(int)$percentage/100 + (int)$seat_type[0]->price*(int)$bussiness_seat_percent/100;
        $economy_price = (int)$seat_type[1]->price + (int)$seat_type[1]->price*(int)$percentage/100 + (int)$seat_type[1]->price*(int)$economy_seat_percent/100;
        
        return view('admin.pages.booking.seatmap', [
            'percentage' => (int)$percentage, 
            'bussiness_seat' => $bussiness_seat,
            'economy_seat' => $economy_seat,
            'seat_type' => $seat_type,
            'total_seat_number' => $total_seat_number,
            'trip_type' => $trip_type,
            'economy_seat_percent' => (int)$economy_seat_percent,
            'bussiness_seat_percent' => (int)$bussiness_seat_percent,
            'bussiness_price' => $bussiness_price,
            'economy_price' => $economy_price,
        ]);
    }
}
