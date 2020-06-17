<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FunctionType extends Model
{
    protected $table = "functions";
    protected $fillable = ['function_name'];
    public $timestamps = false;

    public function mfos(){
        return $this->hasMany('App\Mfo');
    }
}
