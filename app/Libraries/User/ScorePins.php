<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\Beatmap;
use App\Models\Score;
use App\Models\ScorePin;

class ScorePins
{
    const REQUEST_ATTRIBUTE_KEY_PREFIX = 'current_user_score_pins:';

    public function isPinned(Score\Best\Model $best): bool
    {
        $type = $best->getMorphClass();
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

        return isset($pins[$best->getKey()]);
    }

    public function reset(): void
    {
        foreach (Beatmap::MODES as $mode => $modeInt) {
            $class = Score\Best\Model::getClassByString($mode);
            $type = (new $class())->getMorphClass();
            request()->attributes->remove(static::REQUEST_ATTRIBUTE_KEY_PREFIX.$type);
        }
    }
}
