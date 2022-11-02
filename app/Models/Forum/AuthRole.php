<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

/**
 * @property int $auth_option_id
 * @property int $auth_setting
 * @property int $role_id
 */
class AuthRole extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['role_id', 'auth_option_id'];
    protected $table = 'phpbb_acl_roles_data';
}
