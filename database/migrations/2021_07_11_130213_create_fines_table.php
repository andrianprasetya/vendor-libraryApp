<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denda', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('siswa_id');
            $table->foreign('siswa_id')->on('users')->references('id');
            $table->uuid('loan_id');
            $table->foreign('loan_id')->on('loans')->references('id');
            $table->uuid('book_id')->nullable();
            $table->foreign('book_id')->on('books')->references('id');
            $table->integer('telat')->nullable();
            $table->integer('total_denda')->nullable();
            $table->integer('nominal')->nullable();
            $table->boolean('is_money')->nullable();
            $table->boolean('is_book')->nullable();
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
        Schema::dropIfExists('denda');
    }
}
