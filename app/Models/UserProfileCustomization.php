<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\ProfileCover;
use App\Traits\Memoizes;

/**
 * @property array|null $cover_json
 * @property \Carbon\Carbon $created_at
 * @property string|null $extras_order
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property int|null $user_id
 */
class UserProfileCustomization extends Model
{
    use Memoizes;

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

    const USER_LIST = [
        'filters' => ['all' => ['all', 'online', 'offline'], 'default' => 'all'],
        'sorts' => ['all' => ['last_visit', 'rank', 'username'], 'default' => 'last_visit'],
        'views' => ['all' => ['card', 'list', 'brick'], 'default' => 'card'],
    ];

    protected $casts = [
        'cover_json' => 'array',
        'options' => 'array',
    ];

    private $cover;

    public static function repairExtrasOrder($value)
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

    public function cover()
    {
        if ($this->cover === null) {
            $this->cover = new ProfileCover($this->user_id, $this->cover_json);
        }

        return $this->cover;
    }

    public function setCover($id, $file)
    {
        $this->cover_json = $this->cover()->set($id, $file);

        $this->save();
    }

    public function getAudioAutoplayAttribute()
    {
        return $this->getOptions()['audio_autoplay'] ?? false;
    }

    public function setAudioAutoplayAttribute($value)
    {
        if (!is_bool($value)) {
            $value = null;
        }

        $this->setOption('audio_autoplay', $value);
    }

    public function getAudioMutedAttribute()
    {
        return $this->getOptions()['audio_muted'] ?? false;
    }

    public function setAudioMutedAttribute($value)
    {
        if (!is_bool($value)) {
            $value = null;
        }

        $this->setOption('audio_muted', $value);
    }

    public function getAudioVolumeAttribute()
    {
        return $this->getOptions()['audio_volume'] ?? 0.45;
    }

    public function setAudioVolumeAttribute($value)
    {
        if (!is_float($value) && !is_int($value)) {
            $value = null;
        }

        $this->setOption('audio_volume', $value);
    }

    public function getBeatmapsetCardSizeAttribute()
    {
        return $this->getOptions()['beatmapset_card_size'] ?? static::BEATMAPSET_CARD_SIZES[0];
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
        return $this->getOptions()['beatmapset_download'] ?? static::BEATMAPSET_DOWNLOAD[0];
    }

    public function setBeatmapsetDownloadAttribute($value)
    {
        if ($value !== null && !in_array($value, static::BEATMAPSET_DOWNLOAD, true)) {
            $value = null;
        }

        $this->setOption('beatmapset_download', $value);
    }

    public function getBeatmapsetShowNsfwAttribute()
    {
        return $this->getOptions()['beatmapset_show_nsfw'] ?? false;
    }

    public function setBeatmapsetShowNsfwAttribute($value)
    {
        if (!is_bool($value)) {
            $value = null;
        }

        $this->setOption('beatmapset_show_nsfw', $value);
    }

    public function getBeatmapsetTitleShowOriginalAttribute()
    {
        return $this->getOptions()['beatmapset_title_show_original'] ?? false;
    }

    public function setBeatmapsetTitleShowOriginalAttribute($value)
    {
        if (!is_bool($value)) {
            $value = null;
        }

        $this->setOption('beatmapset_title_show_original', $value);
    }

    public function setCommentsShowDeletedAttribute($value)
    {
        if (!is_bool($value)) {
            $value = null;
        }

        $this->setOption('comments_show_deleted', $value);
    }

    public function getCommentsShowDeletedAttribute()
    {
        return $this->getOptions()['comments_show_deleted'] ?? false;
    }

    public function getCommentsSortAttribute()
    {
        return $this->getOptions()['comments_sort'] ?? Comment::DEFAULT_SORT;
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
        return $this->getOptions()['forum_posts_show_deleted'] ?? true;
    }

    public function setForumPostsShowDeletedAttribute($value)
    {
        $this->setOption('forum_posts_show_deleted', $value);
    }

    public function getUserListFilterAttribute()
    {
        return $this->getOptions()['user_list_filter'] ?? static::USER_LIST['filters']['default'];
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
        return $this->getOptions()['user_list_sort'] ?? static::USER_LIST['sorts']['default'];
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
        return $this->getOptions()['user_list_view'] ?? static::USER_LIST['views']['default'];
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
        if ($value !== null) {
            $value = json_decode($value, true);
        }

        $value = $this->getOptions()['extras_order'] ?? $value;

        if ($value === null) {
            return static::SECTIONS;
        }

        return static::repairExtrasOrder($value, true);
    }

    public function setExtrasOrderAttribute($value)
    {
        $this->attributes['extras_order'] = null;
        $this->setOption('extras_order', static::repairExtrasOrder($value));
    }

    public function getRankingExpandedAttribute()
    {
        return $this->getOptions()['ranking_expanded'] ?? true;
    }

    public function setRankingExpandedAttribute($value)
    {
        $this->setOption('ranking_expanded', $value);
    }

    public function setOption($key, $value)
    {
        $this->options = array_merge($this->options ?? [], [$key => $value]);
        $this->resetMemoized();
    }

    public function getOptions()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->options;
        });
    }
}
