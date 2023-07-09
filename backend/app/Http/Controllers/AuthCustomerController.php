<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class AuthCustomerController extends Controller
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|max:50|string',
            'last_name' => 'required|max:50|string',
            'phone' => 'string|required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        return DB::transaction(function () use ($data) {
            $data['password'] = bcrypt($data['password']);
            $customer = Customer::create($data);
            $user = User::create([
                'customer_id' => $customer->id,
                'email' => $data['email'],
                'password' => $data['password']
            ])->makeHidden('password');
            $token = $user->createToken('main')->plainTextToken;
            return response()->json([
                'result' => 'ok',
                'token' => $token,
                'new_customer' => $user
            ], 200);
        });
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required'
            ],
            // 'remember' => 'boolean'
        ]);
        // unset($credentials['remember']);
        if (!Auth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'msg' => "Xác thực không thành công."
            ], 422);
        }
        $user =  Auth::user();
        $token = $user->createToken('customer')->plainTextToken;
        return response()->json([
            'result' => 'ok',
            'info' => $user->customer,
            'token' => $token,
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['result' => 'ok']);
    }
}
