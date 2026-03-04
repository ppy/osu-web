<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\BeatmapProcessorException;
use App\Libraries\BeatmapFile;

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

    public function fetch(Beatmapset $beatmapset): ?static
    {
        $oszFile = tmpfile();
        $mirror = BeatmapMirror::getRandomFromList($GLOBALS['cfg']['osu']['beatmap_processor']['mirrors_to_use'])
            ?? throw new \Exception('no available mirror');
        $url = $mirror->generateURL($beatmapset, true);

        if ($url === false) {
            return null;
        }

        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_FILE => $oszFile,
            CURLOPT_TIMEOUT => 30,
        ]);
        curl_exec($curl);

        if (curl_errno($curl) > 0) {
            throw new BeatmapProcessorException('Failed downloading osz: '.curl_error($curl));
        }

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // archive file is gone, nothing to do for now
        if ($statusCode === 302) {
            return null;
        }
        if ($statusCode !== 200) {
            throw new BeatmapProcessorException('Failed downloading osz: HTTP Error '.$statusCode);
        }

        try {
            return new BeatmapsetArchive(get_stream_filename($oszFile));
        } catch (BeatmapProcessorException) {
            // zip file is broken, nothing to do for now
            return null;
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

            $filename = new BeatmapFile($content)->backgroundImage;
            // return if background is set in the file and present in .osz
            if ($filename !== null && $this->hasFile($filename)) {
                return $filename;
            }
        }

        return false;
    }
}
