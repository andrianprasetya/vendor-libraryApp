<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extends', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('siswa_id')->nullable();
            $table->foreign('siswa_id')->on('users')->references('id');
            $table->uuid('loan_id')->nullable();
            $table->foreign('loan_id')->on('loans')->references('id');
            $table->date('due_date_before')->nullable();
            $table->date('due_date_after')->nullable();
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
        Schema::dropIfExists('extends');
    }
}
