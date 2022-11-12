<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Models\Forum\PollOption;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Traits\Memoizes;
use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Extra information for forum polls that belong to Project Loved.
 *
 * @property-read Beatmapset $beatmapset
 * @property int $beatmapset_id
 * @property int|null $description_author_id
 * @property-read User|null $descriptionAuthor
 * @property int[] $excluded_beatmap_ids IDs of Beatmaps that won't enter Loved even if the poll passes.
 * @property float $pass_threshold Portion of "Yes" votes required for the map to enter Loved.
 * @property string $ruleset
 * @property int $ruleset_id
 * @property-read Topic $topic
 * @property int $topic_id
 */
class LovedPoll extends Model
{
    use Memoizes, Validatable;

    const POLL_OPTIONS = ['yes', 'no'];

    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'excluded_beatmap_ids' => 'array',
        'pass_threshold' => 'float',
    ];
    protected $primaryKey = 'topic_id';

    /**
     * Get the ID corresponding to a poll option string.
     *
     * @return int|null `0|1|null`
     */
    public static function pollOptionId(?string $pollOptionString): ?int
    {
        static $flipped;
        $flipped ??= array_flip(static::POLL_OPTIONS);

        return $flipped[$pollOptionString] ?? null;
    }

    /**
     * Get the string corresponding to a poll option ID.
     *
     * @return string|null `"yes"|"no"|null`
     */
    public static function pollOptionString(?int $pollOptionId): ?string
    {
        return static::POLL_OPTIONS[$pollOptionId] ?? null;
    }

    public function beatmapset(): BelongsTo
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function descriptionAuthor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'description_author_id');
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'beatmapset_id',
            'description_author_id',
            'ruleset_id',
            'topic_id' => $this->getRawAttribute($key),

            'beatmapset',
            'descriptionAuthor',
            'topic' => $this->getRelationValue($key),

            'pass_threshold' => (float) $this->getRawAttribute($key),

            'excluded_beatmap_ids' => json_decode($this->getRawAttribute($key), true),

            'ruleset' => Beatmap::modeStr($this->ruleset_id),
        };
    }

    public function setRulesetAttribute(string $ruleset): void
    {
        $this->attributes['ruleset_id'] = Beatmap::modeInt($ruleset);
    }

    /**
     * Get the "captain's description" of the poll from the topic's first post.
     */
    public function description(): ?string
    {
        return $this->memoize(__FUNCTION__, function () {
            $postBody = $this->topic->firstPost->body_raw;
            $index = mb_strpos($postBody, "[/b]\n");

            if ($index === false) {
                return null;
            }

            return trim(mb_substr($postBody, $index + 5 /* strlen("[/b]\n") */));
        });
    }

    /**
     * Get the "captain's description" of the poll as HTML.
     */
    public function descriptionHtml(): ?string
    {
        if (($description = $this->description()) === null) {
            return null;
        }

        return (new Post(['post_text' => $description]))
            ->bodyHTML(['ignoreLineHeight' => true]);
    }

    /**
     * Get the results of the poll.
     *
     * @return array `['yes' => int, 'no' => int]`
     */
    public function results(): array
    {
        return $this
            ->topic
            ->pollOptions
            ->mapWithKeys(function (PollOption $pollOption) {
                $pollOptionString = static::pollOptionString($pollOption->poll_option_id);

                return $pollOptionString === null
                    ? []
                    : [$pollOptionString => $pollOption->poll_option_total];
            })
            ->toArray();
    }

    /**
     * Get a user's voted poll option.
     *
     * @return string|null `"yes"`, `"no"`, or `null` if the user hasn't voted.
     */
    public function votedPollOptionFor(User $user): ?string
    {
        $pollOptionId = $this
            ->topic
            ->pollVotes()
            ->where('vote_user_id', $user->getKey())
            ->value('poll_option_id');

        return static::pollOptionString($pollOptionId);
    }

    public function save(array $options = []): bool
    {
        if (!$this->isValid()) {
            return false;
        }

        return parent::save($options);
    }

    public function isValid(): bool
    {
        $this->validationErrors()->reset();

        if ($this->beatmapset === null) {
            $this->validationErrors()->add('beatmapset_id', 'invalid');
        } else {
            if (
                collect($this->excluded_beatmap_ids)
                    ->diff($this->beatmapset->beatmaps->modelKeys())
                    ->isNotEmpty()
            ) {
                $this->validationErrors()->add('excluded_beatmap_ids', 'invalid');
            }

            if (!$this->beatmapset->playmodes()->contains($this->ruleset_id)) {
                $this->validationErrors()->add('ruleset_id', 'invalid');
            }
        }

        if (
            $this->topic?->pollEnd() === null ||
            $this->topic->pollOptions->count() !== 2 ||
            !$this->topic->pollOptions->every(function (PollOption $pollOption) {
                return ($pollOption->poll_option_id === 0 && $pollOption->poll_option_text === 'Yes') ||
                       ($pollOption->poll_option_id === 1 && $pollOption->poll_option_text === 'No');
            }) ||
            $this->description() === null
        ) {
            $this->validationErrors()->add('topic_id', 'invalid');
        }

        return $this->validationErrors()->isEmpty();
    }

    public function validationErrorsTranslationPrefix(): string
    {
        return '';
    }
}
