<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("photo_id")->unsigned()->default(null);
            $table->foreign("photo_id")->references("id")->on("photos");
            $table->integer("tag_id")->unsigned()->default(null);
            $table->foreign("tag_id")->references("id")->on("tags");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_tags');
    }
}
