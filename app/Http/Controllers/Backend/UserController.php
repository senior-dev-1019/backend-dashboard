<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Institution;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        
        $locale=App::getLocale();
        foreach ($users as $key => $user) {
            if(isset($user->subscribed_until)){
                if($locale == "de"){
                    $user->subscribed_until=Carbon::parse($user->subscribed_until)->format('d.m.Y');
                }else{
                    $user->subscribed_until=Carbon::parse($user->subscribed_until)->format('m-d-Y');
                }
            }
            if(isset($user->reminder_sent)){
                if($locale == "de"){
                    $user->reminder_sent=Carbon::parse($user->reminder_sent)->format('d.m.Y');
                }else{
                    $user->reminder_sent=Carbon::parse($user->reminder_sent)->format('m-d-Y');
                }
            }
        }
        return view('backend.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscriptions=Subscription::all();
        $institutions=Institution::all();
        return view('backend.users.create')->with('subscriptions', $subscriptions)->with('institutions', $institutions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'is_locked' => ['required', 'boolean'],
            'is_admin' => ['required', 'boolean'],
            'institution_id' => ['nullable', 'integer'],
            'may_edit_patients' => ['required', 'boolean'],
            'may_edit_employees' => ['required', 'boolean'],
            'is_institution_admin' => ['required', 'boolean'],
        ]);

        // Get today as string
        $today = Carbon::today()->toDateString();
        $password = str_random(8);
        
        // Create a new user.
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->postcode = $request->postcode;
        $user->city = $request->city;
        $user->mobile = $request->mobile;
        $user->is_locked = $request->is_locked;
        $user->is_admin = $request->is_admin;
        $user->institution_id = $request->institution_id;
        $user->subscribed_until = $today;
        $user->reminder_sent = $today;
        $user->must_change_password = 1;
        $user->may_edit_patients = $request->may_edit_patients;
        $user->may_edit_employees = $request->may_edit_employees;
        $user->is_institution_admin = $request->is_institution_admin;
        $user->password = Hash::make($password);
        $user->save();
        
        // A password that will be used to login.
        $user->password=$password;
        // Send a welcome email to the created user with login credentials.
        Mail::to($user->email)
            ->send(new UserCreated($user));

        return redirect('/dashboard/users')
            ->with('success', trans('dashboard.users.create-success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $locale=App::getLocale();
        if($locale == "de"){
            if(isset($user->subscribed_until)){
                $user->subscribed_until=Carbon::parse($user->subscribed_until)->format('d.m.Y');
            }
            if(isset($user->reminder_sent)){
                $user->reminder_sent=Carbon::parse($user->reminder_sent)->format('d.m.Y');
            }
        }else{
            if(isset($user->subscribed_until)){
                $user->subscribed_until=Carbon::parse($user->subscribed_until)->format('m-d-Y');
            }
            if(isset($user->reminder_sent)){
                $user->reminder_sent=Carbon::parse($user->reminder_sent)->format('m-d-Y');
            }
        }
        $institutions=Institution::all();
        $subscriptions=Subscription::all();
        return view('backend.users.edit')->with('user', $user)->with('subscriptions', $subscriptions)->with('institutions', $institutions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'is_locked' => ['required', 'boolean'],
            'is_admin' => ['required', 'boolean'],
            'subscription_id' => ['nullable', 'integer'],
            'subscribed_until' => ['required'],
            'reminder_sent' => ['required'],
            'must_change_password' => ['required', 'boolean'],
            'institution_id' => ['nullable', 'integer'],
            'may_edit_patients' => ['required', 'boolean'],
            'may_edit_employees' => ['required', 'boolean'],
            'is_institution_admin' => ['required', 'boolean'],
        ]);

        $locale=App::getLocale();
        if (isset($request->subscribed_until)) {
            if($locale == "de"){
                $subscribed_until=Carbon::createFromFormat('d.m.Y', $request->subscribed_until)->format('Y-m-d');
            }else{
                $subscribed_until=Carbon::createFromFormat('m-d-Y', $request->subscribed_until)->format('Y-m-d');
            }
        } else {
            $subscribed_until=null;
        }

        if(isset($request->reminder_sent)){
            if($locale == "de"){
                $reminder_sent=Carbon::createFromFormat('d.m.Y', $request->reminder_sent)->format('Y-m-d');
            }else{
                $reminder_sent=Carbon::createFromFormat('m-d-Y', $request->reminder_sent)->format('Y-m-d');
            }
        }else{
            $reminder_sent=null;
        }

        User::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'mobile' => $request->mobile,
                'is_locked' => $request->is_locked,
                'is_admin' => $request->is_admin,
                'subscription_id' => $request->subscription_id,
                'subscribed_until' => $subscribed_until,
                'reminder_sent' => $reminder_sent,
                'must_change_password' => $request->must_change_password,
                'institution_id' => $request->institution_id,
                'may_edit_patients' => $request->may_edit_patients,
                'may_edit_employees' => $request->may_edit_employees,
                'is_institution_admin' => $request->is_institution_admin,
            ]);

        return redirect()->back()
            ->with('success', trans('dashboard.users.edit-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()
            ->with('success', trans('dashboard.users.delete-success'));
    }
}
