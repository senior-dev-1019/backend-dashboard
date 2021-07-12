<?php

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from the table.
        DB::table('coupons')->delete();

        // Create a coupon
        $coupon = new Coupon;
        $coupon->id = 1;
        $coupon->code = '123456';
        $coupon->save();
    }
}
