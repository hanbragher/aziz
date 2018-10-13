<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesssagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messsages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->string('text')->nullable();

            $table->integer("from")->unsigned()->default(null);
            $table->foreign("from")->references("id")->on("users");

            $table->integer("to")->unsigned()->default(null);
            $table->foreign("to")->references("id")->on("users");

            $table->boolean('is_read')->default(false);
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
        Schema::dropIfExists('messsages');
    }
}
