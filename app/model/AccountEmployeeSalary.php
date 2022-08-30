<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class AccountEmployeeSalary extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','employee_id','id');
    }
}
