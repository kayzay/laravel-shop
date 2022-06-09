<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductCategoryTree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category_tree', function (Blueprint $table) {

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->index('product_id');
            $table->index('category_id');
            $table->unique(['product_id', 'category_id']);
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
