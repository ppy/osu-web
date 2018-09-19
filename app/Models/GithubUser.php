<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

class GithubUser extends Model
{
    public static function importFromGithub($data)
    {
        $githubUser = static::where('canonical_id', '=', $data['id'])->first();

        if (isset($githubUser)) {
            $githubUser->update(['username' => $data['login']]);
        } else {
            $githubUser = static::where('username', '=', $data['login'])->last();

            if (isset($githubUser)) {
                $githubUser->update(['canonical_id' => $data['id']]);
            } else {
                $githubUser = static::create([
                    'canonical_id' => $data['id'],
                    'username' => $data['login'],
                ]);
            }
        }

        return $githubUser;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function changelogEntries()
    {
        return $this->hasMany(ChangelogEntry::class);
    }

    public function displayName()
    {
        return presence($this->username)
            ?? optional($this->user)->username
            ?? '[no name]';
    }

    public function githubUrl()
    {
        if (present($this->username)) {
            return "https://github.com/{$this->username}";
        }
    }

    public function userUrl()
    {
        if ($this->user_id !== null) {
            return route('users.show', $this->user_id);
        }
    }

    public function url()
    {
        return $this->githubUrl() ?? $this->userUrl();
    }
}
