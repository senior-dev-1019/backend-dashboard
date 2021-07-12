<?php

use Illuminate\Database\Seeder;
use App\Models\Subscription;

class SubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from the table.
        DB::table('subscriptions')->delete();

        $subscription = new Subscription;
        $subscription->id = 1;
        $subscription->monthly_price = 100.00;
        $subscription->title = 'Subscription title';
        $subscription->description = 'Subscription Description';
        $subscription->has_timeline = 1;
        $subscription->has_documents = 0;
        $subscription->has_institution = 1;
        $subscription->provisions = 1;
        $subscription->save();
    }
}
