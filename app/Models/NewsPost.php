<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
use App\Libraries\OsuMarkdownProcessor;
use App\Libraries\OsuWiki;
use Carbon\Carbon;
use Exception;

class NewsPost extends Model
{
    // in minutes
    const CACHE_DURATION = 86400;
    const VERSION = 3;

    protected $casts = [
        'page' => 'array',
    ];

    protected $dates = [
        'published_at',
    ];

    private $adjacent = [];

    public static function lookupAndSync($slug)
    {
        $post = static::where(['slug' => $slug])->first();

        if ($post === null) {
            $post = new static(['slug' => $slug]);
        }

        $post->sync();

        if ($post->page !== null) {
            return $post;
        }
    }

    public static function pageVersion()
    {
        return static::VERSION.'.'.OsuMarkdownProcessor::VERSION;
    }

    public static function syncAll()
    {
        try {
            $entries = OsuWiki::fetch('news');
        } catch (Exception $e) {
            log_error($e);

            return;
        }

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
                } else {
                }

                unset($latestSlugs[$post->slug]);
            } else {
                $post->update(['published_at' => null]);
            }
        }

        // prevent time-based expiration
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

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scopeDefault($query)
    {
        $query->whereNotNull('published_at')->orderBy('published_at', 'DESC');
    }

    public function filename()
    {
        return "{$this->slug}.md";
    }

    public function needsSync()
    {
        return $this->page === null ||
            $this->version !== static::pageVersion() ||
            $this->updated_at < Carbon::now()->subMinutes(static::CACHE_DURATION);
    }

    public function bodyHtml()
    {
        return $this->page['output'];
    }

    public function editUrl()
    {
        return 'https://github.com/'.OsuWiki::USER.'/'.OsuWiki::REPOSITORY.'/tree/master/news/'.$this->filename();
    }

    public function firstImage()
    {
        return $this->page['firstImage'];
    }

    public function newer()
    {
        if (!array_key_exists('newer', $this->adjacent)) {
            $this->adjacent['newer'] = static::select('slug')
                ->where('published_at', '>=', $this->published_at)
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
            $this->adjacent['older'] = static::select('slug')
                ->where('published_at', '<=', $this->published_at)
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
            return;
        }

        try {
            $file = new OsuWiki("news/{$this->filename()}");
        } catch (GitHubNotFoundException $e) {
            if ($this->exists) {
                $this->update(['published_at' => null]);
            }

            return;
        } catch (Exception $e) {
            log_error($e);

            return;
        }

        $rawPage = $file->content();

        $this->page = OsuMarkdownProcessor::process($rawPage, [
            'html_input' => 'allow',
            'path' => route('news.show', $this->slug),
            'block_modifiers' => ['news'],
        ]);

        $this->version = static::pageVersion();
        $this->published_at = $this->pagePublishedAt();
        $this->tumblr_id = $this->pageTumblrId();
        $this->hash = $file->data['sha'];

        $this->save();
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
}
