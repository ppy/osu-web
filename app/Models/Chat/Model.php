<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Chat;

use App\Models\Model as BaseModel;

abstract class Model extends BaseModel
{
    protected $connection = 'mysql-chat';
    public $timestamps = false;
}
