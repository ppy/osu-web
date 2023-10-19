<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph;

use App\Models\Beatmap;
use App\Models\User;

class UserOpengraph
{
    public function __construct(private User $user, private string $ruleset)
    {
    }

    public function get()
    {
        return [
            'description' => $this->description(),
            'image' => $this->user->user_avatar,
            'title' => blade_safe(osu_trans('users.show.title', ['username' => $this->user->username])),
        ];
    }

    private function description(): string
    {
        static $rankTypes = ['country', 'global'];

        $ruleset = $this->ruleset ?? $this->user->playmode;
        $stats = $this->user->statistics($ruleset);

        $replacements['ruleset'] = $ruleset;

        foreach ($rankTypes as $type) {
            $method = "{$type}Rank";
            $replacements[$type] = osu_trans("users.ogp.description.{$type}", [
                'rank' => format_rank($stats?->$method()),
            ]);

            $variants = Beatmap::VARIANTS[$ruleset] ?? [];

            $variantsTexts = null;
            foreach ($variants as $variant) {
                $variantRank = $this->user->statistics($ruleset, false, $variant)?->$method();
                if ($variantRank !== null) {
                    $variantsTexts[] = $variant.' '.format_rank($variantRank);
                }
            }

            if (!empty($variantsTexts)) {
                $replacements[$type] .= ' ('.implode(', ', $variantsTexts).')';
            }
        }

        return osu_trans('users.ogp.description._', $replacements);
    }
}
