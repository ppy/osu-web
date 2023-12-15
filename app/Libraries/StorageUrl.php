<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class StorageUrl
{
    public static function make(?string $diskName, string $path): string
    {
        $diskName ??= $GLOBALS['cfg']['filesystems']['default'];
        $baseUrl = $GLOBALS['cfg']['filesystems']['disks'][$diskName]['base_url'];

        return "{$baseUrl}/{$path}";
    }
}
