<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeatType;

class SeatController extends Controller
{
    public function edit(Request $request)
    {
        $seat_type = SeatType::orderBy('id')->get();
        return view('admin.pages.seat.edit', [
            'seat_type' => $seat_type,
        ]);
    }

    public function store(Request $request)
    {
        $seat_id = $request->id;
        $seat_price = $request->price;

        for($i=0; $i<count($seat_id); $i++){
            $seat = SeatType::findOrFail($seat_id[$i]);
            $seat->price = $seat_price[$i];
            $seat->save();
        }

        return response()->json(['result' => 'success']);
    }
}
