<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Название заметки');
            $table->text('text', 400)->comment('Текст заметки');
            $table->string('img')->comment('Изображение')->nullable();
            $table->unsignedBigInteger('category_notes_id')->nullable()->comment('Id из таблицы category_notes');
            $table->unsignedBigInteger('author_id')->nullable()->comment('Id из user');
            $table->boolean('is_sent_to_telegram')->nullable()->default(null)->comment('Отправлено в телеграм');
            $table->dateTime('sent_to_telegram_at')->nullable()->default(null)->comment('Когда отправлено в телеграм');

            $table->foreign('category_notes_id')->references('id')->on('category_notes')->onDelete('set null')->onUpdate('cascade'); 
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');      
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
