<?php

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from the table.
        DB::table('invoices')->delete();

        // Create a invoice
        $invoice = new Invoice;
        $invoice->id = 1;
        $invoice->user_id = 1;
        $invoice->invoice_date = Carbon::today()->toDateString();
        $invoice->payment_date = Carbon::today()->toDateString();
        $invoice->amount = 55.55;
        $invoice->status = 'open';
        $invoice->save();
    }
}
