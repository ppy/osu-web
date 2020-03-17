<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property int|null $canonical_id
 * @property \Illuminate\Database\Eloquent\Collection $changelogEntries ChangelogEntry
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int|null $user_id
 * @property string|null $username
 */
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
