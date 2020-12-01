<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixIsTrueColumnInTestWordTable extends Migration
{
    public function up()
    {
        Schema::table('test_word', function (Blueprint $table) {
            $table->unsignedBigInteger('is_true')->nullable()->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('test_word', function (Blueprint $table) {
            $table->unsignedBigInteger('is_true')->nullable(false)->change();
        });
    }
}
