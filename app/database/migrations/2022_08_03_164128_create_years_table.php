<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->integer('model_year');
            $table->timestamps();
        });

        Schema::create('car_model_year', function (Blueprint $table) {
            $table->integer('car_model_id');
            $table->integer('year_id');
            $table->string('expires')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('years');
        Schema::dropIfExists('car_model_year');
    }
};
