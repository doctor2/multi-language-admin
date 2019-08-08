<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('model_id')->index();
            $table->string('model_type', 50);
            $table->string('name', 50);
            $table->string('path');
            $table->json('additional');
            $table->integer('order');
            $table->boolean('active');

            $table->timestamps();
        });

        Schema::create('image_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('image_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title');

            $table->unique(['image_id','locale']);

            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
        Schema::dropIfExists('image_translations');
    }
}
