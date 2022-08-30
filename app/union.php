<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class union extends Model
{
    public function district(){
        return $this->belongsTo(District::class,'district_id','id');
    }

    public function division(){
        return $this->belongsTo(Division::class,'division_id','id');
    }

    public function upazila(){
        return $this->belongsTo(upazila::class,'upazila_id','id');
    }
}
