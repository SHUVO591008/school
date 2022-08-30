<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class upazila extends Model
{
    public function district(){
        return $this->belongsTo(District::class,'district_id','id');
    }

    public function division(){
        return $this->belongsTo(Division::class,'division_id','id');
    }
}
