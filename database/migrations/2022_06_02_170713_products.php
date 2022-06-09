<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group', function (Blueprint $table)  {
            $table->smallInteger('id')->autoIncrement()->unique();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('product_status', function (Blueprint $table) {
            $table->smallInteger('id')->autoIncrement()->unique();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->string('alias')->unique();
            $table->smallInteger('status');
            $table->smallInteger('sort');
            $table->unsignedBigInteger('quantity');
            $table->timestamps();

            $table->foreign('status')->references('id')->on('product_status');
        });

        Schema::create('product_description', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('language_id');
            $table->string('name');
            $table->string('h1');
            $table->string('title');
            $table->string('keywords');
            $table->string('description');
            $table->text('short_description');
            $table->text('full_description');
            $table->timestamps();

            $table->index('product_id');
            $table->index('language_id');
            $table->unique(['product_id', 'language_id']);
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('language_id')->references('id')->on('languages');
        });


        Schema::create('currency', function (Blueprint $table) {
            $table->smallInteger('id')->autoIncrement()->unique();
            $table->string('name');
            $table->string('abr');
            $table->string('symbol');
            $table->boolean('use')->default(0);
            $table->boolean('default')->default(0);
            $table->string('course');
            $table->boolean('status')->default(0);

            $table->timestamps();
        });


        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->smallIncrements('currency_id');
            $table->float('origin_price');
            $table->float('price');
            $table->unsignedBigInteger('product_id');
            $table->smallInteger('user_group_id');
            $table->timestamps();

            $table->index('user_group_id');
            $table->index('product_id');
            $table->index('name');
            $table->unique(['name', 'user_group_id']);
            $table->unique(['product_id', 'user_group_id']);
            $table->unique(['product_id', 'currency_id']);
            $table->foreign('user_group_id')->references('id')->on('user_group');
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
