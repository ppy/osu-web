<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Illuminate\Contracts\Filesystem\Cloud;

class StorageWithUrl
{
    private string $baseUrl;
    private Cloud $disk;
    private string $diskName;

    public function __construct(?string $diskName = null)
    {
        $this->diskName = $diskName ?? config('filesystems.default');
    }

    public function url(string $path): string
    {
        $this->baseUrl ??= config("filesystems.disks.{$this->diskName}.base_url");

        return "{$this->baseUrl}/{$path}";
    }

    public function __call($method, $parameters)
    {
        $this->disk ??= \Storage::disk($this->diskName);

        return $this->disk->$method(...$parameters);
    }
}
