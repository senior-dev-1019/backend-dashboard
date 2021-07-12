<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('postcode');
            $table->string('city');
            $table->string('mobile');
            $table->boolean('is_locked');
            $table->boolean('is_admin');
            $table->bigInteger('subscription_id')->unsigned()->nullable();
            $table->date('subscribed_until');
            $table->date('reminder_sent');
            $table->boolean('must_change_password');
            $table->bigInteger('institution_id')->unsigned()->nullable();
            $table->boolean('may_edit_patients');
            $table->boolean('may_edit_employees');
            $table->boolean('is_institution_admin');
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('coupon_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
