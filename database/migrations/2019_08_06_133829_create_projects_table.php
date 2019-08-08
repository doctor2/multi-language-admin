<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->unsignedInteger('city_id');
            $table->integer('order');
            $table->boolean('active');
            $table->timestamps();
            });

        Schema::create('project_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title');
            $table->string('additional', 5000);
            $table->json('additional_multi');

            $table->unique(['project_id','locale']);

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_translations');

    }
}
