<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.password.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        
        if(Hash::check($request->old_password, $user->password)){
            //Update the user's data.
            User::where('id', $user->id)
                ->update([
                    'password' => Hash::make($request->password)
                ]);
            
            return redirect()->back()
                ->with('success', trans('passwords.success-change'));
        }else{
            return redirect()->back()
                ->withErrors([trans('passwords.wrong-password')])->withInput();
        }
    }

}
