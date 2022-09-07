<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB, Validator, Exception, Image, URL, File;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::get();
        return view('admin.pages.user.index', [
            'user' => $user,
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.pages.user.create', [
            // 'user' => $user,
        ]);
    }
    
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.user.edit', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required | unique:users',
        ]);
        $attributeNames = array(
            'email' => 'email',
        );
        $validator->setAttributeNames($attributeNames);
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        if ($request->has('file')) {
            $path = public_path('uploads/user/');
            if(!file_exists($path)){
                File::makeDirectory($path);
            }
            $file = $request->file;
            $fileName = time().'_'.$file->getClientOriginalName();
            $imgx = Image::make($file->getRealPath());
            $imgx->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path.$fileName);
            $user->avatar = $fileName; 
        };
        $user->save();
        return response()->json(['result' => 'success']);

    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        if ($request->has('file')) {
            $path = public_path('uploads/user/');
            if(!file_exists($path)){
                File::makeDirectory($path);
            }
            $file = $request->file;
            $fileName = time().'_'.$file->getClientOriginalName();
            $imgx = Image::make($file->getRealPath());
            $imgx->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path.$fileName);
            $user->avatar = $fileName; 
        };
        $user->save();
        return response()->json(['result' => 'success']);
    }

    public function status(Request $request)
    {
        User::where('id', $request->id)->update(['status' => toBoolean($request->status)]);
        return response()->json(['result' => 'success']);
    }

    public function resetPassword(Request $request, $id)
    {
        User::where('id', $id)->update(['password' => Hash::make($request->password)]);
        return response()->json(['result' => 'success']);
    }
}
