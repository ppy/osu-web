<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Models\Solo\Score;

/**
 * @property \Carbon\Carbon $created_at
 * @property string|null $extras_order
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property int|null $user_id
 */
class UserProfileCustomization extends Model
{
    const DEFAULTS = [
        'audio_autoplay' => false,
        'audio_muted' => false,
        'audio_volume' => 0.45,
        'beatmapset_card_size' => self::BEATMAPSET_CARD_SIZES[0],
        'beatmapset_download' => self::BEATMAPSET_DOWNLOAD[0],
        'beatmapset_show_anime_cover' => true,
        'beatmapset_show_nsfw' => false,
        'beatmapset_title_show_original' => false,
        'comments_show_deleted' => false,
        'comments_sort' => Comment::DEFAULT_SORT,
        'extras_order' => self::SECTIONS,
        'forum_posts_show_deleted' => true,
        'legacy_score_only' => false,
        'profile_cover_expanded' => true,
        'profile_detail_v2' => false,
        'scoring_mode' => self::SCORING_MODES[0],
        'user_list_filter' => self::USER_LIST['filters']['default'],
        'user_list_sort' => self::USER_LIST['sorts']['default'],
        'user_list_view' => self::USER_LIST['views']['default'],
    ];

    /**
     * An array of all possible profile sections, also in their default order.
     */
    const SECTIONS = [
        'me',
        'recent_activity',
        'top_ranks',
        'medals',
        'historical',
        'beatmaps',
        'kudosu',
    ];

    const BEATMAPSET_CARD_SIZES = ['normal', 'extra'];

    const BEATMAPSET_DOWNLOAD = ['all', 'no_video', 'direct'];

    public const array SCORING_MODES = ['standardised', 'classic'];

    const USER_LIST = [
        'filters' => ['all' => ['all', 'online', 'offline'], 'default' => 'all'],
        'sorts' => ['all' => ['last_visit', 'rank', 'username'], 'default' => 'last_visit'],
        'views' => ['all' => ['card', 'list', 'brick'], 'default' => 'card'],
    ];

    public $incrementing = false;

    protected $casts = [
        'options' => 'array',
    ];
    protected $primaryKey = 'user_id';

    private ?array $cachedOptions;

    public static function forUser(?User $user): array|static
    {
        if ($user === null) {
            return static::DEFAULTS;
        }

        $ret = $user->userProfileCustomization;

        if ($ret === null) {
            $ret = new static(['user_id' => $user->getKey()]);
            $user->setRelation('userProfileCustomization', $ret);
        }

        return $ret;
    }

    public static function repairExtrasOrder(array $value): array
    {
        // read from inside out
        return array_values(
            // remove duplicate sections from previous merge
            array_unique(
                // ensure all sections are included
                array_merge(
                    // remove invalid sections
                    array_intersect($value, static::SECTIONS),
                    static::SECTIONS
                )
            )
        );
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'user_id' => $this->getRawAttribute($key),
            'options' => json_decode($this->getRawAttribute($key) ?? '[]', true),

            'extras_order' => $this->getExtrasOrderAttribute($this->getRawAttribute($key)),
            'legacy_score_only' => $this->getLegacyScoreOnlyAttribute(),

            'created_at',
            'updated_at' => $this->getTimeFast($key),

            'audio_autoplay',
            'audio_muted',
            'audio_volume',
            'beatmapset_card_size',
            'beatmapset_download',
            'beatmapset_show_anime_cover',
            'beatmapset_show_nsfw',
            'beatmapset_title_show_original',
            'comments_show_deleted',
            'comments_sort',
            'forum_posts_show_deleted',
            'profile_cover_expanded',
            'profile_detail_v2',
            'scoring_mode',
            'user_list_filter',
            'user_list_sort',
            'user_list_view' => $this->getOption($key) ?? static::DEFAULTS[$key],
        };
    }

    public function setAudioAutoplayAttribute($value)
    {
        $this->setOption('audio_autoplay', get_bool($value));
    }

    public function setAudioMutedAttribute($value)
    {
        $this->setOption('audio_muted', get_bool($value));
    }

    public function setAudioVolumeAttribute($value)
    {
        $this->setOption('audio_volume', get_float($value));
    }

    public function setBeatmapsetCardSizeAttribute($value)
    {
        if ($value !== null && !in_array($value, static::BEATMAPSET_CARD_SIZES, true)) {
            $value = null;
        }

        $this->setOption('beatmapset_card_size', $value);
    }

    public function setBeatmapsetDownloadAttribute($value)
    {
        if ($value !== null && !in_array($value, static::BEATMAPSET_DOWNLOAD, true)) {
            $value = null;
        }

        $this->setOption('beatmapset_download', $value);
    }

    public function setBeatmapsetShowAnimeCoverAttribute($value)
    {
        $this->setOption('beatmapset_show_anime_cover', get_bool($value));
    }

    public function setBeatmapsetShowNsfwAttribute($value)
    {
        $this->setOption('beatmapset_show_nsfw', get_bool($value));
    }

    public function setBeatmapsetTitleShowOriginalAttribute($value)
    {
        $this->setOption('beatmapset_title_show_original', get_bool($value));
    }

    public function setCommentsShowDeletedAttribute($value)
    {
        $this->setOption('comments_show_deleted', get_bool($value));
    }

    public function setCommentsSortAttribute($value)
    {
        if (!is_string($value) || !array_key_exists($value, Comment::SORTS)) {
            $value = null;
        }

        $this->setOption('comments_sort', $value);
    }

    public function setForumPostsShowDeletedAttribute($value)
    {
        $this->setOption('forum_posts_show_deleted', get_bool($value));
    }

    public function setLegacyScoreOnlyAttribute($value): void
    {
        $this->setOption('legacy_score_only', get_bool($value));
    }

    public function setScoringModeAttribute($value): void
    {
        if ($value !== null && !in_array($value, static::SCORING_MODES, true)) {
            $value = null;
        }

        $this->setOption('scoring_mode', $value);
    }

    public function setUserListFilterAttribute($value)
    {
        if ($value !== null && !in_array($value, static::USER_LIST['filters']['all'], true)) {
            $value = null;
        }

        $this->setOption('user_list_filter', $value);
    }

    public function setUserListSortAttribute($value)
    {
        if ($value !== null && !in_array($value, static::USER_LIST['sorts']['all'], true)) {
            $value = null;
        }

        $this->setOption('user_list_sort', $value);
    }

    public function setUserListViewAttribute($value)
    {
        if ($value !== null && !in_array($value, static::USER_LIST['views']['all'], true)) {
            $value = null;
        }

        $this->setOption('user_list_view', $value);
    }

    public function setExtrasOrderAttribute($value)
    {
        $this->attributes['extras_order'] = null;
        $this->setOption(
            'extras_order',
            is_array($value) ? static::repairExtrasOrder(get_arr($value, get_string(...))) : null,
        );
    }

    public function setProfileCoverExpandedAttribute($value)
    {
        $this->setOption('profile_cover_expanded', get_bool($value));
    }

    public function setProfileDetailV2Attribute($value)
    {
        $this->setOption('profile_detail_v2', get_bool($value));
    }

    #[\Override]
    public function refresh(): void
    {
        $this->cachedOptions = null;

        parent::refresh();
    }

    private function getExtrasOrderAttribute($value)
    {
        $newValue = $this->getOption('extras_order') ?? null;

        if ($newValue === null && $value !== null) {
            $newValue = json_decode($value, true);
        }

        if ($newValue === null) {
            return static::DEFAULTS['extras_order'];
        }

        return static::repairExtrasOrder($newValue);
    }

    private function getLegacyScoreOnlyAttribute(): bool
    {
        $option = $this->getOption('legacy_score_only') ?? null;
        if ($option === null) {
            $lastScore = Score::where('user_id', $this->getKey())->last();
            if ($lastScore === null) {
                $option = static::DEFAULTS['legacy_score_only'];
            } else {
                $option = $lastScore->isLegacy();
                $this->setOption('legacy_score_only', $option);

                try {
                    $this->save();
                } catch (\Throwable $e) {
                    if (!is_sql_unique_exception($e)) {
                        throw $e;
                    }
                }
            }
        }

        return $option;
    }

    private function getOption(string $key): mixed
    {
        $this->cachedOptions ??= $this->options ?? [];

        return $this->cachedOptions[$key] ?? null;
    }

    private function setOption(string $key, mixed $value): void
    {
        $this->cachedOptions ??= $this->options ?? [];
        $this->cachedOptions[$key] = $value;
        $this->options = $this->cachedOptions;
    }
}
