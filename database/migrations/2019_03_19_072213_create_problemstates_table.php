<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problemstates', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('collect_submit');
            $table->string('all_submit');
            $table->string('passing_rate');
            $table->integer('problem_id')->unsigned();
            $table->foreign('problem_id')->references('id')->on('problems');
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
        Schema::table('problemstates', function (Blueprint $table) {
            //
        });
    }
}
