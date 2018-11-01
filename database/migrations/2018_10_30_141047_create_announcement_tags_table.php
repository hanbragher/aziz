<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("announcement_id")->unsigned()->default(null);
            $table->foreign("announcement_id")->references("id")->on("announcements");
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
        Schema::dropIfExists('announcement_tag');
    }
}
