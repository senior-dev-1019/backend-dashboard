<?php

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from institutions table.
        DB::table('institutions')->delete();

        // Create an institution
        $institution = new Institution;
        $institution->id = 1;
        $institution->name = 'My Institution';
        $institution->save();
    }
}
