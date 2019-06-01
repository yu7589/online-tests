<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('classname');
            $table->string('chapter');
            $table->string('section');
            $table->string('stem');
            $table->string('picture_url');
            $table->string('picture_ur2');
            $table->string('answer');
            $table->string('explanation');
            $table->string('type');
            $table->string('used');
            $table->float('difficulty', 4, 2);
            $table->string('author');
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
        Schema::dropIfExists('problems');
    }
}
