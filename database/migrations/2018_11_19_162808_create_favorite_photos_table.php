<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->nullable()->unsigned()->default(null);
            $table->foreign("user_id")->references("id")->on("users");
            $table->integer("photo_id")->nullable()->unsigned()->default(null);
            $table->foreign("photo_id")->references("id")->on("photos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_photos');
    }
}
