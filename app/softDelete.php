<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class softDelete extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
}
