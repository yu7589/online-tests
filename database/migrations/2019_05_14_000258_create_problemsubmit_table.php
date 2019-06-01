<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsubmitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problemsubmit', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('student_number');
            $table->foreign('student_number')->references('student_number')->on('users')->onDelete('cascade');
            $table->string('problem_id');
            $table->string('student_answer');
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
        Schema::dropIfExists('problemsubmit');
    }
}
