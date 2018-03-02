<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Exceptions\ImageProcessorServiceException;
use App\Models\Beatmapset;

class ImageProcessorService
{
    public function __construct($endpoint = null)
    {
        $this->endpoint = $endpoint ?? config('osu.beatmap_processor.thumbnailer');
    }

    private static function isValidFormat($size)
    {
        return in_array($size, Beatmapset::coverSizes(), true);
    }

    public function optimize($src)
    {
        return $this->process('optim', $src);
    }

    public function resize($src, $format)
    {
        if (!self::isValidFormat($format)) {
            throw new ImageProcessorServiceException('Invalid format requested.');
        }

        return $this->process("thumb/$format", $src);
    }

    // returns a handle instead of a filename to keep tmpfile alive
    public function process($method, $src)
    {
        $src = preg_replace("/https?:\/\//", '', $src);
        try {
            $tmpFile = tmpfile();
            $bytesWritten = fwrite($tmpFile, file_get_contents($this->endpoint."/{$method}/{$src}"));
        } catch (\ErrorException $e) {
            if (strpos($e->getMessage(), 'HTTP request failed!') !== false) {
                throw new ImageProcessorServiceException('HTTP request failed!');
            } elseif (strpos($e->getMessage(), 'Connection refused') !== false) {
                throw new ImageProcessorServiceException('Connection refused.');
            } else {
                throw $e;
            }
        }

        if ($bytesWritten === false || $bytesWritten < 100) {
            throw new ImageProcessorServiceException("Error retrieving processed image: $method.");
        }

        return $tmpFile;
    }
}
