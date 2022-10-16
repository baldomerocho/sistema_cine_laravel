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
        Schema::create('movie_status_movie', function (Blueprint $table) {
            $table->unsignedBigInteger('status_movie_id');
            $table->foreign('status_movie_id')->references('id')->on('status_movies')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignUuid('movie_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_status_movie');
    }
};
