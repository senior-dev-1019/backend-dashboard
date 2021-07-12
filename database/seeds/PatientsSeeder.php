<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from patients table.
        DB::table('patients')->delete();

        // Create an patient
        $patient = new Patient;
        $patient->id = 1;
        $patient->name = 'Patient 1';
        $patient->date_of_birth = '1990-11-11';
        $patient->patient_number = 'patient 01';
        $patient->institution_id = 1;
        $patient->save();
    }
}
