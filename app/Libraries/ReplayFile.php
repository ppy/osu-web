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

use App\Models\Beatmap;
use Storage;

class ReplayFile
{
    private $diskName;
    private $filename;
    private $score;

    public function __construct($score)
    {
        $this->filename = $score->getKey();
        $mode = $score->gameModeString();
        $this->diskName = 'replays.'.$mode.'.'.config('osu.score_replays.storage');
        $this->score = $score;
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->disk(), $method], array_merge([$this->filename], $parameters));
    }

    public function disk()
    {
        return Storage::disk($this->diskName);
    }

    /**
     * Generates the end chunk for replay files.
     *
     * @return string Binary string of the chunk.
     */
    public function endChunk()
    {
        return pack('q', $this->score->score_id);
    }

    /**
     * Generates the header chunk for replay files.
     *
     * @param string $version client version.
     * @return string Binary string of the chunk.
     */
    public function headerChunk(string $version = '20151228') : string
    {
        $score = $this->score;
        $beatmap = $score->beatmap;
        $mode = Beatmap::MODES[$score->getMode()];
        $user = $score->user;

        $md5 = md5("{$score->maxcombo}osu{$user->username}{$beatmap->checksum}{$score->score}{$score->rank}");
        $ticks = $score->date->timestamp * 10000000 + 621355968000000000; // Conversion to dotnet DateTime.Ticks.

        // easier debugging with array and implode instead of plain string concatenation.
        $components = [
            pack('c', $mode),
            pack('i', $version),
            pack_str($beatmap->checksum),
            pack_str($user->username),
            pack_str($md5),
            pack('S', $score->count300),
            pack('S', $score->count100),
            pack('S', $score->count50),
            pack('S', $score->countgeki),
            pack('S', $score->countkatu),
            pack('S', $score->countmiss),
            pack('i', $score->score),
            pack('S', $score->maxcombo),
            pack('c', $score->perfect),
            pack('i', $score->getAttributes()['enabled_mods']),
            pack_str(''), // outputs 0b00 from site, 00 if exported from game client.
            pack('q', $ticks),
        ];

        return implode('', $components);
    }
}
