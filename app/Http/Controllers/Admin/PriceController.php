<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeatType;
use App\Models\PriceByCount;
use App\Models\PriceByDate;

class PriceController extends Controller
{
    public function countIndex(Request $request)
    {
        $by_count = PriceByCount::orderBy('id')->get();
        return view('admin.pages.price.byCount.index', [
            'by_count' => $by_count,
        ]);
    }
    
    public function countStore(Request $request)
    {
        $by_count = PriceByCount::where('id', $request->id)
                                ->update([
                                    'percentage' => $request->percentage,
                                ]);
        return response()->json(['result' => 'success']);
    }
    public function statusChange(Request $request)
    {
        $by_count = PriceByCount::where('id', $request->id)
                                ->update([
                                    'status' => $request->status,
                                ]);
        return response()->json(['result' => 'success']);
    }
}
