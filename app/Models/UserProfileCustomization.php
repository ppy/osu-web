<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\ProfileCover;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

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
        'options' => AsArrayObject::class,
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
        return $this->options['audio_autoplay'] ?? false;
    }

    public function setAudioAutoplayAttribute($value)
    {
        $this->options['audio_autoplay'] = get_bool($value);
    }

    public function getAudioMutedAttribute()
    {
        return $this->options['audio_muted'] ?? false;
    }

    public function setAudioMutedAttribute($value)
    {
        $this->options['audio_muted'] = get_bool($value);
    }

    public function getAudioVolumeAttribute()
    {
        return $this->options['audio_volume'] ?? 0.45;
    }

    public function setAudioVolumeAttribute($value)
    {
        $this->options['audio_volume'] = get_float($value);
    }

    public function getBeatmapsetCardSizeAttribute()
    {
        return $this->options['beatmapset_card_size'] ?? static::BEATMAPSET_CARD_SIZES[0];
    }

    public function setBeatmapsetCardSizeAttribute($value)
    {
        if ($value !== null && !in_array($value, static::BEATMAPSET_CARD_SIZES, true)) {
            $value = null;
        }

        $this->options['beatmapset_card_size'] = $value;
    }

    public function getBeatmapsetDownloadAttribute()
    {
        return $this->options['beatmapset_download'] ?? static::BEATMAPSET_DOWNLOAD[0];
    }

    public function setBeatmapsetDownloadAttribute($value)
    {
        if ($value !== null && !in_array($value, static::BEATMAPSET_DOWNLOAD, true)) {
            $value = null;
        }

        $this->options['beatmapset_download'] = $value;
    }

    public function getBeatmapsetShowNsfwAttribute()
    {
        return $this->options['beatmapset_show_nsfw'] ?? false;
    }

    public function setBeatmapsetShowNsfwAttribute($value)
    {
        $this->options['beatmapset_show_nsfw'] = get_bool($value);
    }

    public function getBeatmapsetTitleShowOriginalAttribute()
    {
        return $this->options['beatmapset_title_show_original'] ?? false;
    }

    public function setBeatmapsetTitleShowOriginalAttribute($value)
    {
        $this->options['beatmapset_title_show_original'] = get_bool($value);
    }

    public function getCommentsShowDeletedAttribute()
    {
        return $this->options['comments_show_deleted'] ?? false;
    }

    public function setCommentsShowDeletedAttribute($value)
    {
        $this->options['comments_show_deleted'] = get_bool($value);
    }

    public function getCommentsSortAttribute()
    {
        return $this->options['comments_sort'] ?? Comment::DEFAULT_SORT;
    }

    public function setCommentsSortAttribute($value)
    {
        if ($value !== null && !array_key_exists($value, Comment::SORTS)) {
            $value = null;
        }

        $this->options['comments_sort'] = $value;
    }

    public function getForumPostsShowDeletedAttribute()
    {
        return $this->options['forum_posts_show_deleted'] ?? true;
    }

    public function setForumPostsShowDeletedAttribute($value)
    {
        $this->options['forum_posts_show_deleted'] = get_bool($value);
    }

    public function getUserListFilterAttribute()
    {
        return $this->options['user_list_filter'] ?? static::USER_LIST['filters']['default'];
    }

    public function setUserListFilterAttribute($value)
    {
        if ($value !== null && !in_array($value, static::USER_LIST['filters']['all'], true)) {
            $value = null;
        }

        $this->options['user_list_filter'] = $value;
    }

    public function getUserListSortAttribute()
    {
        return $this->options['user_list_sort'] ?? static::USER_LIST['sorts']['default'];
    }

    public function setUserListSortAttribute($value)
    {
        if ($value !== null && !in_array($value, static::USER_LIST['sorts']['all'], true)) {
            $value = null;
        }

        $this->options['user_list_sort'] = $value;
    }

    public function getUserListViewAttribute()
    {
        return $this->options['user_list_view'] ?? static::USER_LIST['views']['default'];
    }

    public function setUserListViewAttribute($value)
    {
        if ($value !== null && !in_array($value, static::USER_LIST['views']['all'], true)) {
            $value = null;
        }

        $this->options['user_list_view'] = $value;
    }

    public function getExtrasOrderAttribute($value)
    {
        $newValue = $this->options['extras_order'];

        if ($newValue === null && $value !== null) {
            $newValue = json_decode($value, true);
        }

        if ($newValue === null) {
            return static::SECTIONS;
        }

        return static::repairExtrasOrder($newValue, true);
    }

    public function setExtrasOrderAttribute($value)
    {
        $this->attributes['extras_order'] = null;
        $this->options['extras_order'] = static::repairExtrasOrder($value);
    }

    public function getRankingExpandedAttribute()
    {
        return $this->options['ranking_expanded'] ?? true;
    }

    public function setRankingExpandedAttribute($value)
    {
        $this->options['ranking_expanded'] = get_bool($value);
    }
}
