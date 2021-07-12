<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id')->unsigned()->nullable();
            $table->bigInteger('coupon_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('file_name');
            $table->string('storage_file_name');
            $table->bigInteger('folder_id')->unsigned();
            $table->boolean('is_provision');
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
        Schema::dropIfExists('documents');
    }
}
