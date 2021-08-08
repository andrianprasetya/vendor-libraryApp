<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nis')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('district_id')->nullable();
            $table->string('regency_id')->nullable();
            $table->string('province_id')->nullable();
            $table->string('code_pos')->nullable();
            $table->string('institution')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('image')->nullable();

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('province_id')->on('provinces')->references('id');
            $table->foreign('regency_id')->on('regencies')->references('id');
            $table->foreign('district_id')->on('districts')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
