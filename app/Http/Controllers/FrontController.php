<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class FrontController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }
}
