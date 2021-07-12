<?php

use Illuminate\Database\Seeder;
use App\Models\UserPatient;

class UserPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from the table.
        DB::table('user_patient')->delete();

        // Create an patient
        $userPatient = new UserPatient;
        $userPatient->id = 1;
        $userPatient->user_id = 1;
        $userPatient->patient_id = 1;
        $userPatient->save();
    }
}
