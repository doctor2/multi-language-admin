<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->integer('order');
            $table->string('description', 5000)->nullable();
            $table->timestamps();
        });

        Schema::create('setting_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('setting_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name', 500)->nullable();

            $table->unique(['setting_id','locale'], 'setting__locale');

            $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('setting_translations');
    }
}
