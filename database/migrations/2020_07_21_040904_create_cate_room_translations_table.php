<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCateRoomTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cate_room_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->text('describe');
            $table->string('locale')->index();
 
            $table->unique(['cate_room_id','locale']);
            $table->bigInteger('cate_room_id')->unsigned();
            $table->foreign('cate_room_id')
                ->references('id')
                ->on('cate_room')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cate_room_translations');
    }
}
