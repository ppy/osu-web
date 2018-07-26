<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

class ReplayFile
{
    private $diskName;
    private $filename;

    public function __construct($score)
    {
        $this->filename = $score->getKey();
        $mode = $score->gameModeString();
        $this->diskName = 'replays.'.$mode.'.'.config('osu.score_replays.storage');
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->disk(), $method], array_merge([$this->filename], $parameters));
    }

    public function disk()
    {
        return Storage::disk($this->diskName);
    }
}
