<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\StaffResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\StaffAuthResource;
use App\Http\Requests\StoreNewCustomerRequest;
use App\Models\User;

use App\Models\Staff;
use App\Models\Customer;
use App\Models\Role;

class AuthController extends Controller
{
 
    public function register(StoreUserRequest $request){
        $data = $request->all();
        
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $token = $user->createToken('main')->plainTextToken;

        $staff_inf = Staff::find($data['staff_id']);

        $staff_inf['id_login'] = $user['id'];
        $staff_inf->save();

        return response()->json([
            'staff_information' => new StaffResource($staff_inf),
            'token' => $token,
            'newUser' => $user
        ],200);
    }

  
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required'
            ],
            'remember' => 'boolean'
        ]);

        

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);
        if(!Auth::attempt($credentials, $remember)){
            return response([
                'status' => 'error',
                'msg' => "Xác thực không thành công."
            ], 422);
        }

        $user = Auth::user();

        $role = Role::where('id',$user['role_id'])->first();
        if($role['id'] != 6){
            $user_info =  new StaffAuthResource(Staff::where('id_login',$user['id'])->first());

            if($user_info['active']==0){
                return response([
                    'status' => 'error',
                    'msg' => "Xác thực không thành công."
                ], 422);
            }
            
            $token = $user->createToken('main')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'msg' => "Đăng nhập thành công.",
                'information' => $user_info,
                'roleUser' => $role,
                'token' => $token,
            ]);    
        }
        else{
            return response()->json([
                'status' => 'success',
                'msg' => "Đăng nhập thành công.",
                'roleUser' => $role,
                'token' => $user->createToken('customer')->plainTextToken,
            ]); 
        }
        

    }
    public function logout(){
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response([
            'status' => 'success',
            'msg' => "Đăng xuất thành công.",
        ]);
    }
    public function loginCustomer(Request $request){
        $validation = $request->validate([
            'phone_number' => ['required','regex:/(0)[0-9]/','not_regex:/[a-z]/','min:9']
        ]);

        return response()->json([
            'status' => 'success',
            'fakeOTP' => random_int(100000,999999),
        ]);


        
    }

    public function getCustomerThroughtOTP(Request $request){
        $data  = $request->all();
        if($data['result']){

            $login_customer = [
                'email' => 'admin@gmail.com',
                'password' => 'Admin12345.',
            ];
    
            Auth::attempt($login_customer);
            $user = Auth::user();
            $token = $user->createToken('customer')->plainTextToken;

            $cus = Customer::where('phone_number',$data['phone_number'])->first();
        
            if(!$cus){
                return response()->json([
                    'status' => 'fail',
                    'phone_number' => $data['phone_number'],
                    'msg' => "Khách hàng chưa có tài khoản.",
                    'token' => $token
                ],400);
            }

            $info_cus = new CustomerResource($cus);
           

            return response([
                'status' => 'success',
                'msg' => "Đăng nhập thành công.",
                'information' => $info_cus,
                'roleUser' =>  Role::find(6),
                'token' => $token,
            ]);
        }else{
            return response()->json([
                'status' => 'fail',
                'msg' => "Xác thực otp thất bại."
            ],400);
        }
    }

    public function addCustomer(StoreNewCustomerRequest $request){

        $new_cus = new CustomerResource(Customer::create($request->all()));
        
        if($new_cus){

            return response()->json([
                'status' => 'success',
                'msg' => 'Thêm khách hàng thành công',
                'newCustomer' => $new_cus,
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'msg' => "Thêm nhân viên thất bại",
            ],422);
        }
    }
}
