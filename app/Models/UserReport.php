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
 * @property int $score_id
 * @property \Carbon\Carbon $timestamp
 * @property User $user
 * @property int $user_id
 */
class UserReport extends Model
{
    use RoutesNotifications, Validatable;

    const BEATMAPSET_TYPE_REASONS = ['UnwantedContent', 'Other'];
    const MAX_FIELD_LENGTHS = [
        'comments' => 2000,
    ];
    const POST_TYPE_REASONS = ['Insults', 'Spam', 'UnwantedContent', 'Nonsense', 'Other'];
    const SCORE_TYPE_REASONS = ['Cheating', 'MultipleAccounts', 'Other'];

    const ALLOWED_REASONS = [
        MorphMap::MAP[BeatmapDiscussionPost::class] => self::POST_TYPE_REASONS,
        MorphMap::MAP[Beatmapset::class] => self::BEATMAPSET_TYPE_REASONS,
        MorphMap::MAP[Best\Fruits::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Best\Mania::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Best\Osu::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Best\Taiko::class] => self::SCORE_TYPE_REASONS,
        MorphMap::MAP[Chat\Message::class] => self::POST_TYPE_REASONS,
        MorphMap::MAP[Comment::class] => self::POST_TYPE_REASONS,
        MorphMap::MAP[Forum\Post::class] => self::POST_TYPE_REASONS,
        MorphMap::MAP[Solo\Score::class] => self::SCORE_TYPE_REASONS,
    ];

    const CREATED_AT = 'timestamp';

    public $timestamps = false;

    protected $casts = ['timestamp' => 'datetime'];
    protected $primaryKey = 'report_id';
    protected $table = 'osu_user_reports';

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
        $reason = $this->reason;
        $reportableModel = $this->reportable()->getModel();

        if (
            $reason === 'Cheating'
            || $reason === 'MultipleAccounts'
            || $reportableModel instanceof BestModel
            || $reportableModel instanceof Solo\Score
        ) {
            return config('osu.user_report_notification.endpoint_cheating');
        } else {
            $type = match ($reportableModel::class) {
                BeatmapDiscussionPost::class => 'beatmapset_discussion',
                Beatmapset::class => 'beatmapset',
                Chat\Message::class => 'chat',
                Comment::class => 'comment',
                Forum\Post::class => 'forum',
                User::class => 'user',
            };

            return config("osu.user_report_notification.endpoint.{$type}")
                ?? config('osu.user_report_notification.endpoint_moderation');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if (!present(trim($this->comments)) && (!($this->reportable instanceof Chat\Message) || $this->reason === 'Other')) {
            $this->validationErrors()->add('comments', 'required');
        }

        if ($this->user_id === $this->reporter_id) {
            $this->validationErrors()->add(
                'user_id',
                '.self'
            );
        }

        $allowedReasons = static::ALLOWED_REASONS[$this->reportable_type] ?? [
            ...static::BEATMAPSET_TYPE_REASONS,
            ...static::POST_TYPE_REASONS,
            ...static::SCORE_TYPE_REASONS,
        ];

        if (!in_array($this->reason, $allowedReasons, true)) {
            $this->validationErrors()->add(
                'reason',
                '.reason_not_valid',
                ['reason' => $this->reason]
            );
        }

        if ($this->reportable instanceof Beatmapset && $this->reportable->isScoreable()) {
            $this->validationErrors()->add(
                'reason',
                '.no_ranked_beatmapset'
            );
        }

        $this->validateDbFieldLengths();

        return $this->validationErrors()->isEmpty();
    }

    public function save(array $options = [])
    {
        if (!$this->isValid()) {
            throw new ValidationException($this->validationErrors());
        }

        return parent::save();
    }

    public function validationErrorsTranslationPrefix(): string
    {
        return 'user_report';
    }
}
