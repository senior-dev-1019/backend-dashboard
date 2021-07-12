<?php

use Illuminate\Database\Seeder;
use App\Models\InvoiceLine;

class InvoiceLinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from the table.
        DB::table('invoice_lines')->delete();

        // Create an invoice line.
        $invoiceLine = new InvoiceLine;
        $invoiceLine->id = 1;
        $invoiceLine->invoice_id = 1;
        $invoiceLine->text = 'Text for Invoice line';
        $invoiceLine->amount = 33.33;
        $invoiceLine->save();
    }
}
