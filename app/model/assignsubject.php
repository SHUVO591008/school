<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class assignsubject extends Model
{
    public function class()
    {
        return $this->belongsTo('App\model\studentClass', 'class_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo('App\model\subject', 'subject_id', 'id');
    }

    // public function feeCategory()
    // {
    //     return $this->belongsTo('App\model\studentFeeCategory', 'fee_category_id', 'id');
    // }
}
