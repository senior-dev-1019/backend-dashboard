<?php

use Illuminate\Database\Seeder;
use App\Models\Folder;

class FoldersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from the table.
        DB::table('folders')->delete();

        // Create a folder
        $folder = new Folder;
        $folder->id = 1;
        $folder->name = 'My Folder';
        $folder->save();
    }
}
