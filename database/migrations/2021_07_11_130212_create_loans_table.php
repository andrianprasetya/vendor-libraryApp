<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('book_id');
            $table->foreign('book_id')->on('books')->references('id');
            $table->uuid('siswa_id');
            $table->foreign('siswa_id')->on('users')->references('id');
            $table->date('tgl_peminjaman')->nullable();
            $table->date('deadline')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->boolean('is_returned')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
