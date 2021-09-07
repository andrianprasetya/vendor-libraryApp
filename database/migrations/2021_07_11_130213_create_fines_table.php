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
        Schema::create('fines', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('siswa_id')->nullable();
            $table->foreign('siswa_id')->on('users')->references('id');
            $table->uuid('loan_id')->nullable();;
            $table->foreign('loan_id')->on('loans')->references('id');
            $table->uuid('book_id')->nullable();
            $table->foreign('book_id')->on('books')->references('id');
            $table->integer('late')->nullable()->comment('Hari / Day');
            $table->integer('nominal')->nullable();
            $table->integer('object')->nullable()->comment('0 => Money, 1 => Book');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('fines');
    }
}
