<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->string('id', 15)->unique()->comment('ID Unique dari wilayah');
            $table->string('regency_id', 15)->comment('Id nama kota/kabupaten');
            $table->string('name', 64)->comment('Nama wilayah');
            $table->primary('id');

            $table->timestamps();

            $table->foreign('regency_id')->references('id')
                ->on('regencies');

            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
