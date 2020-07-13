<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "ratings";
    public $timestamps = false;
    public $fillable = ['user_id'];
}
