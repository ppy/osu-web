<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use Storage;

class ReplayFile
{
    const DEFAULT_VERSION = 20151228;

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

    public function getDiskName()
    {
        return $this->diskName;
    }

    public function getVersion()
    {
        return optional($this->score->replayViewCount)->version ?? static::DEFAULT_VERSION;
    }

    /**
     * Generates the header chunk for replay files.
     *
     * @return string Binary string of the chunk.
     */
    public function headerChunk(): string
    {
        $score = $this->score;
        $beatmap = $score->beatmap()->withTrashed()->first();

        if ($beatmap === null) {
            throw new InvariantException('score is missing beatmap');
        }

        $mode = Beatmap::MODES[$score->getMode()];
        $user = $score->user;

        if ($user === null) {
            throw new InvariantException('score is missing user');
        }

        $md5 = md5("{$score->maxcombo}osu{$user->username}{$beatmap->checksum}{$score->score}{$score->rank}");
        $ticks = $score->date->timestamp * 10000000 + 621355968000000000; // Conversion to dotnet DateTime.Ticks.

        // easier debugging with array and implode instead of plain string concatenation.
        $components = [
            pack('c', $mode),
            pack('i', $this->getVersion()),
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
