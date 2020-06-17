<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table="forms";
    protected $fillable = ['form_type'];
    public $timestamps = false;


    public function mfos(){
        return $this->hasMany('App\Mfo');
    }
}
