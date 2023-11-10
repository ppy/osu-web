<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class StorageUrl
{
    public static function make(?string $diskName, string $path): string
    {
        $diskName ??= \Config::get('filesystems.default');
        $baseUrl = \Config::get("filesystems.disks.{$diskName}.base_url");

        return "{$baseUrl}/{$path}";
    }
}
