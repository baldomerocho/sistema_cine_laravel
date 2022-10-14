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
        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('tagline');
            $table->string('original_title')->nullable();
            $table->string('video',2048)->nullable();
            $table->string('status',50)->nullable();
            $table->string('language',10)->nullable();
            $table->string('poster_path',100);
            $table->string('backdrop_path',100);
            $table->integer('imdb_id')->unique();
            $table->integer('tmdb_id')->unique();
            $table->boolean('adult')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('movies');
    }
};
