<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountstudentfeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountstudentfees', function (Blueprint $table) {
            $table->id();
            $table->integer('year_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('student_id')->nullable()->comment('student_id=user_id');
            $table->integer('fee_category_id')->nullable();
            $table->string('date')->nullable();
            $table->double('amount')->nullable();
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
        Schema::dropIfExists('accountstudentfees');
    }
}
