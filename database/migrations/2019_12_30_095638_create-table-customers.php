<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name', 40);
            $table->string('email', 50);
            $table->string('password', 255);
            $table->string('phone', 12);
            $table->integer('ward_id')->unsigned();
            $table->string('address', 255)->nullable();
            $table->string('token', 255)->nullable();
            $table->dateTime('token_expire')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('ward_id')->references('id')->on('wards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
