<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'id';
    protected $visible = ['name'];
    protected $guarded = [];
    protected $casts = [
      'id' => 'integer',
      'name' => 'string',
    ];

    public static function lookup($teamname_or_id, $lookup_type = null, $find_all = false)
    {
        if (!present($teamname_or_id)) {
            return;
        }

        switch ($lookup_type) {
            case 'string':
                $team = self::where('name', $teamname_or_id)->orWhere('name_clean', $teamname_or_id);
                break;

            case 'id':
                $team = self::where('id', $teamname_or_id);
                break;

            default:
                if (is_numeric($teamname_or_id)) {
                    $team = self::where('id', $teamname_or_id);
                } else {
                    $team = self::where('name', $teamname_or_id)->orWhere('name_clean', $teamname_or_id);
                }
                break;
        }

        if (!$find_all) {
            $team = $team;
        }

        return $team->first();
    }

    public function teamMembers()
    {
        return $this->belongsToMany('App\Models\User', 'team_members')->withPivot('is_admin');
    }
}
