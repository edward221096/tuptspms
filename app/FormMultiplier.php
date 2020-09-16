<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormMultiplier extends Model
{
    protected $table = "formmultipliers";
    protected $fillable = ['form_name', 'function_name', 'multiplier'];
    public $timestamps = false;
}
