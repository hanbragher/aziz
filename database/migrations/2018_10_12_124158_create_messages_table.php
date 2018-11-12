<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->string('text')->nullable();

            $table->integer("from_user")->unsigned()->nullable();
            $table->foreign("from_user")->references("id")->on("users");

            $table->integer("to_user")->unsigned()->nullable();
            $table->foreign("to_user")->references("id")->on("users");

            $table->boolean('is_read')->default(false);
            $table->boolean('skip_inbox')->default(false);
            $table->boolean('skip_outbox')->default(false);
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
        Schema::dropIfExists('messages');
    }
}
