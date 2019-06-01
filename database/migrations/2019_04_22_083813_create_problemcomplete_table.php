<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemcompleteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problemcompletes', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->boolean('completed');
            $table->string('student_number');
            $table->foreign('student_number')->references('student_number')->on('users')->onDelete('cascade');
            $table->bigInteger('problem_id')->unsigned();
            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('cascade');
            $table->string('classname');
            $table->string('chapter');
            $table->string('section');
            $table->string('type');
            $table->string('answer_save');
            $table->string('rightness');
            $table->string('comment');
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
        Schema::dropIfExists('problemcomplete');
    }
}
