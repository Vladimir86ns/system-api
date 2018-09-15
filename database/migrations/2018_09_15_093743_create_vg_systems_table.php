<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVgSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vg_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total_investitions', 10, 2)->default(0);
            $table->decimal('collected_to_date', 10, 2)->default(0);
            $table->decimal('monthly_collected', 10, 2)->default(0);
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
        Schema::dropIfExists('vg_systems');
    }
}
