<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTRegenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regencies', function (Blueprint $table) {
            $table->string('id', 15)->unique()->comment('ID Unique dari kota/kabupaten');
            $table->string('province_id', 15)->comment('Id Nama provinsi');
            $table->string('name', 64)->comment('Id nama kota/kabupaten');
            $table->primary('id');

            $table->timestamps();

            $table->foreign('province_id')->references('id')
                ->on('provinces');

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
        Schema::dropIfExists('regencies');
    }
}
