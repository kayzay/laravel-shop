<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Currency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
