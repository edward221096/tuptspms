<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table="sections";
    protected $fillable = ['id', 'dept_id', 'section_name'];
    public $timestamps = false;
}
