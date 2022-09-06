<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\SeatType;
use App\Models\PriceByDate;
use App\Models\Booking;
use App\Models\AirLine;
use Carbon\Carbon;


class BookingController extends Controller
{
    public function index(Request $request)
    {
        // $user = Auth::user();
        return view('admin.pages.booking.index', [
            // 'user' => $user,
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
        dd($request->all());
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
        $get_seat = Booking::where('start_date', $schedule->departure_date)->get();
        $bussiness_seat = [];
        $economy_seat = [];
        $percentage = 0;
        $total_seat_number = [];
        $trip_type = $request->trip_type;
        if($trip_type == "inRound"){
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
