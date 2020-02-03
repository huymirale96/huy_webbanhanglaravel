<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('ward_id')->unsigned();
            $table->string('address', 255);
            $table->string('note', 255)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('order_id', 30)->nullable();
            $table->tinyInteger('payment_method')->default(0);
            $table->tinyInteger('pay_status')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
