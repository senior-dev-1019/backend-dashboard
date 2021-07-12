<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignkeyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropForeign('users_subscription_id_foreign');
            // $table->dropForeign('users_institution_id_foreign');
            // $table->dropForeign('users_coupon_id_foreign');
        });
    }
}
