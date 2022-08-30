<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class accountstudentfee extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','student_id','id');
    }

    public function year()
    {
        return $this->belongsTo('App\model\studentYear', 'year_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo('App\model\studentClass', 'class_id', 'id');
    }

    public function feeCategory()
    {
        return $this->belongsTo('App\model\studentFeeCategory', 'fee_category_id', 'id');
    }


}
