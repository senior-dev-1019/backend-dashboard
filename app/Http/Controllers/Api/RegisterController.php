<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Mockery\Exception;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'subscription_id' => ['nullable', 'integer'],
            'coupon_id' => ['nullable', 'integer'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $password=$request->password;

        $request->merge(['password' => Hash::make($request->password)]);
        try{
            // Get today as string
            $subscribed_until = Carbon::today()->addDays(7)->toDateString();

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->postcode = $request->postcode;
            $user->city = $request->city;
            $user->mobile = $request->mobile;
            $user->subscription_id = $request->subscription_id;
            $user->subscribed_until = $subscribed_until;
            $user->coupon_id = $request->coupon_id;
            $user->is_locked = 0;
            $user->is_admin = 0;
            $user->must_change_password = 0;
            $user->institution_id = null;
            $user->may_edit_patients = 0;
            $user->may_edit_employees = 0;
            $user->is_institution_admin = 0;
            $user->password = $request->password;
            $user->save();

            $credentials=[
                'email' => $request->email,
                'password' => $password
            ];

            $token = JWTAuth::attempt($credentials);
            
            return response()->json([
                'status' => 'success',
                'token' => $token,
                'message' => 'registered successfully'], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                "error" => "could_not_register",
                "message" => "Unable to register user"
            ], 400);
        }

    }


}
