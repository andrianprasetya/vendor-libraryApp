<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->string('edition')->nullable();
            $table->string('gmd')->nullable();
            $table->string('media_type')->nullable();
            $table->string('book_series')->nullable();
            $table->string('publisher')->nullable();
            $table->string('publishing_year')->nullable();
            $table->string('publishing_place')->nullable();
            $table->string('classification')->nullable();
            $table->string('call_number')->nullable();
            $table->string('collection')->nullable();
            $table->string('language')->nullable();
            $table->string('notes')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('slug_file')->nullable();
            $table->integer('total_item')->nullable();
            $table->integer('sequence')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
