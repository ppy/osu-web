<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

class BeatmapFile
{
    public static function findBackground(string $content): ?string
    {
        // strip utf8 bom
        $content = strip_utf8_bom($content);

        // check file 'header'
        if (!str_starts_with($content, 'osu file format v')) {
            return null;
        }

        $matching = false;
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            $line = trim($line);

            if ($matching) {
                $parts = explode(',', $line);
                // Background Image, e.g.:
                // 0,0,"bg.jpg",0,0
                if (count($parts) > 2 && $parts[0] === '0') {
                    $imageFilename = $parts[2];
                    break;
                }
                // Storyboard Layer (for when BG isn't defined, e.g. old beatmap)
                // This *should* appear after the above BG in a valid .osu file, e.g.:
                // 4,0,0,"evangelion_20_640.jpg",0,0
                if (count($parts) > 2 && ($parts[0] === '4' || $parts[0] === 'Sprite')) {
                    $imageFilename = $parts[3];
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

        return isset($imageFilename)
            ? strtr($imageFilename, [
                '"' => '',
                // older beatmaps may not have sanitized paths
                '\\' => '/',
            ]) : null;
    }
}
