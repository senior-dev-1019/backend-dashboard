<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Perform password change for logged in user.
     */
    public function change(Request $request){
        // Get authenticated user.
        $user = JWTAuth::user();

        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                "message" => "The given data was invalid.",
                'errors' => $validator->errors()->getMessages()
            ], 400);
        }

        if(Hash::check($request->old_password, $user->password)){
            //Update the user's data.
            User::where('id', $user->id)
                ->update([
                    'password' => Hash::make($request->password)
                ]);
            
            $status="success";
            return response()->json(compact('status'));
        }else{
            return response()->json([
                'status' => 'error',
                "message" => "Old password doesn't match with our record.",
                'errors' => "Old password doesn't match with our record."
            ], 400);
        }
    }
}
