<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PolicyRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_politics', function (Blueprint $table) {
            $table->smallInteger('id')->autoIncrement()->unique();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('admin_rules', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('admin_policy_id');
            $table->unsignedBigInteger('group_id');
            $table->string('rules');
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();

            $table->foreign('admin_policy_id')->references('id')->on('admin_politics');
            $table->foreign('group_id')->references('id')->on('admin_user_group');
            $table->foreign('admin_id')->references('id')->on('admin_users');
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
