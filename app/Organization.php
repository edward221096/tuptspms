<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Organization extends Model
{
    protected $table="organizations";
    protected $fillable = ['division_name', 'dept_name', 'section_name'];
    public $timestamps = false;

    public function mfos(){
        return $this->hasMany('App\Organization');
    }
}
