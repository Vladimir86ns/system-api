<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->decimal('total_amount_investment', 10, 2)->default(0);
            $table->decimal('income', 10, 2)->default(0);
            $table->text('monthly_expense');
            $table->decimal('profit', 10, 2)->default(0);
            $table->decimal('profit_sharing', 10, 2)->default(0);
            $table->decimal('investment_collected', 10, 2)->default(0);
            $table->string('phone_number')->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->integer('admin_investment_id')->unsigned()->nullable();
            $table->foreign('admin_investment_id')->references('id')->on('admin_investments');
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
        Schema::dropIfExists('companies');
    }
}
