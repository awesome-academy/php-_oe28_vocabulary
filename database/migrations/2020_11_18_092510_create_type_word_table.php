<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeWordTable extends Migration
{
    public function up()
    {
        Schema::create('type_word', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('word_id');
            $table->string('meaning', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_word');
    }
}
