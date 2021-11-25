<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Имя бота'); //setname - change a bot's name 
            $table->string('description')->comment('Описание бота'); //setdescription - change bot description
            $table->string('info')->comment('Описание бота'); //setabouttext - change bot about info
            $table->string('img')->comment('Изображение бота')->nullable(); //setuserpic - change bot profile photo
            $table->string('token'); //token - generate authorization token
            $table->string('link');
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
        Schema::dropIfExists('bot_settings');
    }
}
