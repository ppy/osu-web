<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

class BeatmapFile
{
    private const SECTIONS = [
        'Events' => '[Events]',
        'General' => '[General]',
        'HitObjects' => '[HitObjects]',
    ];

    public ?string $audioFilename = null;
    public ?string $backgroundImage = null;
    public ?int $previewTime = null; // in ms

    public function __construct(string $content)
    {
        $this->parse($content);
    }

    private function parse(string $content): void
    {
        // strip utf8 bom
        $content = strip_utf8_bom($content);

        // check file 'header'
        if (!str_starts_with($content, 'osu file format v')) {
            return;
        }

        $section = '';
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            $line = trim($line);

            if ($section === static::SECTIONS['Events']) {
                if (!isset($backgroundImage)) {
                    $parts = explode(',', $line);
                    // Background Image, e.g.:
                    // 0,0,"bg.jpg",0,0
                    if (count($parts) > 2 && $parts[0] === '0') {
                        $backgroundImage = $parts[2];
                        continue;
                    }
                    if (count($parts) > 2 && ($parts[0] === '4' || $parts[0] === 'Sprite')) {
                        // Storyboard Layer (for when BG isn't defined, e.g. old beatmap)
                        // This *should* appear after the above BG in a valid .osu file, e.g.:
                        // 4,0,0,"evangelion_20_640.jpg",0,0
                        $backgroundImage = $parts[3];
                        continue;
                    }
                }
            } elseif ($section === static::SECTIONS['General']) {
                if (!isset($this->audioFilename) && str_starts_with($line, 'AudioFilename:')) {
                    static $audioFilenameKeyLength = strlen('AudioFilename:');
                    $this->audioFilename = trim(substr($line, $audioFilenameKeyLength));
                    continue;
                }
                if (!isset($this->previewTime) && str_starts_with($line, 'PreviewTime:')) {
                    static $previewTimeKeyLength = strlen('PreviewTime:');
                    $this->previewTime = intval(trim(substr($line, $previewTimeKeyLength)));
                    continue;
                }
            }

            if ($line === static::SECTIONS['General']) {
                $section = static::SECTIONS['General'];
            } elseif ($line === static::SECTIONS['Events']) {
                $section = static::SECTIONS['Events'];
            } elseif ($line === static::SECTIONS['HitObjects']) {
                // Too far, give up
                break;
            }
        }

        if (isset($backgroundImage)) {
            $this->backgroundImage = strtr($backgroundImage, [
                '"' => '',
                // older beatmaps may not have sanitized paths
                '\\' => '/',
            ]);
        }
    }
}
