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

use Carbon\Carbon;
use Exception;
use Markdown;

class ChangelogEntry extends Model
{
    protected $casts = [
        'private' => 'boolean',
        'major' => 'boolean',
    ];

    public static function convertLegacy($changelog)
    {
        return new static([
            'title' => $changelog->message,
            'url' => $changelog->url,
            'category' => $changelog->category,
            'type' => $changelog->prefix,
            'private' => $changelog->private,
            'major' => $changelog->major,
            'created_at' => $changelog->date,
            'githubUser' => new GithubUser([
                'user_id' => $changelog->user_id,
                'user' => $changelog->user,
            ]),
            'repository' => null,
        ]);
    }

    public static function importFromGithub($data)
    {
        $githubUser = GithubUser::importFromGithub($data['pull_request']['user']);
        $repository = Repository::importFromGithub($data['repository']);

        $entry = $repository->changelogEntries()->make([
            'github_pull_request_id' => $data['pull_request']['number'],
            'title' => $data['pull_request']['title'],
            'message' => $data['pull_request']['body'],
            'created_at' => Carbon::parse($data['pull_request']['merged_at']),
        ]);
        $entry->githubUser()->associate($githubUser);

        try {
            $entry->saveOrExplode();
        } catch (Exception $e) {
            if (!is_sql_unique_exception($e)) {
                throw $e;
            }

            return $repository->changelogEntries()->where([
                'github_pull_request_id' => $entry->github_pull_request_id,
            ])->first();
        }

        return $entry;
    }

    public static function placeholder()
    {
        return new static([
            'title' => trans('changelog.generic'),
            'githubUser' => new GithubUser([
                'username' => 'peppy',
                'user_id' => null,
                'user' => null,
            ]),
            'repository' => null,
        ]);
    }

    public function builds()
    {
        return $this->belongsToMany(Build::class, null, null, 'build_id');
    }

    public function githubUser()
    {
        return $this->belongsTo(GithubUser::class);
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    public function getTypeAttribute($value)
    {
        return presence($value) ?? 'fix';
    }

    public function getCategoryAttribute($value)
    {
        return presence($value) ?? optional($this->repository)->default_category ?? 'Misc';
    }

    public function getUrlAttribute($value)
    {
        return presence($value);
    }

    public function scopeDefault($query)
    {
        $query
            ->orderBy($this->getKeyName(), 'DESC')
            ->where('private', false);
    }

    public function scopeOrphans($query, $streamId)
    {
        $query->whereDoesntHave('builds', function ($query) use ($streamId) {
            $query->where('stream_id', '=', $streamId);
        });
    }

    public function hasGithubPR()
    {
        return $this->repository !== null && present($this->github_pull_request_id);
    }

    public function githubUrl()
    {
        if ($this->hasGithubPR()) {
            return "https://github.com/{$this->repository->name}/pull/{$this->github_pull_request_id}";
        }
    }

    public function messageHTML()
    {
        if (!present($this->message)) {
            return;
        }

        static $separator = "\n\n---\n";
        static $openingSeparator = "---\n";

        $origMessage = trim(str_replace("\r\n", "\n", $this->message));

        if (starts_with($origMessage, $openingSeparator)) {
            $publicMessageStart = strlen($openingSeparator);
        } else {
            $publicMessageStart = strpos($origMessage, $separator);

            if ($publicMessageStart === false) {
                return;
            } else {
                $publicMessageStart += strlen($separator);
            }
        }

        $message = trim(substr($origMessage, $publicMessageStart));

        return present($message) ? Markdown::convertToHtml($message) : null;
    }
}
