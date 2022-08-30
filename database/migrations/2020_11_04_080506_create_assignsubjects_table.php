<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignsubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignsubjects', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->double('full_marks');
            $table->double('pass_marks');
            $table->double('subjective_marks');
            $table->integer('created_by')->nullable();
            $table->integer('update_by')->nullable();
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
        Schema::dropIfExists('assignsubjects');
    }
}
