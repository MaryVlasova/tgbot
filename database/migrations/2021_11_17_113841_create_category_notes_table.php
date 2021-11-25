<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_notes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Уникальное название категории');
            $table->string('img')->nullable()->comment('Изображение категории');

            $table->unsignedBigInteger('color_id')->nullable()->comment('Id из таблицы colors_of_note_category');
            $table->foreign('color_id')->references('id')->on('colors_of_note_category')->onDelete('set null')->onUpdate('cascade');             
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
        Schema::dropIfExists('category_notes');
    }
}
