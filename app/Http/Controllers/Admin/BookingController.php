<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\SeatType;
use App\Models\PriceByDate;
use App\Models\PriceByCount;
use App\Models\Booking;
use App\Models\Approve;
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
        //validation whether existing seat no
        $approve = Approve::where('schedule_id', $request->booking_schedule)->get();
        $outbound_seat =[];
        $inbound_seat =[];
        $booking = Booking::where('schedule_id', $request->booking_schedule)->get();
        foreach($booking as $row){
            foreach(json_decode($row->return_seat) as $return_seat){
                $inbound_seat[] = $return_seat;
            } 
            foreach(json_decode($row->start_seat) as $start_seat){
                $outbound_seat[] = $start_seat;
            }
        }
        
        if($request->payment_method != 3){ // if payment method is cash, then remove approve
            foreach($approve as $row){
                foreach(json_decode($row->return_seat) as $return_seat){
                    $inbound_seat[] = $return_seat;
                } 
                foreach(json_decode($row->start_seat) as $start_seat){
                    $outbound_seat[] = $start_seat;
                }
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
        $booking->outbound_bussiness_cost = $request->outbound_bussiness_seat;
        $booking->outbound_economy_cost = $request->outbound_economy_seat;
        $booking->inbound_bussiness_cost = $request->inbound_bussiness_seat;
        $booking->inbound_economy_cost = $request->inbound_economy_seat;
        $booking->baggage_count = $request->extra_bag;
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
        $bussiness_seat_percent = 0;
        $economy_seat_percent = 0;
        $percentage = 0;
        $total_seat_number = [];
        $trip_type = $request->trip_type;
        if($trip_type == "outBound"){
            $get_booking_seat = Booking::where('start_date', $schedule->departure_date)->get();
            $get_aprove_seat = Approve::where('start_date', $schedule->departure_date)->get();
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
            foreach($get_booking_seat as $row){
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

            foreach($get_aprove_seat as $row){
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
            $economy_seat_count = count($economy_seat);
            $bussiness_by_count = PriceByCount::where('min_count', '<=', $bussiness_seat_count)
                                                ->where('max_count', '>=', $bussiness_seat_count)  
                                                ->where('status', 1)
                                                ->where('seat_type_id', 1)
                                                ->where('status', 1)
                                                ->first();
            $economy_by_count = PriceByCount::where('min_count', '<=', $economy_seat_count)
                                                ->where('max_count', '>=', $economy_seat_count)  
                                                ->where('status', 1)
                                                ->where('seat_type_id', 2)
                                                ->where('status', 1)
                                                ->first();
            $bussiness_seat_percent = $bussiness_by_count->percentage;
            $economy_seat_percent = $economy_by_count->percentage;

        } else {
            $get_booking_seat = Booking::where('return_date', $schedule->return_date)->get();
            $get_aprove_seat = Approve::where('return_date', $schedule->return_date)->get();
            $return_date = Carbon::parse($schedule->return_date);
            $return_diff=$current_date->diffInDays($return_date);
            foreach($price_by_date as $row){
                if($return_diff == $row->date){
                    $percentage = $row->percentage;
                    break;
                }
            }
            foreach($get_booking_seat as $row){
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
            foreach($get_aprove_seat as $row){
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
            $economy_seat_count = count($economy_seat);
            $bussiness_by_count = PriceByCount::where('min_count', '<=', $bussiness_seat_count)
                                                ->where('max_count', '>=', $bussiness_seat_count)  
                                                ->where('status', 1)
                                                ->where('seat_type_id', 1)
                                                ->where('status', 1)
                                                ->first();
            $economy_by_count = PriceByCount::where('min_count', '<=', $economy_seat_count)
                                                ->where('max_count', '>=', $economy_seat_count)  
                                                ->where('status', 1)
                                                ->where('seat_type_id', 2)
                                                ->where('status', 1)
                                                ->first();
            $bussiness_seat_percent = $bussiness_by_count->percentage;
            $economy_seat_percent = $economy_by_count->percentage;
             
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
