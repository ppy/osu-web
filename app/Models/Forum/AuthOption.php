<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

/**
 * @property string $auth_option
 * @property int $auth_option_id
 * @property int $founder_only
 * @property int $is_global
 * @property int $is_local
 */
class AuthOption extends Model
{
    protected $table = 'phpbb_acl_options';

    protected $primaryKey = 'auth_option_id';
    public $timestamps = false;
}
