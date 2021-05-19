<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\GitHubNotFoundException;
use App\Libraries\Commentable;
use App\Libraries\Markdown\OsuMarkdown;
use App\Libraries\OsuWiki;
use App\Traits\CommentableDefaults;
use App\Traits\Memoizes;
use App\Traits\WithDbCursorHelper;
use Carbon\Carbon;
use Exception;

/**
 * @property string $commentable_identifier
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
    use CommentableDefaults, Memoizes, WithDbCursorHelper;

    // in minutes
    const CACHE_DURATION = 86400;
    const VERSION = 3;
    const DASHBOARD_LIMIT = 8;
    const LANDING_LIMIT = 4;

    const SORTS = [
        'published_asc' => [
            ['column' => 'published_at', 'order' => 'ASC', 'type' => 'time'],
            ['column' => 'id', 'order' => 'ASC'],
        ],
        'published_desc' => [
            ['column' => 'published_at', 'order' => 'DESC', 'type' => 'time'],
            ['column' => 'id', 'order' => 'DESC'],
        ],
    ];

    const DEFAULT_SORT = 'published_desc';

    protected $casts = [
        'page' => 'array',
    ];

    protected $dates = [
        'published_at',
    ];

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

        $cursorHelper = static::makeDbCursorHelper();
        $cursor = get_arr($params['cursor'] ?? null);
        $query->cursorSort($cursorHelper, $cursor);

        $query->year(get_int($params['year'] ?? null));

        $query->limit($limit);

        return [
            'cursorHelper' => $cursorHelper,
            'query' => $query,
            'params' => ['limit' => $limit, 'sort' => $cursorHelper->getSortName()],
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

    public function scopeYear($query, $year)
    {
        if ($year === null) {
            return;
        }

        $baseStart = Carbon::create($year);
        $currentDate = now();

        // show extra months in first three months of current year
        if ($currentDate->year === $baseStart->year && $currentDate->month < 4) {
            $start = $currentDate->startOfYear()->subMonths(2);
        }

        $end = Carbon::create($year + 1);

        return $query
            ->where('published_at', '>=', $start ?? $baseStart)
            ->where('published_at', '<', $end);
    }

    public function author()
    {
        if (!isset($this->page['header']['author']) && !isset($this->page['author'])) {
            $authorLine = html_entity_decode_better(
                array_last(
                    explode("\n", trim(
                        strip_tags($this->bodyHtml())
                    ))
                )
            );

            if (preg_match('/^[—–][^—–]/', $authorLine) === false) {
                $author = 'osu!news Team';
            } else {
                $author = mb_substr($authorLine, 1);
            }

            $this->update(['page' => array_merge($this->page, compact('author'))]);
        }

        return $this->page['author'];
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
        return 'https://github.com/'.OsuWiki::user().'/'.OsuWiki::repository().'/tree/'.OsuWiki::branch().'/news/'.$this->filename();
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
        return $this->memoize(__FUNCTION__, function () {
            return static::cursorSort('published_asc', $this)->first();
        });
    }

    public function older()
    {
        return $this->memoize(__FUNCTION__, function () {
            return static::cursorSort('published_desc', $this)->first();
        });
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
        return $this->page['header']['title'] ?? 'Title-less news post';
    }

    public function url()
    {
        return route('news.show', $this->slug);
    }
}
