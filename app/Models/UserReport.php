<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Models;

use App\Exceptions\ValidationException;
use App\Libraries\MorphMap;
use App\Models\Score\Best;
use App\Models\Score\Best\Model as BestModel;
use App\Traits\Validatable;

/**
 * @property string $comments
 * @property int $mode
 * @property mixed $reason
 * @property int $report_id
 * @property mixed $reportable
 * @property int|null $reportable_id
 * @property mixed|null $reportable_type
 * @property User $reporter
 * @property int $reporter_id
 * @property mixed $score
 * @property int $score_id
 * @property mixed $score_type
 * @property \Carbon\Carbon $timestamp
 * @property User $user
 * @property int $user_id
 */
class UserReport extends Model
{
    use Validatable;

    const CREATED_AT = 'timestamp';
    const REPORTABLES = [
        MorphMap::MAP[Best\Fruits::class],
        MorphMap::MAP[Best\Mania::class],
        MorphMap::MAP[Best\Osu::class],
        MorphMap::MAP[Best\Taiko::class],
        MorphMap::MAP[Comment::class],
        MorphMap::MAP[User::class],
    ];

    protected $table = 'osu_user_reports';
    protected $primaryKey = 'report_id';

    protected $dates = ['timestamp'];

    public $timestamps = false;

    public function reportable()
    {
        return $this->morphTo();
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function score()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getScoreTypeAttribute()
    {
        return BestModel::getClass($this->mode);
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if ($this->user_id === $this->reporter_id) {
            $this->validationErrors()->add(
                'user_id',
                '.self'
            );
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save(array $options = [])
    {
        if (!$this->isValid()) {
            throw new ValidationException($this->validationErrors());
        }

        return parent::save();
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'user_report';
    }
}
