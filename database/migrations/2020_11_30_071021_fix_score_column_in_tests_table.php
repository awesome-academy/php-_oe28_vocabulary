<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpOption\None;

class FixScoreColumnInTestsTable extends Migration
{
    public function up()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->unsignedBigInteger('score')->nullable()->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->unsignedBigInteger('score')->nullable(false)->change();
        });
    }
}
