<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class studentFeeAmount extends Model
{
    public function feeCategory()
    {
        return $this->belongsTo('App\model\studentFeeCategory', 'fee_category_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo('App\model\studentClass', 'class_id', 'id');
    }
}
