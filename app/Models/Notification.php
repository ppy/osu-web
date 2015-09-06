<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models;

class Notification extends Eloquent
{
    // this means that we can simply $user->notifications()->delete()
    protected $softDelete = true;
    protected $table = 'osu_modding.notifications';
    protected $fillable = ['notification', 'user_id', 'group_id', 'var', 'link', 'global'];

    // konbini functions

    public static function generate($notification = [])
    {
        if (! $notification or (! $user and ! $group)) {
            return;
        }

        if (isset($notification['vars']) && is_array($notification['vars'])) {
            $vars = implode('|', $vars);
        }

        return new static($notification);
    }

    public static function generateForUser($notification, User $user)
    {
        $instance = self::generate($notification);

        $user->notifications()->save($instance);
    }

    public static function generateForGroup($notification, Group $group)
    {
        $instance = self::generate($notification);

        $group->notifications()->save($instance);
    }

    // a bunch of scopes we can assign to the model to narrow queries down

    public function scopeGlobal($query)
    {
        return $this->where('global', '=', 1);
    }

    public function scopeLatest($query, $count)
    {
        return $query
            ->orderBy('created_at', 'desc')
            ->take($count);
    }

    public function scopeType($query, $type)
    {
        return $query->where('notification', '=', $type);
    }

    // here we have relationships

    public function group($query, $id)
    {
        return $this->hasOne('Group', 'group_id', 'group_id');
    }

    public function user()
    {
        return $this->hasOne('Group', 'group_id', 'group_id');
    }
}
