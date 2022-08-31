<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\User;
use DB, Validator, Exception, Image, URL;
use Illuminate\Support\Facades\File; 
use Auth;
use Artisan;
use Session;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return view('admin.pages.admin.index', [
            'user' => $user,
        ]);
    }
    public function store(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->has('file')) {
            $path = public_path('uploads/avatar/'.$request->id.'/');
            if(!file_exists($path)){
                File::makeDirectory($path);
            }
            $file = $request->file;
            $fileName = $file->getClientOriginalName();
            $imgx = Image::make($file->getRealPath());
            $imgx->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path.$fileName);
            $user->avatar = $fileName; 
        };
        $user->save();
        return response()->json(['result' => 'success']);
    }
    public function clear(Request $request)
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        Session::flash('success', 'Cache, route, view, config cleared successfully!');
        return back();
    }
}
