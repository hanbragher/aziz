<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->text('text')->nullable();

            $table->integer("user_id")->nullable()->unsigned()->default(null);
            $table->foreign("user_id")->references("id")->on("users");

            $table->integer("main_image")->nullable()->unsigned()->default(null);
            $table->foreign("main_image")->references("id")->on("images");

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
        Schema::dropIfExists('announcements');
    }
}
