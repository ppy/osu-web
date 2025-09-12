<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Libraries\ImageProcessor;
use App\Libraries\StorageUrl;
use App\Models\User;

class AvatarHelper
{
    public static function set(User $user, ?\SplFileInfo $src): bool
    {
        $id = $user->getKey();
        $storage = \Storage::disk(static::disk());

        if ($src === null) {
            $storage->delete($id);
        } else {
            $srcPath = $src->getRealPath();
            $processor = new ImageProcessor($srcPath, [256, 256], 100000);
            $processor->process();

            $storage->putFileAs('/', $src, $id, 'public');
            $entry = $id.'_'.time().'.'.$processor->ext();
        }

        static::purgeCache($id);

        return $user->update(['user_avatar' => $entry ?? '']);
    }

    public static function url(User $user): string
    {
        $value = $user->getRawAttribute('user_avatar');

        return present($value)
            ? StorageUrl::make(static::disk(), strtr($value, '_', '?'))
            : $GLOBALS['cfg']['osu']['avatar']['default'];
    }

    private static function disk(): string
    {
        return "{$GLOBALS['cfg']['filesystems']['default']}-avatar";
    }

    private static function purgeCache(int $id): void
    {
        $prefix = presence($GLOBALS['cfg']['osu']['avatar']['cache_purge_prefix']);

        if ($prefix === null) {
            return;
        }

        $method = $GLOBALS['cfg']['osu']['avatar']['cache_purge_method'] ?? 'GET';
        $auth = $GLOBALS['cfg']['osu']['avatar']['cache_purge_authorization_key'];
        $ctx = [
            'http' => [
                'method' => $method,
                'header' => present($auth) ? "Authorization: {$auth}" : null,
            ],
        ];
        $suffix = $method === 'GET' ? '?'.time() : ''; // Bypass CloudFlare cache if using GET
        $url = "{$prefix}{$id}{$suffix}";

        try {
            file_get_contents($url, false, stream_context_create($ctx));
        } catch (\ErrorException $e) {
            // ignores 404 errors, throws everything else
            if (!ends_with($e->getMessage(), "404 Not Found\r\n")) {
                throw $e;
            }
        }
    }
}
