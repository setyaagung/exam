<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('group_id');
            $table->date('exam_date');
            $table->string('status');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('restrict');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
