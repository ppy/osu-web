<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Libraries\Multiplayer\Mod;
use App\Libraries\Multiplayer\Ruleset;
use App\Models\Beatmap;
use App\Models\Model;
use App\Models\User;

/**
 * @property json|null $allowed_mods
 * @property Beatmap $beatmap
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property int $owner_id
 * @property int|null $playlist_order
 * @property json|null $required_mods
 * @property Room $room
 * @property int $room_id
 * @property int|null $ruleset_id
 * @property \Illuminate\Database\Eloquent\Collection $scores Score
 * @property \Carbon\Carbon|null $updated_at
 * @property bool expired
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

    public static function fromJsonParams(User $owner, $json)
    {
        $obj = new self();
        foreach (['beatmap_id', 'ruleset_id'] as $field) {
            $value = get_int($json[$field] ?? null);
            if ($value === null) {
                throw new InvariantException("{$field} is required.");
            }
            $obj->$field = $value;
        }

        $obj->max_attempts = get_int($json['max_attempts'] ?? null);

        $obj->allowed_mods = Mod::parseInputArray(
            $json['allowed_mods'] ?? [],
            $obj->ruleset_id
        );

        $obj->required_mods = Mod::parseInputArray(
            $json['required_mods'] ?? [],
            $obj->ruleset_id
        );

        $obj->owner_id = $owner->getKey();

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

    private function assertValidMaxAttempts()
    {
        if ($this->max_attempts === null) {
            return;
        }

        $maxAttemptsLimit = config('osu.multiplayer.max_attempts_limit');
        if ($this->max_attempts < 1 || $this->max_attempts > $maxAttemptsLimit) {
            throw new InvariantException("field 'max_attempts' must be between 1 and {$maxAttemptsLimit}");
        }
    }

    private function validateRuleset()
    {
        // osu beatmaps can be played in any mode, but non-osu maps can only be played in their specific modes
        if ($this->beatmap->playmode !== Ruleset::OSU && $this->beatmap->playmode !== $this->ruleset_id) {
            throw new InvariantException("invalid ruleset_id for beatmap {$this->beatmap->beatmap_id}");
        }
    }

    private function assertValidMods()
    {
        $allowedModIds = array_column($this->allowed_mods, 'acronym');
        $requiredModIds = array_column($this->required_mods, 'acronym');

        $dupeMods = array_intersect($allowedModIds, $requiredModIds);
        if (count($dupeMods) > 0) {
            throw new InvariantException('mod cannot be listed as both allowed and required: '.implode(', ', $dupeMods));
        }

        Mod::validateSelection($allowedModIds, $this->ruleset_id);
        Mod::validateSelection($requiredModIds, $this->ruleset_id);
        Mod::assertValidExclusivity($requiredModIds, $allowedModIds, $this->ruleset_id);
    }

    public function save(array $options = [])
    {
        $this->assertValidMaxAttempts();
        $this->validateRuleset();
        $this->assertValidMods();

        return parent::save($options);
    }
}
