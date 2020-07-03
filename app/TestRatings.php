<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestRatings extends Model
{
    public $timestamps = false;
    public $table = "testratings";
    public $fillable = ['mfo_id', 'function_name', 'average', 'total_weighted_score'];
}
