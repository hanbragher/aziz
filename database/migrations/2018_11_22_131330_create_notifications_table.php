<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->nullable()->unsigned()->default(null);
            $table->foreign("user_id")->references("id")->on("users");

            $table->integer("from_id")->nullable()->unsigned()->default(null);
            $table->foreign("from_id")->references("id")->on("users");

            $table->string('type')->nullable();
            $table->integer("type_id")->nullable()->unsigned()->default(null);

            $table->string('text')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
