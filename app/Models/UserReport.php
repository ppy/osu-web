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
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\RoutesNotifications;

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
    use RoutesNotifications, Validatable;

    const POST_TYPE_REASONS = ['Insults', 'Spam', 'UnwantedContent', 'Nonsense', 'Other'];
    const SCORE_TYPE_REASONS = ['Cheating', 'Other'];

    const ALLOWED_REASONS = [
        MorphMap::MAP[BeatmapDiscussionPost::class] => self::POST_TYPE_REASONS,
        MorphMap::MAP[Best\Fruits::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Best\Mania::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Best\Osu::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Best\Taiko::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Comment::class] => self::POST_TYPE_REASONS,
    ];

    const CREATED_AT = 'timestamp';

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

    public function routeNotificationForSlack(?Notification $_notification): ?string
    {
        return config('osu.user_report_notification.endpoint');
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

        $allowedReasons = static::ALLOWED_REASONS[$this->reportable_type] ?? null;
        if ($allowedReasons !== null) {
            if (!in_array($this->reason, $allowedReasons, true)) {
                $this->validationErrors()->add(
                    'reason',
                    '.reason_not_valid',
                    ['reason' => $this->reason]
                );
            }
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
