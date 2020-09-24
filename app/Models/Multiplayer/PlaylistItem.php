<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Libraries\Multiplayer\Mod;
use App\Libraries\Multiplayer\Ruleset;
use App\Models\Beatmap;
use App\Models\Model;

/**
 * @property json|null $allowed_mods
 * @property Beatmap $beatmap
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property int|null $playlist_order
 * @property json|null $required_mods
 * @property Room $room
 * @property int $room_id
 * @property int|null $ruleset_id
 * @property \Illuminate\Database\Eloquent\Collection $scores Score
 * @property \Carbon\Carbon|null $updated_at
 */
class PlaylistItem extends Model
{
    protected $table = 'multiplayer_playlist_items';
    protected $casts = [
        'allowed_mods' => 'object',
        'required_mods' => 'object',
    ];

    public static function assertBeatmapsExist(array $playlistItems)
    {
        $requestedBeatmapIds = array_map(function ($item) {
            return $item->beatmap_id;
        }, $playlistItems);

        $beatmapIds = Beatmap::whereIn('beatmap_id', $requestedBeatmapIds)->pluck('beatmap_id')->all();
        $missing = array_diff($requestedBeatmapIds, $beatmapIds);

        if ($missing !== []) {
            $missingText = implode(', ', $missing);
            throw new InvariantException("beatmaps not found: {$missingText}");
        }
    }

    public static function fromJsonParams($json)
    {
        $obj = new self();
        foreach (['beatmap_id', 'ruleset_id'] as $field) {
            $obj->$field = array_get($json, $field);
            if (!present($obj->$field)) {
                throw new InvariantException("{$field} is required.");
            }
        }

        $obj->allowed_mods = Mod::parseInputArray(
            array_get($json, 'allowed_mods') ?? [],
            $obj->ruleset_id
        );

        $obj->required_mods = Mod::parseInputArray(
            array_get($json, 'required_mods') ?? [],
            $obj->ruleset_id
        );

        return $obj;
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id')->withTrashed();
    }

    public function highScores()
    {
        return $this->hasMany(PlaylistItemUserHighScore::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function topScores()
    {
        return $this->highScores()
            ->with('score')
            ->orderBy('total_score', 'desc')
            ->orderBy('score_id', 'asc');
    }

    private function validateRuleset()
    {
        // osu beatmaps can be played in any mode, but non-osu maps can only be played in their specific modes
        if ($this->beatmap->playmode !== Ruleset::OSU && $this->beatmap->playmode !== $this->ruleset_id) {
            throw new InvariantException("invalid ruleset_id for beatmap {$this->beatmap->beatmap_id}");
        }
    }

    private function validateModOverlaps()
    {
        $dupeMods = array_intersect(
            array_column($this->allowed_mods, 'acronym'),
            array_column($this->required_mods, 'acronym')
        );

        if (count($dupeMods) > 0) {
            throw new InvariantException('mod cannot be listed as both allowed and required: '.implode(', ', $dupeMods));
        }
    }

    public function save(array $options = [])
    {
        $this->validateRuleset();
        $this->validateModOverlaps();
        Mod::validateSelection(array_column($this->allowed_mods, 'acronym'), $this->ruleset_id, true);
        Mod::validateSelection(array_column($this->required_mods, 'acronym'), $this->ruleset_id);

        return parent::save($options);
    }
}
