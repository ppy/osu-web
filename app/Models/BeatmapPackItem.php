<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Beatmapset $beatmapset
 * @property int $beatmapset_id
 * @property int $item_id
 * @property BeatmapPack $pack
 * @property int $pack_id
 */
class BeatmapPackItem extends Model
{
    protected $table = 'osu_beatmappacks_items';
    protected $primaryKey = 'item_id';
    public $timestamps = false;

    public function pack()
    {
        return $this->belongsTo(BeatmapPack::class, 'pack_id');
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }
}
