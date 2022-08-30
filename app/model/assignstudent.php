<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;



class assignstudent extends Model
{
    public function studentData()
    {
        return $this->belongsTo('App\User', 'student_id','id');
    }

    public function year()
    {
        return $this->belongsTo('App\model\studentYear', 'year_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo('App\model\studentClass', 'class_id', 'id');
    }

    public function studentdiscount()
    {
        return $this->belongsTo('App\model\discountstudent','id', 'assign_student_id')->where('fee_category_id','4');
    }


    public function studentmonthdiscount()
    {
        return $this->belongsTo('App\model\discountstudent','id', 'assign_student_id')->where('fee_category_id','1');

    }

    public function studentexamdiscount()
    {
        return $this->belongsTo('App\model\discountstudent','id', 'assign_student_id')->where('fee_category_id','2');

    }




}
