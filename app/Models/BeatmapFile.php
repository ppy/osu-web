<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

class BeatmapFile
{
    private $parsed = false;
    private $backgroundImage;

    public static function parse(string $content)
    {
        // strip utf8 bom
        $content = strip_utf8_bom($content);

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

        $file = new static();
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
