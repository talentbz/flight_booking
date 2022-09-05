<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\AirLine;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedule = Schedule::leftJoin('air_lines', 'schedules.airline_id', 'air_lines.id')
                            ->select("schedules.*", "air_lines.name")->get();                   
        return view('admin.pages.schedule.index', [
            'schedule' => $schedule,
        ]);
    }
    public function create(Request $request)
    {
        $airline = AirLine::where('status', 1)->get();
        return view('admin.pages.schedule.create', [
            'airline' => $airline,
        ]);
    }
    public function store(Request $request)
    {
        $schedule = new Schedule;
        $schedule->departure_date = $request->departure_date;
        $schedule->departure_time = $request->departure_time;
        $schedule->return_date = $request->return_date;
        $schedule->return_time = $request->return_time;
        $schedule->airline_id = $request->airline;
        $schedule->save();
        return response()->json(['result' => 'success']);
    }
    public function status(Request $request)
    {
        $schedule = Schedule::where('id', $request->id)
                                ->update([
                                    'status' => toBoolean($request->status),
                                ]);
        return response()->json(['result' => 'success']);
    }
    public function edit(Request $request, $id)
    {
        $airline = AirLine::get();
        $schedule = Schedule::where('id', $id)->first();
        return view('admin.pages.schedule.edit', [
            'schedule' => $schedule,
            'airline' => $airline,
        ]);
    }
    public function update(Request $request, $id)
    {
        $schedule = Schedule::where('id', $id)->first();
        $schedule->departure_date = $request->departure_date;
        $schedule->departure_time = $request->departure_time;
        $schedule->return_date = $request->return_date;
        $schedule->return_time = $request->return_time;
        $schedule->airline_id = $request->airline;
        $schedule->save();
        return response()->json(['result' => 'success']);
    }
}
