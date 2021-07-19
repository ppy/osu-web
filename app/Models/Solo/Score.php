<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Solo;

use App\Exceptions\InvariantException;
use App\Libraries\ModsHelper;
use App\Libraries\ScoreCheck;
use App\Models\Beatmap;
use App\Models\Model;
use App\Models\Score as LegacyScore;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property float|null $accuracy
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $ended_at
 * @property int $id
 * @property int|null $max_combo
 * @property array|null $mods
 * @property bool|null $passed
 * @property float|null $pp
 * @property string|null $rank
 * @property int $ruleset_id
 * @property \Carbon\Carbon $started_at
 * @property array|null $statistics
 * @property int|null $total_score
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class Score extends Model
{
    use SoftDeletes;

    protected $table = 'solo_scores';
    protected $dates = ['started_at', 'ended_at'];
    protected $casts = [
        'passed' => 'boolean',
        'mods' => 'object',
        'statistics' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isCompleted(): bool
    {
        return $this->ended_at !== null;
    }

    public function complete(array $params): void
    {
        $this->fill($params);

        ScoreCheck::assertCompleted($this);

        // this should potentially just be validation rather than applying this logic here, but
        // older lazer builds potentially submit incorrect details here (and we still want to
        // accept their scores.
        //
        // also, "F" rank is not a thing in lazer yet (and may never be?).
        if ($this->passed == false)
            $this->rank = 'F';

        $this->save();
    }

    public function createLegacyEntry()
    {
        if (!$this->isCompleted()) {
            throw new InvariantException('creating legacy entry requires completed score');
        }

        $statAttrs = [
            'Good',
            'Great',
            'LargeTickHit',
            'LargeTickMiss',
            'Meh',
            'Miss',
            'Ok',
            'Perfect',
            'SmallTickMiss',
        ];
        $statistics = $this->statistics;

        foreach ($statAttrs as $attr) {
            $statistics[$attr] = get_int($statistics[$attr] ?? 0) ?? 0;
        }

        $scoreClass = LegacyScore\Model::getClass($this->ruleset_id);

        $score = new $scoreClass([
            'beatmap_id' => $this->beatmap_id,
            'beatmapset_id' => optional($this->beatmap)->beatmapset_id ?? 0,
            'countmiss' => $statistics['Miss'],
            'enabled_mods' => ModsHelper::toBitset(array_column($this->mods, 'acronym')),
            'maxcombo' => $this->max_combo,
            'pass' => $this->passed,
            'perfect' => $this->rank !== 'F' && $statistics['Miss'] + $statistics['LargeTickMiss'] === 0,
            'rank' => $this->rank,
            'score' => $this->total_score,
            'scorechecksum' => "\0",
            'user_id' => $this->user_id,
        ]);

        switch (Beatmap::modeStr($this->ruleset_id)) {
            case 'osu':
                $score['count300'] = $statistics['Great'];
                $score['count100'] = $statistics['Ok'];
                $score['count50'] = $statistics['Meh'];
                break;
            case 'taiko':
                $score['count300'] = $statistics['Great'];
                $score['count100'] = $statistics['Ok'];
                break;
            case 'fruits':
                $score['count300'] = $statistics['Great'];
                $score['count100'] = $statistics['LargeTickHit'];
                $score['countkatu'] = $statistics['SmallTickMiss'];
                break;
            case 'mania':
                $score['countgeki'] = $statistics['Perfect'];
                $score['count300'] = $statistics['Great'];
                $score['countkatu'] = $statistics['Good'];
                $score['count100'] = $statistics['Ok'];
                $score['count50'] = $statistics['Meh'];
                break;
        }

        $score->saveOrExplode();
        return $score;
    }
}
