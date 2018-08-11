<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->text('order_items');
            $table->integer('time_to_finish')->nullable();
            $table->integer('to_deliver')->default(false);
            $table->string('city', 50)->nullable();
            $table->string('address', 50)->nullable();
            $table->integer('delivery_boy_id')->unsigned()->nullable();
            $table->dateTime('time_delivered')->nullable();
            $table->decimal('order_price', 10, 2)->nullable();
            $table->decimal('order_profit', 10, 2)->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('delivery_boy_id')->references('id')->on('users')->onDelete('cascade');
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
