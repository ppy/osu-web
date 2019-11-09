<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Libraries;

use App\Exceptions\GitHubNotFoundException;
use App\Exceptions\GitHubTooLargeException;
use App\Jobs\UpdateWiki;
use GitHub;
use Github\Exception\RuntimeException as GithubException;

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
            ->compare(static::USER, static::REPOSITORY, $old, $new);

        return $diff['files'];
    }

    public static function isImage($path)
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return in_array($extension, static::IMAGE_EXTENSIONS, true);
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
