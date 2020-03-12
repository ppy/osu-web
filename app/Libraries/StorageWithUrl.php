<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use Storage;

class StorageWithUrl
{
    private $disk;
    private $baseUrl;

    public function __construct($diskName = null)
    {
        $diskName = $diskName ?? config('filesystems.default');

        $this->disk = Storage::disk($diskName);

        $this->baseUrl = config("filesystems.disks.{$diskName}.base_url");
    }

    public function url($path)
    {
        return "{$this->baseUrl}/{$path}";
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->disk, $method], $parameters);
    }
}
