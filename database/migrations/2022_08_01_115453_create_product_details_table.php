<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prod_cat_id')->nullable();
            $table->string('title')->nullable();
            $table->string('available_stock')->nullable();
            $table->string('class')->nullable();
            $table->decimal('price')->nullable();
            $table->mediumText('image')->nullable();
            $table->timestamps();
            $table->foreign('prod_cat_id')
            ->references('id')
            ->on('product_categories')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
