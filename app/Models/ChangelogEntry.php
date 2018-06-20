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

class ChangelogEntry extends Model
{
    protected $guarded = [];

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
        ]);
    }

    public static function importFromGithub($data)
    {
        $githubUser = GithubUser::importFromGithub($data['pull_request']['user']);

        $params = [
            'repository' => $data['repository']['full_name'],
            'github_pull_request_id' => $data['pull_request']['number'],
            'title' => $data['pull_request']['title'],
            'message' => $data['pull_request']['body'],
            'github_user_id' => $githubUser->getKey(),
            'created_at' => Carbon::parse($data['pull_request']['merged_at']),
        ];

        try {
            return static::create($params);
        } catch (Exception $e) {
            if (!is_sql_unique_exception($e)) {
                throw $e;
            }

            return static::where([
                'repository' => $params['repository'],
                'github_pull_request_id' => $params['github_pull_request_id'],
            ])->first();
        }
    }

    public static function placeholder()
    {
        return new static([
            'title' => trans('changelog.generic'),
            'githubUser' => new GithubUser(['username' => 'peppy']),
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

    public function getTypeAttribute($value)
    {
        return presence($value) ?? 'fix';
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

    public function repositoryName()
    {
        if ($this->hasGithubPR()) {
            return substr($this->repository, 1 + strpos($this->repository, '/'));
        }
    }

    public function hasGithubPR()
    {
        return present($this->repository) && present($this->github_pull_request_id);
    }

    public function githubUrl()
    {
        if ($this->hasGithubPR()) {
            return "https://github.com/{$this->repository}/pull/{$this->github_pull_request_id}";
        }
    }
}
