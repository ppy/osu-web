<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuildPropagationHistory extends Model
{
    protected $guarded = [];

    public $timestamps = false;
    protected $dates = [
        'created_at',
    ];
}
