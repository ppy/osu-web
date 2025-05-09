<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits\Es;

trait UserSearch
{
    use BaseDbIndexable;

    public static function esIndexName()
    {
        return $GLOBALS['cfg']['osu']['elasticsearch']['prefix'].'users';
    }

    public static function esIndexingQuery()
    {
        return static::withoutGlobalScopes()
            ->with('usernameChangeHistoryPublic');
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/users.json');
    }

    protected function getEsFieldValue(string $field)
    {
        return match ($field) {
            'id' => $this->getKey(),
            'is_old' => $this->isOld(),
            'previous_usernames' => $this->previousUsernames(true)->unique()->values(),
            'user_lastvisit' => $this->displayed_last_visit,
            default => $this->$field,
        };
    }
}
