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
namespace App\Libraries;

use App\Models\BeatmapSet;
use App\Exceptions\BeatmapProcessorException;

class ImageProcessorService
{
    public function __construct($workingFolder = null, $endpoint = null)
    {
        $this->workingFolder = $workingFolder ?? sys_get_temp_dir();
        $this->endpoint = $endpoint ?? config('osu.beatmap_processor.thumbnailer');
    }

    private static function isValidFormat($size)
    {
        return in_array($size, BeatmapSet::coverSizes(), true);
    }

    public function optimize($src)
    {
        return $this->process('optim', $src);
    }

    public function resize($src, $format)
    {
        if (!self::isValidFormat($format)) {
            throw new BeatmapProcessorException('Invalid format requested.');
        }

        return $this->process("thumb/$format", $src);
    }

    public function process($method, $src)
    {
        $src = preg_replace("/https?:\/\//", '', $src);
        $tmpFile = tempnam($this->workingFolder, 'ips').'.jpg';
        $ok = copy($this->endpoint."/{$method}/{$src}", $tmpFile);
        if (!$ok || filesize($tmpFile) < 100) {
            throw new BeatmapProcessorException("Error retrieving processed image: $method");
        }

        return $tmpFile;
    }
}
