<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Solo;

use App\Libraries\ModsHelper;
use App\Libraries\ScoreCheck;
use App\Models\Beatmap;
use App\Models\Model;
use App\Models\Score as LegacyScore;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

/**
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property \stdClass $data
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $id
 * @property bool $preserve
 * @property int $ruleset_id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class Score extends Model
{
    use SoftDeletes;

    protected $table = 'solo_scores';
    protected $casts = [
        'preserve' => 'boolean',
    ];

    private ?stdClass $currentData = null;

    public static function createFromJsonOrExplode(array $params)
    {
        $score = new static([
            'beatmap_id' => $params['beatmap_id'],
            'ruleset_id' => $params['ruleset_id'],
            'user_id' => $params['user_id'],
            'data' => (object) $params,
        ]);

        ScoreCheck::assertCompleted($score);

        // this should potentially just be validation rather than applying this logic here, but
        // older lazer builds potentially submit incorrect details here (and we still want to
        // accept their scores.
        if (!$score->data->passed) {
            $score->data->rank = 'D';
        }

        $score->saveOrExplode();

        return $score;
    }

    public static function addMissingDataAttributes(stdClass $data)
    {
        static $attributes = [
            'accuracy' => null,
            'beatmap_id' => null,
            'build_id' => null,
            'ended_at' => null,
            'max_combo' => null,
            'mods' => null,
            'passed' => false,
            'rank' => null,
            'ruleset_id' => null,
            'started_at' => null,
            'statistics' => null,
            'total_score' => null,
            'user_id' => null,
        ];

        foreach ($attributes as $key => $default) {
            $data->$key ??= $default;
        }

        return $data;
    }

    public function getDataAttribute(?string $value)
    {
        return $this->currentData ??= static::addMissingDataAttributes(json_decode($value ?? '{}'));
    }

    public function setDataAttribute(stdClass $value)
    {
        $this->currentData = null;
        $this->attributes['data'] = json_encode($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createLegacyEntryOrExplode()
    {
        static $statAttrs = [
            'good',
            'great',
            'large_tick_hit',
            'large_tick_miss',
            'meh',
            'miss',
            'ok',
            'perfect',
            'small_tick_hit',
            'small_tick_miss',
        ];
        $origStatistics = $this->data->statistics;
        $statistics = [];

        foreach ($statAttrs as $attr) {
            $altCaseAttr = studly_case($attr);
            $statistics[$attr] = get_int($origStatistics->$attr ?? $origStatistics->$altCaseAttr ?? 0) ?? 0;
        }

        $scoreClass = LegacyScore\Model::getClass($this->ruleset_id);

        $score = new $scoreClass([
            'beatmap_id' => $this->beatmap_id,
            'beatmapset_id' => optional($this->beatmap)->beatmapset_id ?? 0,
            'countmiss' => $statistics['miss'],
            'enabled_mods' => ModsHelper::toBitset(array_column($this->data->mods, 'acronym')),
            'maxcombo' => $this->data->max_combo,
            'pass' => $this->data->passed,
            'perfect' => $this->data->passed && $statistics['miss'] + $statistics['large_tick_miss'] === 0,
            'rank' => $this->data->rank,
            'score' => $this->data->total_score,
            'scorechecksum' => "\0",
            'user_id' => $this->user_id,
        ]);

        switch (Beatmap::modeStr($this->ruleset_id)) {
            case 'osu':
                $score->count300 = $statistics['great'];
                $score->count100 = $statistics['ok'];
                $score->count50 = $statistics['meh'];
                break;
            case 'taiko':
                $score->count300 = $statistics['great'];
                $score->count100 = $statistics['ok'];
                break;
            case 'fruits':
                $score->count300 = $statistics['great'];
                $score->count100 = $statistics['large_tick_hit'];
                $score->countkatu = $statistics['small_tick_miss'];
                $score->count50 = $statistics['small_tick_hit'];
                break;
            case 'mania':
                $score->countgeki = $statistics['perfect'];
                $score->count300 = $statistics['great'];
                $score->countkatu = $statistics['good'];
                $score->count100 = $statistics['ok'];
                $score->count50 = $statistics['meh'];
                break;
        }

        $score->saveOrExplode();

        return $score;
    }

    public function refresh()
    {
        $this->currentData = null;

        parent::refresh();
    }

    public function save(array $options = [])
    {
        $this->attributes['data'] = json_encode($this->data);

        return parent::save($options);
    }
}
