<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\Model;
use App\Models\ScoreToken;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property json|null $allowed_mods
 * @property Beatmap $beatmap
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property int $owner_id
 * @property int|null $playlist_order
 * @property json|null $required_mods
 * @property bool $freestyle
 * @property Room $room
 * @property int $room_id
 * @property int|null $ruleset_id
 * @property \Illuminate\Database\Eloquent\Collection $scoreLinks ScoreLink
 * @property \Carbon\Carbon|null $updated_at
 * @property bool expired
 * @property \Carbon\Carbon|null $played_at
 */
class PlaylistItem extends Model
{
    protected $table = 'multiplayer_playlist_items';
    protected $casts = [
        'allowed_mods' => 'object',
        'expired' => 'boolean',
        'freestyle' => 'boolean',
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

        $obj->freestyle = get_bool($json['freestyle'] ?? false);
        $obj->max_attempts = get_int($json['max_attempts'] ?? null);

        $modsHelper = app('mods');
        $obj->allowed_mods = $modsHelper->parseInputArray(
            $obj->ruleset_id,
            $json['allowed_mods'] ?? [],
        );

        $obj->required_mods = $modsHelper->parseInputArray(
            $obj->ruleset_id,
            $json['required_mods'] ?? [],
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

    public function scoreLinks()
    {
        return $this->hasMany(ScoreLink::class);
    }

    public function scoreTokens(): HasMany
    {
        return $this->hasMany(ScoreToken::class);
    }

    public function save(array $options = [])
    {
        $this->assertValid();

        return parent::save($options);
    }

    public function scorePercentile(): array
    {
        $key = "playlist_item_score_percentile:v2:{$this->getKey()}";

        if (!$this->expired && !$this->room->hasEnded()) {
            $key .= ':ongoing';
        }

        return \Cache::remember($key, 600, function (): array {
            $scores = $this->highScores()
                ->passing()
                ->orderBy('total_score', 'DESC')
                ->pluck('total_score');
            $count = count($scores);

            return $count === 0
                ? [
                    'top_10p' => 0,
                    'top_50p' => 0,
                ] : [
                    'top_10p' => $scores[max(0, (int) ($count * 0.1) - 1)],
                    'top_50p' => $scores[max(0, (int) ($count * 0.5) - 1)],
                ];
        });
    }

    public function assertValid()
    {
        $this->assertValidMaxAttempts();
        $this->assertValidRuleset();
        $this->assertValidMods();
    }

    private function assertValidMaxAttempts()
    {
        if ($this->max_attempts === null) {
            return;
        }

        $maxAttemptsLimit = $GLOBALS['cfg']['osu']['multiplayer']['max_attempts_limit'];
        if ($this->max_attempts < 1 || $this->max_attempts > $maxAttemptsLimit) {
            throw new InvariantException("field 'max_attempts' must be between 1 and {$maxAttemptsLimit}");
        }
    }

    private function assertValidRuleset()
    {
        // osu beatmaps can be played in any mode, but non-osu maps can only be played in their specific modes
        if (!$this->beatmap->canBeConvertedTo($this->ruleset_id)) {
            throw new InvariantException("invalid ruleset_id for beatmap {$this->beatmap->beatmap_id}");
        }
    }

    private function assertValidMods()
    {
        // Freestyle unconditionally allows all freemods, so we'll expect them to not be specified.
        if ($this->freestyle && count($this->allowed_mods) !== 0) {
            throw new InvariantException('allowed mods cannot be specified on freestyle items');
        }

        $allowedModIds = array_column($this->allowed_mods, 'acronym');
        $requiredModIds = array_column($this->required_mods, 'acronym');

        $dupeMods = array_intersect($allowedModIds, $requiredModIds);
        if (count($dupeMods) > 0) {
            throw new InvariantException('mod cannot be listed as both allowed and required: '.implode(', ', $dupeMods));
        }

        $isRealtimeRoom = $this->room->isRealtime();
        $modsHelper = app('mods');
        $modsHelper->assertValidForMultiplayer($this->ruleset_id, $allowedModIds, false, $isRealtimeRoom, $this->freestyle);
        $modsHelper->assertValidForMultiplayer($this->ruleset_id, $requiredModIds, true, $isRealtimeRoom, $this->freestyle);
        $modsHelper->assertValidMultiplayerExclusivity($this->ruleset_id, $requiredModIds, $allowedModIds);
    }
}
