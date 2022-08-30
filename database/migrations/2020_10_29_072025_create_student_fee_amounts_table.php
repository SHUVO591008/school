<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFeeAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fee_amounts', function (Blueprint $table) {
            $table->id();
            $table->integer('fee_category_id');
            $table->integer('class_id');
            $table->double('amount');
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
        Schema::dropIfExists('student_fee_amounts');
    }
}
