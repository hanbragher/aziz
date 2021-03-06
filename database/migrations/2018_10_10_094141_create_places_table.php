<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('inf')->nullable();

            $table->text('map')->nullable();

            $table->integer("main_image")->nullable()->unsigned()->default(null);
            $table->foreign("main_image")->references("id")->on("images");

            $table->integer("user_id")->nullable()->unsigned()->default(null);
            $table->foreign("user_id")->references("id")->on("users");

            $table->integer("category_id")->nullable()->unsigned()->default(null);
            $table->foreign("category_id")->references("id")->on("categories");

            $table->integer("country_id")->nullable()->unsigned()->default(null);
            $table->foreign("country_id")->references("id")->on("countries");

            $table->integer("region_id")->nullable()->unsigned()->default(null);
            $table->foreign("region_id")->references("id")->on("regions");

            $table->integer("city_id")->nullable()->unsigned()->default(null);
            $table->foreign("city_id")->references("id")->on("cities");

            $table->boolean('is_moderated')->default(false);

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
        Schema::dropIfExists('places');
    }
}
