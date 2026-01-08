<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

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

    public static function isLegacyId(int $id): bool
    {
        return $id < $GLOBALS['cfg']['osu']['screenshots']['legacy_id_cutoff'];
    }

    private static function hashForId(int $id): string
    {
        return substr(md5($id.$GLOBALS['cfg']['osu']['screenshots']['shared_secret']), 0, 4);
    }

    public static function lookup(int $id, ?string $hash): ?self
    {
        if ($hash === null) {
            if (!self::isLegacyId($id)) {
                return null;
            }
        } else if (self::hashForId($id) !== $hash) {
            return null;
        }

        return self::findOrFail($id);
    }

    public function store($file): void
    {
        $this->storage()->putFileAs('/', $file, "{$this->getKey()}.jpg");
    }

    public function fetch(): ?string
    {
        return $this->storage()->get("{$this->getKey()}.jpg");
    }

    public function url(): string
    {
        return route('screenshots.show', [
            'screenshot' => $this->getKey(),
            'hash' => $this->hash(),
        ]);
    }

    public function hash(): ?string
    {
        if (self::isLegacyId($this->getKey())) {
            return null;
        }

        return self::hashForId($this->getKey());
    }

    private function storage(): Filesystem
    {
        return \Storage::disk("{$GLOBALS['cfg']['filesystems']['default']}-screenshot");
    }
}
