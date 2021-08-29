<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_books', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('book_id')->nullable();
            $table->foreign('book_id')->on('books')->references('id');
            $table->uuid('pattern_book_id')->nullable();
            $table->foreign('pattern_book_id')->on('pattern_books')->references('id');
            $table->string('code')->nullable();
            $table->string('collection')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_loan')->default(false);
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
        Schema::dropIfExists('code_books');
    }
}
