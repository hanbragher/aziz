<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->unsigned()->default(null);
            $table->foreign("user_id")->references("id")->on("users");
            $table->integer("announcement_id")->unsigned()->default(null);
            $table->foreign("announcement_id")->references("id")->on("announcements");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_announcements');
    }
}
