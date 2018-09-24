<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_category_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('name', 50);
            $table->string('type', 50)->nullable();
            $table->string('size', 50)->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('picture')->nullable();
            $table->integer('time_to_prepare')->nullable();
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('company_products');
    }
}
