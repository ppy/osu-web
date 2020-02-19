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

use App\Libraries\OsuWiki;
use Carbon\Carbon;
use Exception;

/**
 * @property \Illuminate\Database\Eloquent\Collection $builds Build
 * @property string|null $category
 * @property \Carbon\Carbon|null $created_at
 * @property GithubUser $githubUser
 * @property int|null $github_pull_request_id
 * @property int|null $github_user_id
 * @property int $id
 * @property bool $major
 * @property string|null $message
 * @property bool $private
 * @property Repository $repository
 * @property int|null $repository_id
 * @property string|null $title
 * @property string|null $type
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $url
 */
class ChangelogEntry extends Model
{
    protected $casts = [
        'private' => 'boolean',
        'major' => 'boolean',
    ];

    public static function convertLegacy($changelog)
    {
        $message = $changelog->message;
        $splitMessage = static::splitMessage($message);
        $title = $splitMessage[0];

        if ($title === null) {
            $title = $splitMessage[1];
            $message = null;
        }

        return new static([
            'title' => $title,
            'message' => $message,
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

    public static function guessCategory($data)
    {
        static $ignored = [
            'high priority',
            'resolves issue',
            'size/xs',
            'size/s',
            'size/m',
            'size/l',
            'size/xl',
            'size/xxl',
            'update',
        ];

        if ($data['repository']['full_name'] === OsuWiki::user().'/'.OsuWiki::repository()) {
            return;
        }

        foreach ($data['pull_request']['labels'] as $label) {
            $name = $label['name'];

            if (!in_array(strtolower($name), $ignored, true)) {
                return ucwords($name);
            }
        }
    }

    public static function guessType($data)
    {
        $title = $data['pull_request']['title'];

        if (strtolower(substr($title, 0, 4)) === 'add ') {
            return 'add';
        }
    }

    public static function importFromGithub($data)
    {
        $githubUser = GithubUser::importFromGithub($data['pull_request']['user']);
        $repository = Repository::importFromGithub($data['repository']);

        $entry = $repository->changelogEntries()->make([
            'category' => static::guessCategory($data),
            'created_at' => Carbon::parse($data['pull_request']['merged_at']),
            'github_pull_request_id' => $data['pull_request']['number'],
            'message' => $data['pull_request']['body'],
            'title' => $data['pull_request']['title'],
            'type' => static::guessType($data),
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
            'private' => false,
            'major' => false,
            'created_at' => Carbon::createFromTimestamp(0),
            'githubUser' => new GithubUser([
                'username' => 'peppy',
                'user_id' => null,
                'user' => null,
            ]),
            'repository' => null,
        ]);
    }

    public static function splitMessage($message)
    {
        if (!present($message)) {
            return [null, null];
        }

        static $separator = "\n\n---\n";
        // prepended with \n\n just in case the message starts with ---\n (blank first part).
        $message = "\n\n".trim(str_replace("\r\n", "\n", $message));
        $splitPos = strpos($message, $separator);

        if ($splitPos === false) {
            $splitPos = strlen($message);
        }

        return [
            presence(trim(substr($message, 0, $splitPos))),
            presence(trim(substr($message, $splitPos + strlen($separator)))),
        ];
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
        [$private, $public] = static::splitMessage($this->message);

        if ($public !== null) {
            return markdown($public, 'changelog_entry');
        }
    }
}
