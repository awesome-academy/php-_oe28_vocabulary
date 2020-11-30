<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixAnswerColumnInTestWordTable extends Migration
{
    public function up()
    {
        Schema::table('test_word', function (Blueprint $table) {
            $table->string('answer', 255)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('test_word', function (Blueprint $table) {
            $table->string('answer', 255)->nullable(false)->change();
        });
    }
}
