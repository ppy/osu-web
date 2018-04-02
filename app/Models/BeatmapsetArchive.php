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

class BeatmapsetArchive
{
    public function __construct(string $osz)
    {
        $this->osz = $osz;
        $this->zip = new \ZipArchive;
        $this->zip->open($this->osz);
    }

    public function __destruct()
    {
        $this->zip->close();
    }

    public function fileList()
    {
        if (isset($this->fileList)) {
            return $this->fileList;
        }

        $this->fileList = [];
        for ($i = 0; $i < $this->zip->numFiles; $i++) {
            $this->fileList[] = $this->zip->getNameIndex($i);
        }

        return $this->fileList;
    }

    public function osuFileList()
    {
        return preg_grep('/\.osu$/i', $this->fileList());
    }

    public function readFile(?string $filename)
    {
        if (!present($filename)) {
            return false;
        }

        return $this->zip->getFromName($filename, 0, \ZipArchive::FL_NOCASE);
    }

    public function hasFile(?string $filename)
    {
        if (!present($filename)) {
            return false;
        }

        return $this->zip->locateName($filename, \ZipArchive::FL_NOCASE | \ZipArchive::FL_NODIR) !== false;
    }

    // Parses given list (of .osu files) and finds background images referenced.
    // If $performFallback is enabled, all .osu files in archive are scanned if $filelist yields no result.
    // This allows beatmap order to dictate the priority (to match existing behaviour).
    public function scanBeatmapsForBackground(array $filelist, bool $performFallback = false)
    {
        if ($performFallback) {
            $filelist = array_merge($filelist, $this->osuFileList());
        }

        if (empty($filelist)) {
            return;
        }

        foreach ($filelist as $file) {
            $content = $this->readFile($file);
            if ($content === false) {
                // missing .osu (usually due to mismatching filename from unicode stripping)
                continue;
            }

            $osu = BeatmapFile::parse($content);
            if ($osu === false) {
                // invalid .osu
                continue;
            }

            // return if background is present in .osz
            $backgroundFilename = $osu->backgroundImage();
            if ($this->hasFile($backgroundFilename)) {
                return $backgroundFilename;
            }
        }

        return false;
    }
}
