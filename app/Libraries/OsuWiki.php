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

    const IMAGE_EXTENSIONS = ['gif', 'jpeg', 'jpg', 'png'];

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

    public static function getTree()
    {
        return Github::gitData()->trees()->show(static::user(), static::repository(), config('osu.wiki.branch'), true);
    }

    public static function fetch($path)
    {
        try {
            return GitHub::repo()
                ->contents()
                ->show(static::user(), static::repository(), $path, config('osu.wiki.branch'));
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
     *
     * @param string $path
     * @return array[]
     */
    public static function parseGithubPath($path)
    {
        $matches = [];

        if (starts_with($path, 'wiki/')) {
            if ($path === 'wiki/redirect.yaml') {
                return ['type' => 'redirect'];
            }

            preg_match('/^(?:wiki\/)(.*)\/(.*)\.(.{2,})$/', $path, $matches);

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
        } elseif (starts_with($path, 'news/')) {
            preg_match('/^(?:news\/)(.*)\.(.{2,})$/', $path, $matches);

            return [
                'type' => 'news_post',
                'slug' => $matches[1],
            ];
        }
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
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return in_array($extension, static::IMAGE_EXTENSIONS, true);
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
