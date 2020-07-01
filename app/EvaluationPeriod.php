<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationPeriod extends Model
{
    protected $table="evaluationperiods";
    protected $fillable = ['evaluation_startdate', 'evaluation_enddate'];
    public $timestamps = false;
}
