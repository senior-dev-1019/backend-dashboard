<?php

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from the table.
        DB::table('documents')->delete();

        // Create a document
        $document = new Document;
        $document->id = 1;
        $document->patient_id = 1;
        $document->coupon_id = 1;
        $document->title = 'My Document';
        $document->file_name = 'test.pdf';
        $document->storage_file_name = 'test.pdf';
        $document->folder_id = 1;
        $document->is_provision = 1;
        $document->save();
    }
}
