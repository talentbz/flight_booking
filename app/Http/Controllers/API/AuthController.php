<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    public function register(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',

            ]);
            if ($validator->fails()) throw new Exception($validator->errors());
            $data = $request->all();

            $exists = User::where('email', '=', $data['email'])->first();
            if ($exists) throw new Exception('Duplicated email address');

            $user = User::forceCreate([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 3
            ]);
            return response()->json([
                'success' => true,
                'data' => $user,
            ]);

        } catch (Exception $e) {
            return response()->json(array(
                'success' => false,
                'message' => $e->getMessage()
            ), 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',

            ]);
            if ($validator->fails()) throw new Exception($validator->errors());


            $data = $request->all();

            $user = User::where('email', '=', $data['email'])->first();
            if (!$user) throw new Exception('Not found user');

            if (!Hash::check($data['password'], $user->password)) throw new Exception('Not correct user');

            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
        } catch (Exception $e) {
            return response()->json(array(
                'success' => false,
                'message' => $e->getMessage()
            ), 500);
        }
    }
}
