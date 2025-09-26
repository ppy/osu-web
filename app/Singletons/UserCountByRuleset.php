<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Models\Beatmap;
use App\Models\Count;
use App\Models\UserStatistics;
use App\Traits\Memoizes;

class UserCountByRuleset
{
    use Memoizes;

    private const KEY = 'user_count_by_ruleset';

    public static function getFromDb(): array
    {
        $counts = ['_all' => Count::totalUsers()->count];
        foreach (Beatmap::MODES as $rulesetName => $rulesetId) {
            $counts[$rulesetName] = UserStatistics\Model
                ::getClass($rulesetName)
                ::select('user_id')
                ->count();
        }

        return $counts;
    }

    public static function update(): void
    {
        \Cache::put(static::KEY, static::getFromDb());
    }

    public function get(?string $rulesetName): ?int
    {
        $data = $this->memoize(__FUNCTION__, fn (): ?array => \Cache::get(static::KEY));

        return $data[$rulesetName ?? '_all'] ?? null;
    }
}
