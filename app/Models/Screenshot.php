<?php

declare(strict_types=1);

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;

/**
 * @property int $screenshot_id
 * @property int $user_id
 * @property User $user
 * @property Carbon $timestamp
 * @property int $hits
 * @property Carbon $last_access
 * @property bool $deleted
 */
class Screenshot extends Model
{
    public $timestamps = false;
    protected $table = 'osu_screenshots';
    protected $primaryKey = 'screenshot_id';

    protected $casts = [
        'timestamp' => 'datetime',
        'last_access' => 'datetime',
        'deleted' => 'boolean',
    ];

    public function store($file): void
    {
        $this->storage()->putFileAs('/', $file, "{$this->getKey()}.jpg");
    }

    public function url(): string
    {
        return route('screenshots.show', [
            'screenshot' => $this->getKey(),
            'hash' => substr(md5($this->getKey().$GLOBALS['cfg']['osu']['screenshots']['shared_secret']), 0, 4),
        ]);
    }

    private function storage(): Filesystem
    {
        return \Storage::disk("{$GLOBALS['cfg']['filesystems']['default']}-screenshot");
    }
}
