<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\User;

class UserStatisticsRulesetsTransformer extends TransformerAbstract
{
    protected $gameModeIncludes;

    public function __construct()
    {
        foreach (Beatmap::MODES as $modeStr => $modeInt) {
            $this->availableIncludes[] = $modeStr;
            $this->gameModeIncludes[camel_case("include_{$modeStr}")] = $modeStr;
        }
    }

    public function transform()
    {
        return [];
    }

    public function __call($name, $arguments)
    {
        $mode = $this->gameModeIncludes[$name] ?? null;
        if ($mode !== null) {
            return $this->gameModeInclude($arguments[0], $mode);
        }
    }

    private function gameModeInclude(User $user, string $mode)
    {
        $statistics = $user->statistics($mode);

        if ($statistics !== null) {
            return $this->item($statistics, new UserStatisticsTransformer());
        }
    }
}
