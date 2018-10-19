<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("blogger_id")->nullable()->unsigned()->default(null);
            $table->foreign("blogger_id")->references("id")->on("bloggers");

            $table->string('title');
            $table->text('text')->nullable();

            $table->integer("main_image")->nullable()->unsigned()->default(null);
            $table->foreign("main_image")->references("id")->on("images");

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
