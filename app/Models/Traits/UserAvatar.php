<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

use App\Libraries\ImageProcessor;
use App\Libraries\StorageUrl;
use ErrorException;

trait UserAvatar
{
    private static function avatarDisk(): string
    {
        return config('osu.avatar.storage');
    }

    public function setAvatar($file)
    {
        $storage = \Storage::disk(static::avatarDisk());
        if ($file === null) {
            $storage->delete($this->user_id);
        } else {
            $filePath = $file->getRealPath();
            $processor = new ImageProcessor($filePath, [256, 256], 100000);
            $processor->process();

            $storage->put($this->user_id, file_get_contents($filePath), 'public');

            $entry = $this->user_id.'_'.time().'.'.$processor->ext();
        }

        if (present(config('osu.avatar.cache_purge_prefix'))) {
            try {
                $ctx = [
                    'http' => [
                        'method' => config('osu.avatar.cache_purge_method') ?? 'GET',
                        'header' => present(config('osu.avatar.cache_purge_authorization_key'))
                            ? 'Authorization: '.config('osu.avatar.cache_purge_authorization_key')
                            : null,
                    ],
                ];
                $prefix = config('osu.avatar.cache_purge_prefix');
                $suffix = $ctx['http']['method'] === 'GET' ? '?'.time() : ''; // Bypass CloudFlare cache if using GET
                $url = $prefix.$this->user_id.$suffix;
                file_get_contents($url, false, stream_context_create($ctx));
            } catch (ErrorException $e) {
                // ignores 404 errors, throws everything else
                if (!ends_with($e->getMessage(), "404 Not Found\r\n")) {
                    throw $e;
                }
            }
        }

        return $this->update(['user_avatar' => $entry ?? '']);
    }

    protected function getUserAvatar()
    {
        $value = $this->getRawAttribute('user_avatar');

        return present($value)
            ? StorageUrl::make(static::avatarDisk(), strtr($value, '_', '?'))
            : config('osu.avatar.default');
    }
}
