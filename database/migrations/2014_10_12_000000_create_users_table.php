<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('usertype')->nullable()->comment('student,admin,employe');
            $table->string('role')->nullable()->comment('Admin=head of software,Operator=Computer Operator,User=Employee');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('religion')->nullable();
            $table->string('id_no')->nullable();
            $table->date('dob')->nullable();
            $table->date('join_date')->nullable();
            $table->integer('designation_id')->nullable();
            $table->double('salary')->nullable();
            $table->string('status')->default(1)->comment('0=Inactive,1=Active');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
