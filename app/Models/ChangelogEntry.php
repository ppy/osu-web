<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\OsuWiki;
use App\Traits\Memoizes;
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
    use Memoizes;

    protected $casts = [
        'private' => 'boolean',
        'major' => 'boolean',
    ];

    public static function convertLegacy($changelog)
    {
        $splitMessage = static::splitMessage($changelog->message);
        $title = presence($splitMessage[0]);
        $message = $splitMessage[1];

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

    public static function getDisplayMessage(?string $origMessage): string
    {
        $split = static::splitMessage($origMessage);

        return $split[1] === null ? '' : $split[0];
    }

    public static function guessCategory($data)
    {
        static $ignored = [
            'high priority',
            'resolves issue',
            'update',
        ];

        static $ignoredPrefixes = [
            'priority:',
            'size/',
        ];

        if ($data['repository']['full_name'] === OsuWiki::user().'/'.OsuWiki::repository()) {
            return;
        }

        foreach ($data['pull_request']['labels'] as $label) {
            $name = $label['name'];

            $lowerName = strtolower($name);
            if (in_array($lowerName, $ignored, true)) {
                continue;
            }

            if (starts_with($lowerName, $ignoredPrefixes)) {
                continue;
            }

            $separatorPos = strpos($name, ':');
            if ($separatorPos !== false) {
                $name = substr($name, $separatorPos + 1);
            }

            if (strpos($name, ' ') === false) {
                $name = str_replace('-', ' ', $name);
            }

            return ucwords($name);
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
            'message' => static::getDisplayMessage($data['pull_request']['body']),
            'private' => static::isPrivate($data),
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

    public static function isPrivate($data)
    {
        static $privateCategories = [
            'dependencies',
        ];

        foreach ($data['pull_request']['labels'] as $label) {
            $name = $label['name'];

            if (in_array(strtolower($name), $privateCategories, true)) {
                return true;
            }
        }

        return false;
    }

    public static function placeholder()
    {
        return new static([
            'title' => osu_trans('changelog.generic'),
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

    /**
     * Returns array of message split by thematic break (`---`)
     *
     * The array length is always two.
     * If the message is empty, both values will be null.
     * If there's no thematic break, the second value will be null.
     */
    public static function splitMessage($message): array
    {
        if (!present($message)) {
            return [null, null];
        }

        static $separator = "\n\n---\n";
        // Surround with newlines to handle separator at the start/end.
        $message = "\n\n".trim(strtr($message, ["\r\n" => "\n"]))."\n";
        $splitPos = strpos($message, $separator);

        return $splitPos === false
            ? [trim($message), null]
            : [
                trim(substr($message, 0, $splitPos)),
                trim(substr($message, $splitPos + strlen($separator))),
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

    public function messageHtml(): ?string
    {
        return $this->memoize(__FUNCTION__, function () {
            $message = $this->message;

            return present($message) ? markdown($message, 'changelog_entry') : null;
        });
    }
}
