<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Models\Solo\Score;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

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
        'options' => AsArrayObject::class,
    ];
    protected $primaryKey = 'user_id';

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

    public function getAudioAutoplayAttribute()
    {
        return $this->options['audio_autoplay'] ?? static::DEFAULTS['audio_autoplay'];
    }

    public function setAudioAutoplayAttribute($value)
    {
        $this->setOption('audio_autoplay', get_bool($value));
    }

    public function getAudioMutedAttribute()
    {
        return $this->options['audio_muted'] ?? static::DEFAULTS['audio_muted'];
    }

    public function setAudioMutedAttribute($value)
    {
        $this->setOption('audio_muted', get_bool($value));
    }

    public function getAudioVolumeAttribute()
    {
        return $this->options['audio_volume'] ?? static::DEFAULTS['audio_volume'];
    }

    public function setAudioVolumeAttribute($value)
    {
        $this->setOption('audio_volume', get_float($value));
    }

    public function getBeatmapsetCardSizeAttribute()
    {
        return $this->options['beatmapset_card_size'] ?? static::DEFAULTS['beatmapset_card_size'];
    }

    public function setBeatmapsetCardSizeAttribute($value)
    {
        if ($value !== null && !in_array($value, static::BEATMAPSET_CARD_SIZES, true)) {
            $value = null;
        }

        $this->setOption('beatmapset_card_size', $value);
    }

    public function getBeatmapsetDownloadAttribute()
    {
        return $this->options['beatmapset_download'] ?? static::DEFAULTS['beatmapset_download'];
    }

    public function setBeatmapsetDownloadAttribute($value)
    {
        if ($value !== null && !in_array($value, static::BEATMAPSET_DOWNLOAD, true)) {
            $value = null;
        }

        $this->setOption('beatmapset_download', $value);
    }

    public function getBeatmapsetShowAnimeCoverAttribute()
    {
        return $this->options['beatmapset_show_anime_cover'] ?? static::DEFAULTS['beatmapset_show_anime_cover'];
    }

    public function setBeatmapsetShowAnimeCoverAttribute($value)
    {
        $this->setOption('beatmapset_show_anime_cover', get_bool($value));
    }

    public function getBeatmapsetShowNsfwAttribute()
    {
        return $this->options['beatmapset_show_nsfw'] ?? static::DEFAULTS['beatmapset_show_nsfw'];
    }

    public function setBeatmapsetShowNsfwAttribute($value)
    {
        $this->setOption('beatmapset_show_nsfw', get_bool($value));
    }

    public function getBeatmapsetTitleShowOriginalAttribute()
    {
        return $this->options['beatmapset_title_show_original'] ?? static::DEFAULTS['beatmapset_title_show_original'];
    }

    public function setBeatmapsetTitleShowOriginalAttribute($value)
    {
        $this->setOption('beatmapset_title_show_original', get_bool($value));
    }

    public function getCommentsShowDeletedAttribute()
    {
        return $this->options['comments_show_deleted'] ?? static::DEFAULTS['comments_show_deleted'];
    }

    public function setCommentsShowDeletedAttribute($value)
    {
        $this->setOption('comments_show_deleted', get_bool($value));
    }

    public function getCommentsSortAttribute()
    {
        return $this->options['comments_sort'] ?? static::DEFAULTS['comments_sort'];
    }

    public function setCommentsSortAttribute($value)
    {
        if ($value !== null && !array_key_exists($value, Comment::SORTS)) {
            $value = null;
        }

        $this->setOption('comments_sort', $value);
    }

    public function getForumPostsShowDeletedAttribute()
    {
        return $this->options['forum_posts_show_deleted'] ?? static::DEFAULTS['forum_posts_show_deleted'];
    }

    public function setForumPostsShowDeletedAttribute($value)
    {
        $this->setOption('forum_posts_show_deleted', get_bool($value));
    }

    public function getLegacyScoreOnlyAttribute(): bool
    {
        $option = $this->options['legacy_score_only'] ?? null;
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

    public function setLegacyScoreOnlyAttribute($value): void
    {
        $this->setOption('legacy_score_only', get_bool($value));
    }

    public function getScoringModeAttribute(): string
    {
        return $this->options['scoring_mode'] ?? static::DEFAULTS['scoring_mode'];
    }

    public function setScoringModeAttribute($value): void
    {
        if ($value !== null && !in_array($value, static::SCORING_MODES, true)) {
            $value = null;
        }

        $this->setOption('scoring_mode', $value);
    }

    public function getUserListFilterAttribute()
    {
        return $this->options['user_list_filter'] ?? static::DEFAULTS['user_list_filter'];
    }

    public function setUserListFilterAttribute($value)
    {
        if ($value !== null && !in_array($value, static::USER_LIST['filters']['all'], true)) {
            $value = null;
        }

        $this->setOption('user_list_filter', $value);
    }

    public function getUserListSortAttribute()
    {
        return $this->options['user_list_sort'] ?? static::DEFAULTS['user_list_sort'];
    }

    public function setUserListSortAttribute($value)
    {
        if ($value !== null && !in_array($value, static::USER_LIST['sorts']['all'], true)) {
            $value = null;
        }

        $this->setOption('user_list_sort', $value);
    }

    public function getUserListViewAttribute()
    {
        return $this->options['user_list_view'] ?? static::DEFAULTS['user_list_view'];
    }

    public function setUserListViewAttribute($value)
    {
        if ($value !== null && !in_array($value, static::USER_LIST['views']['all'], true)) {
            $value = null;
        }

        $this->setOption('user_list_view', $value);
    }

    public function getExtrasOrderAttribute($value)
    {
        $newValue = $this->options['extras_order'] ?? null;

        if ($newValue === null && $value !== null) {
            $newValue = json_decode($value, true);
        }

        if ($newValue === null) {
            return static::DEFAULTS['extras_order'];
        }

        return static::repairExtrasOrder($newValue);
    }

    public function setExtrasOrderAttribute($value)
    {
        $this->attributes['extras_order'] = null;
        $this->setOption(
            'extras_order',
            $value === null ? null : static::repairExtrasOrder($value),
        );
    }

    public function getProfileCoverExpandedAttribute()
    {
        return $this->options['profile_cover_expanded'] ?? static::DEFAULTS['profile_cover_expanded'];
    }

    public function setProfileCoverExpandedAttribute($value)
    {
        $this->setOption('profile_cover_expanded', get_bool($value));
    }

    private function setOption($key, $value)
    {
        $this->options ??= [];
        $this->options[$key] = $value;
    }
}
