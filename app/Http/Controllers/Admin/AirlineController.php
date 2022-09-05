<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AirLine;

class AirlineController extends Controller
{
    public function index(Request $request)
    {
        $airline = AirLine::get();
        return view('admin.pages.airline.index', [
            'airline' => $airline,
        ]);
    }
    public function create(Request $request)
    {
        return view('admin.pages.airline.create', [
            // 'airline' => $airline,
        ]);
    }
    public function edit(Request $request, $id)
    {
        $airline = AirLine::where('id', $id)->first();
        return view('admin.pages.airline.edit', [
            'airline' => $airline,
        ]);
    }

    public function update(Request $request, $id)
    {
        $airline = AirLine::where('id', $id)->first();
        $airline->name = $request->name;
        $airline->save();
        return response()->json(['result' => 'success']);
    }

    public function store(Request $request){
        $airline = new AirLine;
        $airline->name = $request->name;
        $airline->save();
        return response()->json(['result' => 'success']);
    }

    public function status(Request $request){
        $schedule = AirLine::where('id', $request->id)
                            ->update([
                                'status' => toBoolean($request->status),
                            ]);
        return response()->json(['result' => 'success']);
    }
}
