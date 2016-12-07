<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

trait UserAvatar
{
    private $avatarStorage;

    public function avatarStorage()
    {
        if ($this->avatarStorage === null) {
            $this->avatarStorage = new StorageWithUrl(config('osu.avatar_storage'));
        }

        return $this->avatarStorage;
    }

    public function getUserAvatarAttribute($value)
    {
        if (!present($value)) {
            return 'https://s.ppy.sh/images/blank.jpg';
        }

        return $this->avatarStorage()->url(str_replace('_', '?', $value));
    }

    public function setAvatar($file)
    {
        $storage = $this->avatarStorage();

        if ($file === null) {
            $storage->delete($this->user_id);
        } else {
            $filePath = $file->getRealPath();
            (new ImageProcessor($filePath, [256, 256], 100000))->process();

            $storage->put($this->user_id, file_get_contents($filePath));
            $entry = $this->user_id.'_'.time();
        }

        return $this->update(['user_avatar' => $entry ?? null]);
    }
}
