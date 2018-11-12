<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("message_id")->unsigned()->default(null);
            $table->foreign("message_id")->references("id")->on("messages");
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
        Schema::dropIfExists('message_image');
    }
}
