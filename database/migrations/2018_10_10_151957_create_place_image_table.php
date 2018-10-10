<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("place_id")->unsigned()->default(null);
            $table->foreign("place_id")->references("id")->on("places");
            $table->integer("image_id")->unsigned()->default(null);
            $table->foreign("image_id")->references("id")->on("images");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_image');
    }
}
