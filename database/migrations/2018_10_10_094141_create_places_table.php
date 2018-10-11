<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('text')->nullable();

            $table->string('map')->nullable();

            $table->integer("image_id")->nullable()->unsigned()->default(null);
            $table->foreign("image_id")->references("id")->on("images");

            $table->integer("city_id")->nullable()->unsigned()->default(null);
            $table->foreign("city_id")->references("id")->on("cities");

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
        Schema::dropIfExists('places');
    }
}
