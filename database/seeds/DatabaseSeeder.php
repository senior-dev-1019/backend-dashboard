<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InstitutionsSeeder::class);

        $this->call(FoldersSeeder::class);

        $this->call(CouponsSeeder::class);

        $this->call(PatientsSeeder::class);

        $this->call(SubscriptionsSeeder::class);

        $this->call(UsersSeeder::class);

        $this->call(UserPatientSeeder::class);

        $this->call(TimelineItemsSeeder::class);

        $this->call(DocumentsSeeder::class);

        $this->call(InvoicesSeeder::class);

        $this->call(InvoiceLinesSeeder::class);
    }
}
