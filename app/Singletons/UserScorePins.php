<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Libraries\MorphMap;
use App\Models\Beatmap;
use App\Models\Score;
use App\Models\ScorePin;
use App\Models\Solo;

class UserScorePins
{
    const REQUEST_ATTRIBUTE_KEY_PREFIX = 'current_user_score_pins:';

    public function isPinned(Score\Best\Model|Solo\Score $score): bool
    {
        $type = $score->getMorphClass();
        $key = static::REQUEST_ATTRIBUTE_KEY_PREFIX.$type;
        $pins = request()->attributes->get($key);

        if ($pins === null) {
            $user = auth()->user();
            $pins = $user === null
                ? []
                : $user->scorePins()
                ->select('score_id')
                ->where(['score_type' => $type])
                ->get()
                ->keyBy(fn (ScorePin $p) => $p->score_id);

            request()->attributes->set($key, $pins);
        }

        return isset($pins[$score->getKey()]);
    }

    public function reset(): void
    {
        $prefix = static::REQUEST_ATTRIBUTE_KEY_PREFIX;
        $attributes = request()->attributes;

        $attributes->remove($prefix.MorphMap::getType(Solo\Score::class));

        foreach (Beatmap::MODES as $ruleset => $rulesetId) {
            $type = MorphMap::getType(Score\Best\Model::getClass($ruleset));
            $attributes->remove("{$prefix}{$type}");
        }
    }
}
