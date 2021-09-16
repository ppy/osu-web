<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\BeatmapProcessorException;

class BeatmapsetArchive
{
    private $fileList;
    private $errorCode;
    private $osz;
    private $zip;

    public function __construct(string $osz)
    {
        $this->osz = $osz;
        $this->zip = new \ZipArchive();
        $this->errorCode = $this->zip->open($this->osz);
        if ($this->errorCode !== true) {
            throw new BeatmapProcessorException('Failed to open archive', $this->errorCode);
        }
    }

    public function __destruct()
    {
        if ($this->errorCode === true) {
            $this->zip->close();
        }
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

        return $this->zip->locateName($filename, \ZipArchive::FL_NOCASE) !== false;
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
