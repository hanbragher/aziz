<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_places', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->unsigned()->default(null);
            $table->foreign("user_id")->references("id")->on("users");
            $table->integer("place_id")->unsigned()->default(null);
            $table->foreign("place_id")->references("id")->on("places");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_places');
    }
}
