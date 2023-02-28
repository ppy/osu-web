<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\GitHubNotFoundException;
use App\Exceptions\GitHubTooLargeException;
use App\Jobs\UpdateWiki;
use GitHub;
use Github\Exception\RuntimeException as GithubException;
use Illuminate\Support\Collection;

class OsuWiki
{
    const CACHE_DURATION = 60;

    public $path;
    public $data;

    public static function cleanPath($path)
    {
        return preg_replace('|//+|', '/', trim($path, '/'));
    }

    public static function getPageList(): Collection
    {
        return collect(static::getTree()['tree'])
            ->filter(function ($item) {
                return $item['type'] === 'blob'
                    && starts_with($item['path'], 'wiki/')
                    && ends_with($item['path'], '.md');
            })
            ->pluck('path');
    }

    public static function getTree(?string $sha = null, bool $recursive = true): array
    {
        return GitHub::gitData()->trees()->show(static::user(), static::repository(), $sha ?? static::branch(), $recursive);
    }

    public static function fetch($path)
    {
        try {
            return GitHub::repo()
                ->contents()
                ->show(static::user(), static::repository(), $path, static::branch());
        } catch (GithubException $e) {
            $message = $e->getMessage();

            if ($message === 'Not Found') {
                throw new GitHubNotFoundException($message);
            } elseif (starts_with($message, 'This API returns blobs up to 1 MB in size.')) {
                throw new GitHubTooLargeException($message);
            }

            throw $e;
        }
    }

    public static function fetchContent($path)
    {
        return (new static($path))->content();
    }

    /**
     * Parses a github repository path of a wiki file,
     * and returns informations such as type, wiki path and locale.
     */
    public static function parseGithubPath(string $path): ?array
    {
        $matches = [];

        if (starts_with($path, 'wiki/')) {
            if ($path === 'wiki/redirect.yaml') {
                return ['type' => 'redirect'];
            }

            $found = preg_match('/^(?:wiki\/)(.*)\/(.*)\.(.{2,})$/', $path, $matches);

            if ($found > 0) {
                if (static::isImage($path)) {
                    return [
                        'type' => 'image',
                        'path' => $matches[1].'/'.$matches[2].'.'.$matches[3],
                    ];
                } else {
                    return [
                        'type' => 'page',
                        'locale' => $matches[2],
                        'path' => $matches[1],
                    ];
                }
            }
        } elseif (starts_with($path, 'news/')) {
            $found = preg_match('/^(?:news\/)(?:\d{4}\/)?(.*)\.md$/', $path, $matches);

            if ($found > 0) {
                return [
                    'type' => 'news_post',
                    'slug' => $matches[1],
                ];
            }
        }

        return null;
    }

    public static function updateFromGithub($data)
    {
        dispatch(new UpdateWiki($data['before'], $data['after']));
    }

    public static function getUpdatedFiles($old, $new)
    {
        $diff = GitHub::repo()
            ->commits()
            ->compare(static::user(), static::repository(), $old, $new);

        return $diff['files'];
    }

    public static function isImage($path)
    {
        return preg_match('/\.(?:jpe?g|gif|png)$/i', $path) === 1;
    }

    public static function branch()
    {
        return config('osu.wiki.branch');
    }

    public static function repository()
    {
        return config('osu.wiki.repository');
    }

    public static function user()
    {
        return config('osu.wiki.user');
    }

    public function __construct($path)
    {
        $this->path = $path;
        $this->data = static::fetch($this->path);
    }

    public function content()
    {
        return base64_decode($this->data['content'], true);
    }
}
