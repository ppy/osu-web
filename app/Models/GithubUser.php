<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Note: `$canonical_id`, `$id`, and `$username` are null when this model is
 *       created for use in legacy changelog entries.
 *
 * @property int $canonical_id
 * @property-read \Illuminate\Database\Eloquent\Collection<ChangelogEntry> $changelogEntries
 * @property \Carbon\Carbon|null $created_at
 * @property-read string|null $created_at_json
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string|null $updated_at_json
 * @property-read User|null $user
 * @property int|null $user_id
 * @property string $username
 */
class GithubUser extends Model
{
    /**
     * Check if the app is capable of authenticating users via the GitHub API.
     */
    public static function canAuthenticate(): bool
    {
        return $GLOBALS['cfg']['osu']['github']['client_id'] !== null
            && $GLOBALS['cfg']['osu']['github']['client_secret'] !== null;
    }

    /**
     * Create or update a GitHub user with data from the GitHub API.
     */
    public static function importFromGithub(array $apiUser): static
    {
        return static::updateOrCreate(
            ['canonical_id' => $apiUser['id']],
            [
                'canonical_id' => $apiUser['id'],
                'username' => $apiUser['login'],
            ],
        );
    }

    public function changelogEntries(): HasMany
    {
        return $this->hasMany(ChangelogEntry::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function displayUsername(): string
    {
        return $this->username ?? $this->user?->username ?? '[no name]';
    }

    public function githubUrl(): ?string
    {
        return $this->username !== null
            ? "https://github.com/{$this->username}"
            : null;
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
