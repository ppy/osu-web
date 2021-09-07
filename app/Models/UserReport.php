<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    const BEATMAPSET_TYPE_REASONS = ['UnwantedContent', 'Other'];
    const POST_TYPE_REASONS = ['Insults', 'Spam', 'UnwantedContent', 'Nonsense', 'Other'];
    const SCORE_TYPE_REASONS = ['Cheating', 'MultipleAccounts', 'Other'];

    const ALLOWED_REASONS = [
        MorphMap::MAP[Beatmapset::class] => self::BEATMAPSET_TYPE_REASONS,
        MorphMap::MAP[BeatmapDiscussionPost::class] => self::POST_TYPE_REASONS,
        MorphMap::MAP[Best\Fruits::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Best\Mania::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Best\Osu::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Best\Taiko::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Comment::class] => self::POST_TYPE_REASONS,
        MorphMap::MAP[Forum\Post::class] => self::POST_TYPE_REASONS,
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
        if ($this->reason === 'Cheating' || $this->reason === 'MultipleAccounts') {
            return config('osu.user_report_notification.endpoint_cheating');
        } else {
            return config('osu.user_report_notification.endpoint_moderation');
        }
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

        if ($this->reportable_type === 'beatmapset' && $this->reportable->isScoreable()) {
            $this->validationErrors()->add(
                'reason',
                '.no_ranked_beatmapset'
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
