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
