<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph;

use App\Models\Beatmap;
use App\Models\User;

class UserOpengraph
{
    public function __construct(private User $user, private string $page, private ?string $ruleset = null)
    {
    }

    public function get(): array
    {
        return [
            // none for multiplayer, playlist counts seems...not useful?
            'description' => $this->page === 'modding' ? $this->moddingDescription() : $this->showDescription(),
            'image' => $this->user->user_avatar,
            'title' => blade_safe(escape_username($this->user->username)),
        ];
    }

    private function moddingDescription(): string
    {
        static $statuses = ['ranked', 'loved', 'pending', 'graveyard'];

        $countsText = [];
        foreach ($statuses as $status) {
            $count = $this->user->profileBeatmapsetCountByGroupedStatus($status);
            if ($count > 0) {
                $countsText[] = osu_trans("beatmapsets.show.status.{$status}").' '.number_format($count);
            }
        }

        return empty($countsText)
            ? osu_trans('users.ogp.modding_description_empty')
            : osu_trans('users.ogp.modding_description', [
                'counts' => implode(' | ', $countsText),
            ]);
    }

    private function showDescription(): string
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
