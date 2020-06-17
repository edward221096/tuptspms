<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mfo extends Model
{
    protected $table = "mfos";
    protected $fillable = ['mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc'];
    public $timestamps = false;

    public function functiontype(){
        return $this->belongsTo('App\FunctionType');
    }

    public function departments(){
        return $this->belongsTo('App\Department');
    }

    public function forms(){
        return $this->belongsTo('App\Form');
    }


}
