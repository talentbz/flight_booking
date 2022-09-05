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

    public function schedule(Request $request)
    {
        $schedule = Schedule::where('status', 1)->where('airline_id', $request->airline_id)->get();
        return response()->json(['data' =>$schedule]);
    }

    public function seatMap(Request $request)
    {
        $current_date = Carbon::parse(Carbon::now()->format('Y-m-d'));
        $schedule = Schedule::findOrFail($request->shedule_id);
        $price_by_date = PriceByDate::where('status', 1)->get();
        if($request->date_type == "start"){
            $departure_date = Carbon::parse($schedule->departure_date);
            $departure_diff=$current_date->diffInDays($departure_date);
            $percentage = 0;
            foreach($price_by_date as $row){
                if($departure_diff == $row->date){
                    $percentage = $row->percentage;
                    break;
                }
            }
            
            $booking = Booking::get();
        }
        
        //extra price
        
    }
}
