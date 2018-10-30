<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("advert_id")->unsigned()->default(null);
            $table->foreign("advert_id")->references("id")->on("adverts");
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
        Schema::dropIfExists('advert_tags');
    }
}
