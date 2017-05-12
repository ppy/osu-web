<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuildPropagationHistory extends Model
{
    protected $table = 'osu_build_propagation_history';
    const UPDATED_AT = null;

    protected $guarded = [];
}
