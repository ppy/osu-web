<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use Storage;

class StorageWithUrl
{
    private string $baseUrl;
    private $disk;
    private string $diskName;

    public function __construct($diskName = null)
    {
        $this->diskName = $diskName ?? config('filesystems.default');
    }

    public function url($path)
    {
        $this->baseUrl ??= config("filesystems.disks.{$this->diskName}.base_url");

        return "{$this->baseUrl}/{$path}";
    }

    public function __call($method, $parameters)
    {
        $this->disk ??= Storage::disk($this->diskName);

        return call_user_func_array([$this->disk, $method], $parameters);
    }
}
