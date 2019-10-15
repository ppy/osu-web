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
use Illuminate\Support\Str;

class OsuWiki
{
    const CACHE_DURATION = 60;
    const REPOSITORY = 'osu-wiki';
    const USER = 'ppy';

    const IMAGE_EXTENSIONS = ['gif', 'jpeg', 'jpg', 'png'];

    public $path;
    public $data;

    public static function cleanPath($path)
    {
        return preg_replace('|//+|', '/', trim($path, '/'));
    }

    public static function fetch($path)
    {
        try {
            return GitHub::repo()
                ->contents()
                ->show(static::USER, static::REPOSITORY, $path);
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
            if ($path === 'wiki/redirect.md') {
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
            ->compare(static::USER, static::REPOSITORY, $old, $new);

        return $diff['files'];
    }

    public static function isImage($path)
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return in_array($extension, static::IMAGE_EXTENSIONS, true);
    }

    public static function getFileTree($path = 'wiki', $skipNonMarkdown = true, $flatten = false)
    {
        $contents = GitHub::repo()
            ->contents()
            ->show(static::USER, static::REPOSITORY, $path);

        if ($skipNonMarkdown) {
            $contents = array_filter($contents, function ($file) {
                // skipping wiki/shared because there's a bunch of non markdown stuff there
                if ($file['path'] === 'wiki/shared') {
                    return false;
                }

                if ($file['type'] === 'dir') {
                    return true;
                }

                return Str::endsWith($file['path'], '.md');
            });
        }

        $files = [];

        while (!empty($contents)) {
            $value = array_shift($contents);

            if ($value['type'] === 'file') {
                $files[] = $value;
            } else {
                $values = static::getFileTree($value['path'], $skipNonMarkdown, $flatten);

                if ($flatten) {
                    $contents = array_merge($values, $contents);
                } else {
                    $value['files'] = $values;
                    $files[] = $value;
                }
            }
        }

        return $files;
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
