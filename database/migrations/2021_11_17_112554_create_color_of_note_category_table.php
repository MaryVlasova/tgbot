<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorOfNoteCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors_of_note_category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Название цвета');
            $table->string('code')->unique()->comment('Код цвета');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors_of_note_category');
    }
}
