<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class updatecommentstable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->boolean('active')->default(true);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('active')->default(true);
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('status');
            $table->dropColumn('active');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
}

