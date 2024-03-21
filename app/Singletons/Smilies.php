<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Models\Smiley;
use App\Traits\Memoizes;

class Smilies
{
    use Memoizes;

    public function all(): array
    {
        return $this->memoize(__FUNCTION__, fn () => $this->fetch());
    }

    public function replacer(): array
    {
        return $this->memoize(__FUNCTION__, function () {
            $smilies = $this->all();

            $patterns = [];
            $replacements = [];

            foreach ($smilies as $smiley) {
                $patterns[] = '#(?<=^|[\n .])'.preg_quote($smiley['code'], '#').'(?![^<>]*>)#';
                $replacements[] = '<!-- s'.$smiley['code'].' --><img src="{SMILIES_PATH}/'.$smiley['smiley_url'].'" alt="'.$smiley['code'].'" title="'.$smiley['emotion'].'" /><!-- s'.$smiley['code'].' -->';
            }

            return compact('patterns', 'replacements');
        });
    }

    private function fetch(): array
    {
        return Smiley::orderBy(\DB::raw('LENGTH(code)'), 'desc')->get()->toArray();
    }
}
