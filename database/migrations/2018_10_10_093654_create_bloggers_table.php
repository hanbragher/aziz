<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloggers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->unsigned()->default(null);
            $table->foreign("user_id")->references("id")->on("users");
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer("avatar_id")->unsigned()->default(null);
            $table->foreign("avatar_id")->references("id")->on("images");
            $table->integer("cover_id")->unsigned()->default(null);
            $table->foreign("cover_id")->references("id")->on("images");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bloggers');
    }
}
