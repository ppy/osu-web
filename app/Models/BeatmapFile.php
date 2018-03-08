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

namespace App\Models;

class BeatmapFile
{
    private $parsed = false;
    private $backgroundImage;

    public static function parse(string $content)
    {
        // check file 'header'
        if (!starts_with($content, 'osu file format v')) {
            return false;
        }

        // TODO: parse more stuff? ^_^b
        $matching = false;
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            $line = trim($line);

            if ($matching) {
                $parts = explode(',', $line);
                // Background Image, e.g.:
                // 0,0,"bg.jpg",0,0
                if (count($parts) > 2 && $parts[0] === '0') {
                    $imageFilename = str_replace('"', '', $parts[2]);
                    break;
                }
                // Storyboard Layer (for when BG isn't defined, e.g. old beatmap)
                // This *should* appear after the above BG in a valid .osu file, e.g.:
                // 4,0,0,"evangelion_20_640.jpg",0,0
                if (count($parts) > 2 && ($parts[0] === '4' || $parts[0] === 'Sprite')) {
                    $imageFilename = str_replace('"', '', $parts[3]);
                    break;
                }
            }

            if ($line === '[Events]') {
                $matching = true;
            }

            if ($line === '[HitObjects]') {
                // Too far, give up
                break;
            }
        }

        $file = new static;
        $file->parsed = true;

        if (isset($imageFilename)) {
            // older beatmaps may not have sanitized paths
            $file->backgroundImage = str_replace('\\', '/', $imageFilename);
        } else {
            $file->backgroundImage = false;
        }

        return $file;
    }

    public function backgroundImage()
    {
        if (!$this->parsed) {
            return false;
        }

        return $this->backgroundImage;
    }
}
