<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $canonical_id
 * @property-read \Illuminate\Database\Eloquent\Collection<ChangelogEntry> $changelogEntries
 * @property \Carbon\Carbon|null $created_at
 * @property-read string|null $created_at_json
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string|null $updated_at_json
 * @property-read User|null $user
 * @property int|null $user_id
 * @property string|null $username
 */
class GithubUser extends Model
{
    public static function importFromGithub(array $apiUser, ?User $user = null): static
    {
        $params = [
            'canonical_id' => $apiUser['id'],
            'username' => $apiUser['login'],
        ];
        if ($user !== null) {
            $params['user_id'] = $user->getKey();
        }

        $githubUser = static::where('canonical_id', $params['canonical_id'])->first()
            ?? static::where('username', $params['username'])->last();

        if ($githubUser === null) {
            return static::create($params);
        } else {
            $githubUser->update($params);
            return $githubUser;
        }
    }

    public function changelogEntries(): HasMany
    {
        return $this->hasMany(ChangelogEntry::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function displayName(): string
    {
        return presence($this->username)
            ?? $this->osuUsername()
            ?? '[no name]';
    }

    public function githubUrl(): ?string
    {
        if (present($this->username)) {
            return "https://github.com/{$this->username}";
        }
    }

    public function osuUsername(): ?string
    {
        return $this->user?->username;
    }

    public function userUrl(): ?string
    {
        if ($this->user_id !== null) {
            return route('users.show', $this->user_id);
        }
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'canonical_id',
            'id',
            'user_id',
            'username' => $this->getRawAttribute($key),

            'created_at',
            'updated_at' => $this->getTimeFast($key),

            'created_at_json',
            'updated_at_json' => $this->getJsonTimeFast($key),

            'changelogEntries',
            'user' => $this->getRelationValue($key),
        };
    }
}
