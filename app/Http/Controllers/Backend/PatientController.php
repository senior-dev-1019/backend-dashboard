<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Institution;
use Carbon\Carbon;
use App;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale=App::getLocale();
        $patients=Patient::all();
        
        foreach ($patients as $key => $patient) {
            if(isset($patient->date_of_birth)){
                if($locale == "de"){
                    $patient->date_of_birth=Carbon::parse($patient->date_of_birth)->format('d.m.Y');
                }else{
                    $patient->date_of_birth=Carbon::parse($patient->date_of_birth)->format('m-d-Y');
                }
            }
        }

        return view('backend.patients.index')->with('patients', $patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutions=Institution::all();
        return view('backend.patients.create')->with('institutions', $institutions);
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
            'date_of_birth' => ['nullable'],
            'patient_number' => ['nullable', 'string', 'max:255'],
            'institution_id' => ['nullable'],
        ]);

        if(isset($request->date_of_birth)){
            $locale=App::getLocale();
            if($locale == "de"){
                $date_of_birth=Carbon::createFromFormat('d.m.Y', $request->date_of_birth)->format('Y-m-d');
            }else{
                $date_of_birth=Carbon::createFromFormat('m-d-Y', $request->date_of_birth)->format('Y-m-d');
            }
        }

        $patient = new Patient;
        $patient->name = $request->name;
        $patient->date_of_birth = isset($request->date_of_birth)?$date_of_birth:null;
        $patient->patient_number = isset($request->patient_number)?$request->patient_number:null;
        $patient->institution_id = isset($request->institution_id)?$request->institution_id:null;
        $patient->save();

        return redirect('/dashboard/patients')
            ->with('success', trans('dashboard.patients.create-success'));
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
        $patient=Patient::find($id);
        
        $locale=App::getLocale();
        if(isset($patient->date_of_birth)){
            if($locale == "de"){
                $patient->date_of_birth=Carbon::parse($patient->date_of_birth)->format('d.m.Y');
            }else{
                $patient->date_of_birth=Carbon::parse($patient->date_of_birth)->format('m-d-Y');
            }
        }

        $institutions=Institution::all();
        return view('backend.patients.edit')->with('patient', $patient)->with('institutions', $institutions);
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
            'date_of_birth' => ['nullable'],
            'patient_number' => ['nullable', 'string', 'max:255'],
            'institution_id' => ['nullable'],
        ]);
        
        if(isset($request->date_of_birth)){
            $locale=App::getLocale();
            if($locale == "de"){
                $date_of_birth=Carbon::createFromFormat('d.m.Y', $request->date_of_birth)->format('Y-m-d');
            }else{
                $date_of_birth=Carbon::createFromFormat('m-d-Y', $request->date_of_birth)->format('Y-m-d');
            }
        }

        $patientData['name'] = $request->name;
        $patientData['date_of_birth'] = isset($request->date_of_birth)?$date_of_birth:null;
        $patientData['patient_number'] = isset($request->patient_number)?$request->patient_number:null;
        $patientData['institution_id'] = isset($request->institution_id)?$request->institution_id:null;

        Patient::where('id', $id)
            ->update($patientData);

        return redirect()->back()
            ->with('success', trans('dashboard.patients.edit-success'));
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
        return redirect()->back()
            ->with('success', trans('dashboard.patients.delete-success'));
    }
}
