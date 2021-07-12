<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from users table.
        DB::table('users')->delete();

        // create a user with role admin.
        $admin = new User;
        $admin->id = 1;
        $admin->name = 'admin';
        $admin->password= Hash::make('password');
        $admin->email = 'developerwebmaster3@gmail.com';
        $admin->address = 'my address';
        $admin->postcode = 'my postcode';
        $admin->city = 'my city';
        $admin->mobile = '12345678901';
        $admin->is_locked = 0;
        $admin->is_admin = 1;
        $admin->subscription_id=1;
        $admin->subscribed_until = Carbon::today()->toDateString();
        $admin->reminder_sent = Carbon::today()->toDateString();
        $admin->must_change_password = 0;
        $admin->institution_id = 1;
        $admin->may_edit_patients = 1;
        $admin->may_edit_employees = 1;
        $admin->is_institution_admin = 1;
        $admin->save();

    }
}
