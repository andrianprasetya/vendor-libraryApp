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
            $table->string('SOR')->nullable();
            $table->string('edition')->nullable();
            $table->string('SDI')->nullable();
            $table->uuid('code_pattern_id')->nullable();
            $table->foreign('code_pattern_id')->on('pattern_books')->references('id');
            $table->integer('total_item')->nullable();
            $table->string('collection')->nullable();
            $table->string('location')->nullable();
            $table->string('GMD')->nullable();
            $table->string('content_type')->nullable();
            $table->string('media_type')->nullable();
            $table->string('carrier_type')->nullable();
            $table->string('frequency')->nullable();
            $table->string('book_series')->nullable();
            $table->string('publisher')->nullable();
            $table->string('publishing_year')->nullable();
            $table->string('publishing_place')->nullable();
            $table->string('collation')->nullable();
            $table->string('series_title')->nullable();
            $table->string('classification')->nullable();
            $table->string('call_number')->nullable();
            $table->string('subject')->nullable();
            $table->string('language')->nullable();
            $table->string('notes')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('biblio_data')->nullable();
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
        Schema::dropIfExists('books');
    }
}
