<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class AuthCustomerController extends Controller
{
    use ApiResponses;
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|max:50|string',
            'last_name' => 'required|max:50|string',
            'phone' => 'string|required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::where(['email' => $data['email']])->first();
        if ($user && $user->customer) {
            return $this->errorResponse(['message' => 'Customer with this email already exists']);
        }
        $data = DB::transaction(function () use ($data, $user) {
            $data['password'] = bcrypt($data['password']);
            if ($user) {
                $customer = Customer::create($data);
                $user->update([
                    'customer_id' => $customer->id,
                ]);
            } else {
                $customer = Customer::create($data);
                $user = User::create([
                    'customer_id' => $customer->id,
                    'email' => $data['email'],
                    'password' => $data['password']
                ])->makeHidden('password');
            }
            $token = $user->createToken('main')->plainTextToken;
            $user->first_name = $customer->first_name;
            $user->last_name = $customer->last_name;
            $user->phone = $customer->phone;
            $user->customer_id = $customer->id;
            return ([
                'token' => $token,
                'user' => $user
            ]);
        });
        return $this->successEntityResponse($data);
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
            return $this->errorResponse("Sign in failed", 422);
        }
        $user =  Auth::user();
        if (!$user->customer_id) {
            return $this->errorResponse("Sign in failed", 422);
        }

        $user->first_name = $user->customer->first_name;
        $user->last_name = $user->customer->last_name;
        $user->phone = $user->customer->phone;
        $user->customer_id = $user->customer->id;
        $token = $user->createToken('customer')->plainTextToken;
        return $this->successEntityResponse([
            'user' => $user,
            'token' => $token,
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['result' => 'ok']);
    }
}
