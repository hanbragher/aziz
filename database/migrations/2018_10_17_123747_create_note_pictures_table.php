<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("note_id")->unsigned()->default(null);
            $table->foreign("note_id")->references("id")->on("notes");
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
        Schema::dropIfExists('note_pictures');
    }
}
