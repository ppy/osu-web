<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Transformers;

use App\Models\ContestEntry;
use League\Fractal;

class ContestEntryTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'results',
        'artMeta',
    ];

    public function transform(ContestEntry $entry)
    {
        return [
            'id' => $entry->id,
            'title' => $entry->contest->unmasked ? $entry->name : $entry->masked_name,
            'preview' => $entry->entry_url,
        ];
    }

    public function includeResults(ContestEntry $entry)
    {
        return $this->item($entry, function ($entry) {
            return [
                'actual_name' => $entry->name,
                'user_id' => $entry->user_id,
                'username' => ($entry->user ?? (new \App\Models\DeletedUser))->username,
                'votes' => (int) $entry->votes_count,
            ];
        });
    }

    public function includeArtMeta(ContestEntry $entry)
    {
        if ($entry->contest->type !== 'art' || !presence($entry->entry_url)) {
            return $this->item($entry, function ($entry) {
                return [];
            });
        }

        return $this->item($entry, function ($entry) {
            $size = fast_imagesize($entry->entry_url);
            $thumb = $entry->entry_url;

            if (present(config('osu.assets.mini_url')) && present(config('osu.assets.mini_url'))) {
                $thumb = str_replace(config('osu.assets.base_url'), config('osu.assets.mini_url'), $thumb);
            }

            return [
                'width' => $size[0],
                'height' => $size[1],
                'thumb' => $thumb,
            ];
        });
    }
}
