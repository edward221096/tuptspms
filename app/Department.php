<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table="departments";
    protected $fillable = ['id', 'division_id', 'dept_name'];
    public $timestamps = false;
}
