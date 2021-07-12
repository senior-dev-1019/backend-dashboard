<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Patient;
use App\Models\UserPatient;
use \Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('access.patients', ['only' => ['index', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get authenticated user.
        $user = JWTAuth::user();
        $institution=$user->institution;
        
        // Get the patients that it's institution_id matches user's institution_id.
        $patients = $user->patients->reject(function ($patient) use($institution) {
            return $patient->institution_id !== $institution->id;
        })
        ->map(function ($patient) {
            return $patient;
        });

        return response()->json(compact('patients'));
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
        // Get authenticated user.
        $user = JWTAuth::user();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'patient_number' => ['nullable', 'string', 'max:255'],
            'institution_id' => ['nullable', 'integer'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                "message" => "The given data was invalid.",
                'errors' => $validator->errors()->getMessages()
            ], 400);
        }
        
        $patient=new Patient;
        $patient->name=$request->name;
        $patient->date_of_birth=$request->date_of_birth;
        $patient->patient_number=$request->patient_number;
        $patient->institution_id=$user->institution->id;
        $patient->save();
        
        if($user->subscription->has_institution==0){
            $userPatient= new UserPatient;
            $userPatient->user_id = $user->id;
            $userPatient->patient_id = $patient->id;
            $userPatient->save();
        }

        $status="success";
        return response()->json(compact('status'));
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'patient_number' => ['nullable', 'string', 'max:255'],
            'institution_id' => ['nullable', 'integer'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                "message" => "The given data was invalid.",
                'errors' => $validator->errors()->getMessages()
            ], 400);
        }
        
        Patient::where('id', $id)
            ->update([
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'patient_number' => $request->patient_number,
                'institution_id' => $request->institution_id,
            ]);

        $status="success";
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
        Patient::where('id', $id)->delete();

        $status="success";
        return response()->json(compact('status'));
    }
}
