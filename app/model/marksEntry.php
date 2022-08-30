<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class marksEntry extends Model
{
    public function studentData()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }

    public function assign_subject(){
        return $this->belongsTo('App\model\assignsubject','assign_subject_id','id');
    }

    public function year(){
        return $this->belongsTo('App\model\studentYear','year_id','id');
    }

    public function class(){
        return $this->belongsTo('App\model\studentClass','class_id','id');
    }

    public function exam_type(){
        return $this->belongsTo('App\model\ExamType','exam_type_id','id');
    }
}
