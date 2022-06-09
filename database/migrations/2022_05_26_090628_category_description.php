<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_description', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('language_id');
            $table->string('name');
            $table->string('h1');
            $table->string('title');
            $table->string('keywords');
            $table->string('description');
            $table->text('short_description');
            $table->text('full_description');
            $table->timestamps();

            $table->index('category_id');
            $table->index('language_id');
            $table->unique(['category_id', 'language_id']);
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('language_id')->references('id')->on('languages');

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
