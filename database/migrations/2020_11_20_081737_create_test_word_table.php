<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestWordTable extends Migration
{
    public function up()
    {
        Schema::create('test_word', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_id');
            $table->unsignedBigInteger('word_id');
            $table->unsignedBigInteger('type_id');
            $table->string('answer', 255);
            $table->unsignedBigInteger('is_true');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_word');
    }
}
