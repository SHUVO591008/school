<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class cost extends Model
{
    public function category()
    {
        return $this->belongsTo('App\model\CostCategory','category_id','id');
    }

}
