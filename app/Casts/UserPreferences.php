<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Casts;

use App\Models\Comment;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class UserPreferences implements CastsAttributes
{
    const BEATMAPSET_CARD_SIZES = ['normal', 'extra'];

    const BEATMAPSET_DOWNLOAD = ['all', 'no_video', 'direct'];

    const USER_LIST = [
        'filters' => ['all' => ['all', 'online', 'offline'], 'default' => 'all'],
        'sorts' => ['all' => ['last_visit', 'rank', 'username'], 'default' => 'last_visit'],
        'views' => ['all' => ['card', 'list', 'brick'], 'default' => 'card'],
    ];

    public static function attributes()
    {
        static $ret;

        if ($ret === null) {
            $ret = [
                'audio_autoplay' => [
                    'cast' => 'get_bool',
                    'default' => false,
                ],
                'audio_muted' => [
                    'cast' => 'get_bool',
                    'default' => false,
                ],
                'audio_volume' => [
                    'cast' => 'get_float',
                    'default' => 0.45,
                ],
                'beatmapset_card_size' => [
                    'cast' => fn ($v) => is_string($v) && in_array($v, static::BEATMAPSET_CARD_SIZES, true) ? $v : null,
                    'default' => static::BEATMAPSET_CARD_SIZES[0],
                ],
                'beatmapset_download' => [
                    'cast' => fn ($v) => is_string($v) && in_array($v, static::BEATMAPSET_DOWNLOAD, true) ? $v : null,
                    'default' => static::BEATMAPSET_DOWNLOAD[0],
                ],
                'beatmapset_show_nsfw' => [
                    'cast' => 'get_bool',
                    'default' => false,
                ],
                'beatmapset_title_show_original' => [
                    'cast' => 'get_bool',
                    'default' => false,
                ],
                'comments_show_deleted' => [
                    'cast' => 'get_bool',
                    'default' => false,
                ],
                'comments_sort' => [
                    'cast' => fn ($v) => is_string($v) && array_key_exists($v, Comment::SORTS) ? $v : null,
                    'default' => Comment::DEFAULT_SORT,
                ],
                'forum_posts_show_deleted' => [
                    'cast' => 'get_bool',
                    'default' => true,
                ],
                'user_list_filter' => [
                    'cast' => fn ($v) => is_string($v) && in_array($v, static::USER_LIST['filters']['all'], true) ? $v : null,
                    'default' => static::USER_LIST['filters']['default'],
                ],
                'user_list_sort' => [
                    'cast' => fn ($v) => is_string($v) && in_array($v, static::USER_LIST['sorts']['all'], true) ? $v : null,
                    'default' => static::USER_LIST['sorts']['default'],
                ],
                'user_list_view' => [
                    'cast' => fn ($v) => is_string($v) && in_array($v, static::USER_LIST['views']['all'], true) ? $v : null,
                    'default' => static::USER_LIST['views']['default'],
                ],
                'profile_cover_expanded' => [
                    'cast' => 'get_bool',
                    'default' => true,
                ],
            ];
        }

        return $ret;
    }

    public function get($model, string $key, $value, array $attributes)
    {
        return $model->options[$key] ?? static::attributes()[$key]['default'];
    }

    public function set($model, string $key, $value, array $attributes): array
    {
        $model->options ??= [];
        $castedValue = static::attributes()[$key]['cast']($value);
        if ($castedValue === null) {
            if ($model->options->offsetExists($key)) {
                unset($model->options[$key]);
            }
        } else {
            $model->options[$key] = $castedValue;
        }

        return [];
    }
}
