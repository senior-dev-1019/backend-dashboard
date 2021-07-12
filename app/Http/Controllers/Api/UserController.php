<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Patient;
use App\Models\Document;
use App\Models\TimelineItem;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('access.employees', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'may_edit_patients' => ['required', 'boolean'],
            'may_edit_employees' => ['required', 'boolean'],
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
        $user->is_locked = 0;
        $user->is_admin = 0;
        $user->subscribed_until = $today;
        $user->reminder_sent = $today;
        $user->must_change_password = 1;
        $user->may_edit_patients = $request->may_edit_patients;
        $user->may_edit_employees = $request->may_edit_employees;
        $user->is_institution_admin = 0;
        $user->password = Hash::make($password);
        $user->save();

        // A password that will be used to login.
        $user->password=$password;
        // Send a welcome email to the created user with login credentials.
        Mail::to($request->email)
            ->send(new UserCreated($user));
        
        $status="success";
        return response()->json(compact('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = JWTAuth::user();
        $subscription=$user->subscription;
        $patients=$user->patients;
        $institution=$user->institution;

        $patientIds = $patients->map(function ($patient) {
            return $patient->id;
        })->toArray();

        $newestTimelines=TimelineItem::whereIn('patient_id', $patientIds)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        $provisionCount = Document::whereIn('patient_id', $patientIds)
            ->where('is_provision', 1)
            ->count();
        
        $documentCount = Document::whereIn('patient_id', $patientIds)
            ->where('is_provision', 0)
            ->count();
        
        $patientCount = Patient::where('institution_id', $institution->id)
            ->count();

        $status="success";
        return response()->json(
            compact(
                'status',
                'user', 
                'subscription', 
                'patients', 
                'institution', 
                'newestTimelines',
                'provisionCount',
                'documentCount',
                'patientCount'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'may_edit_patients' => ['required', 'boolean'],
            'may_edit_employees' => ['required', 'boolean'],
        ]);

        //Update the user's data.
        User::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'mobile' => $request->mobile,
                'may_edit_patients' => $request->may_edit_patients,
                'may_edit_employees' => $request->may_edit_employees
            ]);
        
        $status='success';
        return response()->json(compact('status'));
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
        
        $status='success';
        return response()->json(compact('status'));
    }
}
