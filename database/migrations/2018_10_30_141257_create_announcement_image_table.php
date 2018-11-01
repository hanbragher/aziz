<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("announcement_id")->unsigned()->default(null);
            $table->foreign("announcement_id")->references("id")->on("announcements");
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
        Schema::dropIfExists('announcement_image');
    }
}
