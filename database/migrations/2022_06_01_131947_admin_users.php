<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('admin_user_group', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('admin_status', function (Blueprint $table) {
            $table->smallInteger('id')->autoIncrement()->unique();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('password', 50);
            $table->smallInteger('status');
            $table->unsignedBigInteger('group_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index('status');
            $table->index('group_id');
            $table->foreign('group_id')->references('id')->on('admin_user_group');
            $table->foreign('status')->references('id')->on('admin_status');
        });

        Schema::create('admin_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_user_group');
        Schema::dropIfExists('admin_users');
    }
}
