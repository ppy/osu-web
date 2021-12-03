<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\PlaylistItem;
use App\Transformers\BeatmapCompactTransformer;
use App\Transformers\TransformerAbstract;

class PlaylistItemTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap',
    ];

    public function transform(PlaylistItem $item)
    {
        return [
            'id' => $item->id,
            'room_id' => $item->room_id,
            'beatmap_id' => $item->beatmap_id,
            'ruleset_id' => $item->ruleset_id,
            'allowed_mods' => $item->allowed_mods,
            'required_mods' => $item->required_mods,
            'expired' => $item->expired,
            'owner_id' => $item->owner_id,
            'playlist_order' => $item->playlist_order,
        ];
    }

    public function includeBeatmap(PlaylistItem $item)
    {
        return $this->item(
            $item->beatmap,
            new BeatmapCompactTransformer()
        );
    }
}
