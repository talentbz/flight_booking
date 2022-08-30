<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedule = Schedule::orderBy('id')->get();
        return view('admin.pages.schedule.index', [
            'schedule' => $schedule,
        ]);
    }
    public function create(Request $request)
    {
        // $by_count = PriceByCount::orderBy('id')->get();
        return view('admin.pages.schedule.create', [
            // 'by_count' => $by_count,
        ]);
    }
    public function store(Request $request)
    {
        $schedule = new Schedule;
        $schedule->departure_date = $request->departure_date;
        $schedule->departure_time = $request->departure_time;
        $schedule->return_date = $request->return_date;
        $schedule->return_time = $request->return_time;
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
        $schedule = Schedule::where('id', $id)->first();
        return view('admin.pages.schedule.edit', [
            'schedule' => $schedule,
        ]);
    }
    public function update(Request $request, $id)
    {
        $schedule = Schedule::where('id', $id)->first();
        $schedule->departure_date = $request->departure_date;
        $schedule->departure_time = $request->departure_time;
        $schedule->return_date = $request->return_date;
        $schedule->return_time = $request->return_time;
        $schedule->save();
        return response()->json(['result' => 'success']);
    }
}
