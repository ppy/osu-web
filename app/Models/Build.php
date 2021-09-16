<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\Commentable;
use App\Traits\CommentableDefaults;
use Carbon\Carbon;

/**
 * @property bool $allow_bancho
 * @property int $allow_ranking
 * @property int $build_id
 * @property \Illuminate\Database\Eloquent\Collection $changelogEntries ChangelogEntry
 * @property \Illuminate\Database\Eloquent\Collection $changelogs Changelog
 * @property string $commentable_identifier
 * @property Comment $comments
 * @property \Carbon\Carbon $date
 * @property mixed|null $hash
 * @property mixed|null $last_hash
 * @property \Illuminate\Database\Eloquent\Collection $propagationHistories BuildPropagationHistory
 * @property int|null $stream_id
 * @property int $test_build
 * @property UpdateStream $updateStream
 * @property int $users
 * @property string|null $version
 */
class Build extends Model implements Commentable
{
    use CommentableDefaults;

    public $timestamps = false;

    protected $table = 'osu_builds';
    protected $primaryKey = 'build_id';

    protected $dates = [
        'date',
    ];

    protected $casts = [
        'allow_bancho' => 'boolean',
    ];

    private $cache = [];

    public static function importFromGithubNewTag($data)
    {
        $repository = Repository::where([
            'name' => $data['repository']['full_name'],
            'build_on_tag' => true,
        ])->first();

        // abort on unknown or non-auto build repository
        if ($repository === null) {
            return;
        }

        $tag = explode('-', substr($data['ref'], strlen('refs/tags/')));
        $version = $tag[0];
        $streamName = $tag[1] ?? null;

        if ($streamName !== null) {
            $stream = UpdateStream::where('name', '=', $streamName)->first();
        }

        if (!isset($stream)) {
            $stream = $repository->mainUpdateStream;
        }

        if (!isset($stream)) {
            return;
        }

        $build = $stream->builds()->firstOrCreate([
            'version' => $version,
        ]);

        $lastChange = Carbon::parse($data['head_commit']['timestamp']);

        $changelogEntry = new ChangelogEntry();

        $newChangelogEntryIds = $stream
            ->changelogEntries()
            ->orphans($stream->getKey())
            ->where($changelogEntry->qualifyColumn('created_at'), '<=', $lastChange)
            ->pluck($changelogEntry->qualifyColumn('id'));

        $build->changelogEntries()->attach($newChangelogEntryIds);

        return $build;
    }

    public function updateStream()
    {
        return $this->belongsTo(UpdateStream::class, 'stream_id', 'stream_id');
    }

    // FIXME: Need to match stream_id as well. It's currently checked in transformer.
    public function changelogs()
    {
        return $this->hasMany(Changelog::class, 'build', 'version');
    }

    public function defaultChangelogs()
    {
        return $this->changelogs()->default();
    }

    public function changelogEntries()
    {
        return $this->belongsToMany(ChangelogEntry::class, null, 'build_id');
    }

    public function defaultChangelogEntries()
    {
        return $this->changelogEntries()->default();
    }

    public function scopeDefault($query)
    {
        $query->whereIn('stream_id', config('osu.changelog.update_streams'));
    }

    public function propagationHistories()
    {
        return $this->hasMany(BuildPropagationHistory::class);
    }

    public function scopePropagationHistory($query)
    {
        $query->default()->where('allow_bancho', true);
    }

    public function scopeSearch($query, $params)
    {
        if (isset($params['stream'])) {
            $stream = UpdateStream::where('name', '=', $params['stream'])->first();

            if ($stream === null) {
                return $query->none();
            }

            $query->where('stream_id', '=', $stream->getKey());
        } else {
            $stream = null;
        }

        if (isset($params['from'])) {
            $query->where('build_id', '>=', function ($q) use ($params, $stream) {
                $q->from($this->getTable())
                    ->where('version', '=', $params['from'])
                    ->select('build_id')
                    ->limit(1);

                if ($stream !== null) {
                    $q->where('stream_id', '=', $stream->getKey());
                }
            });
        }

        if (isset($params['to'])) {
            $query->where('build_id', '<=', function ($q) use ($params, $stream) {
                $q->from($this->getTable())
                    ->where('version', '=', $params['to'])
                    ->select('build_id')
                    ->limit(1);

                if ($stream !== null) {
                    $q->where('stream_id', '=', $stream->getKey());
                }
            });
        }

        if (isset($params['max_id'])) {
            $query->where('build_id', '<=', $params['max_id']);
        }

        if (isset($params['limit'])) {
            $query->limit($params['limit']);
        }
    }

    public function commentableTitle()
    {
        if ($this->stream_id === null || $this->updateStream === null) {
            return $this->displayVersion();
        }

        return "{$this->updateStream->pretty_name} {$this->displayVersion()}";
    }

    public function notificationCover()
    {
        // no image
    }

    public function url()
    {
        return build_url($this);
    }

    public function versionNext()
    {
        if (!array_key_exists('versionNext', $this->cache)) {
            $this->cache['versionNext'] = static
                ::default()
                ->where('build_id', '>', $this->build_id)
                ->where('stream_id', $this->stream_id)
                ->orderBy('build_id', 'ASC')
                ->first();
        }

        return $this->cache['versionNext'];
    }

    public function versionPrevious()
    {
        if (!array_key_exists('versionPrevious', $this->cache)) {
            $this->cache['versionPrevious'] = static
                ::default()
                ->where('build_id', '<', $this->build_id)
                ->where('stream_id', $this->stream_id)
                ->orderBy('build_id', 'DESC')
                ->first();
        }

        return $this->cache['versionPrevious'];
    }

    public function displayVersion()
    {
        return preg_replace('#[^0-9.]#', '', $this->version);
    }
}
