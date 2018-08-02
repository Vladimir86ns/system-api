<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->decimal('total_investment', 10, 2)->unsigned()->nullable();
            $table->decimal('percent_of_income', 10, 2)->unsigned()->nullable();
            $table->decimal('investment_collected_total', 10, 2)->unsigned()->nullable();
            $table->decimal('monthly_collected', 10, 2)->unsigned()->nullable();
            $table->boolean('investment_collected')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('investments');
    }
}
