<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixNoteColumnInWordsTable extends Migration
{
    public function up()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->string('note', 255)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->string('note', 255)->nullable(false)->change();
        });
    }
}
