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

namespace App\Models;

use App\Exceptions\GitHubNotFoundException;
use App\Libraries\Commentable;
use App\Libraries\Markdown\OsuMarkdown;
use App\Libraries\OsuWiki;
use App\Traits\CommentableDefaults;
use Carbon\Carbon;
use Exception;

/**
 * @property Comment $comments
 * @property \Carbon\Carbon|null $created_at
 * @property string|null $hash
 * @property int $id
 * @property array|null $page
 * @property \Carbon\Carbon|null $published_at
 * @property string $slug
 * @property string|null $tumblr_id
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $version
 */
class NewsPost extends Model implements Commentable, Wiki\WikiObject
{
    use CommentableDefaults;

    // in minutes
    const CACHE_DURATION = 86400;
    const VERSION = 3;
    const DASHBOARD_LIMIT = 8;
    const LANDING_LIMIT = 4;

    protected $casts = [
        'page' => 'array',
    ];

    protected $dates = [
        'published_at',
    ];

    private $adjacent = [];

    public static function lookup($slug)
    {
        return static::firstOrNew(compact('slug'));
    }

    public static function pageVersion()
    {
        return static::VERSION.'.'.OsuMarkdown::VERSION;
    }

    public static function search($params)
    {
        $query = static::published();

        $limit = clamp(get_int($params['limit'] ?? null) ?? 20, 1, 21);

        // implies default sorting.
        $cursor['id'] = get_int($params['cursor']['id'] ?? null);
        $cursor['published_at'] = parse_time_to_carbon($params['cursor']['published_at'] ?? null);

        if ($cursor['id'] !== null && $cursor['published_at'] !== null) {
            $query->cursorWhere([
                ['column' => 'published_at', 'order' => 'DESC', 'value' => $cursor['published_at']],
                ['column' => 'id', 'order' => 'DESC', 'value' => $cursor['id']],
            ]);
        } else {
            $query->orderBy('published_at', 'DESC')->orderBy('id', 'DESC');
        }

        $query->limit($limit);

        return [
            'query' => $query,
            'params' => [
                'cursor' => $cursor,
                'limit' => $limit,
            ],
        ];
    }

    public static function syncAll()
    {
        $entries = OsuWiki::fetch('news');

        $latestSlugs = [];

        foreach ($entries as $entry) {
            if (($entry['type'] ?? null) === 'file' && ends_with($entry['name'], '.md')) {
                $slug = substr($entry['name'], 0, -3);
                $hash = $entry['sha'];

                $latestSlugs[$slug] = $hash;
            }
        }

        foreach (static::all() as $post) {
            if (array_key_exists($post->slug, $latestSlugs)) {
                if ($latestSlugs[$post->slug] !== $post->hash) {
                    $post->sync(true);
                }

                unset($latestSlugs[$post->slug]);
            } else {
                $post->update(['published_at' => null]);
            }
        }

        // prevent time-based expiration
        // FIXME: should use its own column instead so we can tell whether or not it's actually updated
        static::select()->update(['updated_at' => Carbon::now()]);

        foreach (array_keys($latestSlugs) as $newSlug) {
            try {
                static::create(['slug' => $newSlug])->sync();
            } catch (Exception $e) {
                if (is_sql_unique_exception($e)) {
                    continue;
                }

                throw $e;
            }
        }
    }

    public function scopeDefault($query)
    {
        return $query->published()->orderBy('published_at', 'DESC');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now());
    }

    public function commentableTitle()
    {
        return $this->title();
    }

    public function filename()
    {
        return "{$this->slug}.md";
    }

    public function isVisible()
    {
        return $this->page !== null && $this->published_at !== null && $this->published_at->isPast();
    }

    public function needsSync()
    {
        return $this->page === null ||
            $this->version !== static::pageVersion() ||
            $this->updated_at < Carbon::now()->subMinutes(static::CACHE_DURATION);
    }

    public function notificationCover()
    {
        return $this->firstImage();
    }

    public function bodyHtml()
    {
        return $this->page['output'];
    }

    public function editUrl()
    {
        return 'https://github.com/'.OsuWiki::user().'/'.OsuWiki::repository().'/tree/master/news/'.$this->filename();
    }

    public function firstImage($absolute = false)
    {
        $url = $this->page['firstImage'];

        if ($url === null) {
            return;
        }

        if ($absolute && !starts_with($url, ['https://', 'http://'])) {
            if ($url[0] === '/') {
                $url = config('app.url').$url;
            } else {
                $url = "{$this->url()}/{$url}";
            }
        }

        return $url;
    }

    public function newer()
    {
        if (!array_key_exists('newer', $this->adjacent)) {
            $this->adjacent['newer'] = static
                ::where('published_at', '>=', $this->published_at)
                ->where('id', '<>', $this->getKey())
                ->orderBy('published_at', 'ASC')
                ->orderBy('id', 'ASC')
                ->first() ?? null;
        }

        return $this->adjacent['newer'];
    }

    public function older()
    {
        if (!array_key_exists('older', $this->adjacent)) {
            $this->adjacent['older'] = static
                ::where('published_at', '<=', $this->published_at)
                ->where('id', '<>', $this->getKey())
                ->orderBy('published_at', 'DESC')
                ->orderBy('id', 'DESC')
                ->first() ?? null;
        }

        return $this->adjacent['older'];
    }

    public function sync($force = false)
    {
        if (!$force && !$this->needsSync()) {
            return $this;
        }

        $path = "news/{$this->filename()}";
        $pathMissingKey = "osu_wiki:not_found:{$path}";

        if (!$force && cache()->get($pathMissingKey) !== null) {
            return $this;
        }

        try {
            $file = new OsuWiki($path);
        } catch (GitHubNotFoundException $e) {
            if ($this->exists) {
                $this->update(['published_at' => null]);
            } else {
                cache()->put($pathMissingKey, 1, 300);
            }

            return $this;
        } catch (Exception $e) {
            log_error($e);

            return $this;
        }

        $rawPage = $file->content();

        $this->page = (new OsuMarkdown('news', [
            'relative_url_root' => route('news.show', $this->slug),
        ]))->load($rawPage)->toArray();

        $this->version = static::pageVersion();
        $this->published_at = $this->pagePublishedAt();
        $this->tumblr_id = $this->pageTumblrId();
        $this->hash = $file->data['sha'];

        $this->save();

        return $this;
    }

    public function pagePublishedAt()
    {
        $date = $this->page['header']['date'] ?? null;

        if ($date === null) {
            $date = substr($this->slug, 0, 10);

            if (preg_match('/^\d{4}-\d{2}-\d{2}/', $date) !== 1) {
                $date = null;
            }
        }

        if ($date !== null) {
            return Carbon::parse($date);
        }
    }

    public function pageTumblrId()
    {
        $tumblrUrl = $this->page['header']['tumblr_url'] ?? null;

        if (present($tumblrUrl)) {
            preg_match('#^.*/post/(?<id>[^/]+)/.*$#', $tumblrUrl, $matches);

            return $matches['id'];
        } else {
            return;
        }
    }

    public function previewText()
    {
        return first_paragraph($this->bodyHtml());
    }

    public function title()
    {
        return $this->page['header']['title'];
    }

    public function url()
    {
        return route('news.show', $this->slug);
    }
}
