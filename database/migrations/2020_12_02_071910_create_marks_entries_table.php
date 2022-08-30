<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks_entries', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->comment('student_id=user_id');
            $table->integer('id_no')->nullable();
            $table->integer('year_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('assign_subject_id')->nullable();
            $table->integer('exam_type_id')->nullable();
            $table->double('marks')->nullable();
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
        Schema::dropIfExists('marks_entries');
    }
}
