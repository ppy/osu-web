<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Traits;

use App\Libraries\ImageProcessor;
use App\Libraries\StorageWithUrl;
use ErrorException;

trait UserAvatar
{
    private $avatarStorage;

    public function avatarStorage()
    {
        if ($this->avatarStorage === null) {
            $this->avatarStorage = new StorageWithUrl(config('osu.avatar.storage'));
        }

        return $this->avatarStorage;
    }

    public function getUserAvatarAttribute($value)
    {
        if (!present($value)) {
            return config('osu.avatar.default');
        }

        return $this->avatarStorage()->url(str_replace('_', '?', $value));
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
                file_get_contents(config('osu.avatar.cache_purge_prefix').$this->user_id.'?'.time());
            } catch (ErrorException $e) {
                // ignores 404 errors, throws everything else
                if (!ends_with($e->getMessage(), "404 Not Found\r\n")) {
                    throw $e;
                }
            }
        }

        return $this->update(['user_avatar' => $entry ?? null]);
    }
}
