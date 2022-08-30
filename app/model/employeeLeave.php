<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class employeeLeave extends Model
{
    public function userData()
    {
        return $this->belongsTo('App\User','employee_id','id');
    }

    public function purpose()
    {
        return $this->belongsTo('App\model\leavePurpose','leave_purpose_id','id');
    }

 

}
