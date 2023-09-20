<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

use App\Libraries\ImageProcessor;
use App\Libraries\StorageWithUrl;
use ErrorException;

trait UserAvatar
{
    private $avatarStorage;

    public function avatarStorage()
    {
        return $this->avatarStorage ??= new StorageWithUrl(config('osu.avatar.storage'));
    }

    public function setUserAvatarAttribute($value)
    {
        $this->attributes['user_avatar'] = presence($value) ?? '';
    }

    public function setAvatar($file)
    {
        if ($file === null) {
            $this->avatarStorage()->delete($this->user_id);
        } else {
            $filePath = $file->getRealPath();
            $processor = new ImageProcessor($filePath, [256, 256], 100000);
            $processor->process();

            $this->avatarStorage()->put($this->user_id, file_get_contents($filePath), 'public');

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

        return $this->update(['user_avatar' => $entry ?? null]);
    }

    protected function getUserAvatar()
    {
        $value = presence($this->getRawAttribute('user_avatar'));

        return $value === null
            ? config('osu.avatar.default')
            : $this->avatarStorage()->url(str_replace('_', '?', $value));
    }
}
