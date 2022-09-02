<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        // $by_count = PriceByCount::orderBy('id')->get();
        return view('admin.pages.booking.create', [
            // 'by_count' => $by_count,
        ]);
    }
}
