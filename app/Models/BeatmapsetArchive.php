<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\BeatmapProcessorException;
use App\Libraries\BeatmapFile;

class BeatmapsetArchive
{
    // unify output to 44.1kHz stereo
    private const RESAMPLE_FILTER = 'aresample=resampler=soxr:osr=44100:ochl=stereo';

    private $errorCode;
    private $fileList;
    private array $osuFileList;
    private $osz;
    private array $parsedFiles = [];
    private $zip;

    public function __construct(string $osz, private ?Beatmapset $beatmapset = null)
    {
        $this->osz = $osz;
        $this->zip = new \ZipArchive();
        $this->errorCode = $this->zip->open($this->osz);
        if ($this->errorCode !== true) {
            throw new BeatmapProcessorException('Failed to open archive', $this->errorCode);
        }
    }

    public static function fetch(Beatmapset $beatmapset): ?static
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
            return new static(get_stream_filename($oszFile), $beatmapset);
        } catch (BeatmapProcessorException) {
            // zip file is broken, nothing to do for now
            return null;
        }
    }

    private static function convertAudioForPreview(string $audioFile, ?int $previewTime): ?string
    {
        $srcFile = tmpfile();
        fwrite($srcFile, $audioFile);
        $srcFilenameEscaped = escapeshellarg(get_stream_filename($srcFile));

        $duration = 10000;
        if ($previewTime === null || $previewTime < 0) {
            $srcDuration = (float) exec(implode(' ', [
                'timeout 10s',
                'ffprobe',
                '-loglevel quiet',
                "-i {$srcFilenameEscaped}",
                '-show_entries format=duration',
                '-of csv=p=0',
            ]));
            $previewTime = 0.4 * $srcDuration * 1000;
        }

        $fadeInExtension = min($previewTime, 100);
        $fadeIn = $fadeInExtension + 100;
        $duration += $fadeInExtension;
        $previewTime -= $fadeInExtension;

        $fadeOut = $duration - 1000;

        $normOffset = 90_000;
        $loudnorm = static::getAudioLoudnormFilter(
            $srcFilenameEscaped,
            max($previewTime - $normOffset, 0),
            ($normOffset * 2) + $duration,
        );

        if ($loudnorm === null) {
            return null;
        }

        $filter = implode(',', [
            static::RESAMPLE_FILTER,
            $loudnorm,
            "afade=t=in:st=0:d={$fadeIn}ms:curve=ipar",
            "afade=t=out:st={$fadeOut}ms:d=1000ms:curve=tri",

        ]);

        $dstFile = tmpfile();
        $dstFilename = get_stream_filename($dstFile);
        exec(implode(' ', [
            'timeout 20s',
            'ffmpeg',
            '-nostdin',
            '-loglevel quiet',
            "-ss {$previewTime}ms",
            "-t {$duration}ms",
            "-i {$srcFilenameEscaped}",
            "-af {$filter}",
            '-map 0:a', // strip out non-audio streams
            '-map_metadata -1', // strip out metadata
            '-c:a libvorbis -q 1.0',
            '-f ogg',
            '-y',
            escapeshellarg($dstFilename),
        ]));

        return presence(file_get_contents($dstFilename));
    }

    private static function getAudioLoudnormFilter(string $srcEscaped, float $start, float $duration): ?string
    {
        exec(implode(' ', [
            'timeout 20s',
            'ffmpeg',
            '-hide_banner',
            '-nostdin',
            "-ss {$start}ms",
            "-t {$duration}ms",
            "-i {$srcEscaped}",
            '-af '.static::RESAMPLE_FILTER,
            '-af loudnorm=i=-14:print_format=json',
            '-f null',
            '-',
            '2>&1',
        ]), $output);

        // TODO: replace with proper json output in newer ffmpeg (8.1+)
        // Reference: https://code.ffmpeg.org/FFmpeg/FFmpeg/pulls/21766
        $json = '';
        $foundJson = false;
        foreach ($output as $line) {
            if ($foundJson) {
                $json .= $line;
                if ($line === '}') {
                    break;
                }
            } else {
                if (str_contains($line, '[Parsed_loudnorm_')) {
                    $foundJson = true;
                }
            }
        }

        $stats = json_decode($json, true);

        if ($stats === null) {
            return null;
        }

        // taken from https://slhck.info/ffmpeg-normalize/usage/presets/
        // which is basically ffmpeg defaults with i=-14.
        $i = -14;
        $lra = 7;
        $tp = -2;
        $offset = \Number::clamp((float) $stats['target_offset'], -99, 99);

        $measuredI = (float) $stats['input_i'];
        $measuredLra = (float) $stats['input_lra'];
        $measuredTp = (float) $stats['input_tp'];
        $measuredThresh = (float) $stats['input_thresh'];

        // matches the behavior of the flags
        // - auto-lower-loudness-target
        //   reference: https://github.com/slhck/ffmpeg-normalize/blob/589ed776e627bbe093cd232a14743d1905969796/src/ffmpeg_normalize/_streams.py#L545
        // - keep-lra-above-loudness-range-target
        //   reference: https://github.com/slhck/ffmpeg-normalize/blob/589ed776e627bbe093cd232a14743d1905969796/src/ffmpeg_normalize/_streams.py#L508
        $lra = max($measuredLra, $lra);
        $safeI = $measuredI - $measuredTp + $tp - 0.1;
        $i = min($safeI, $i);

        return 'loudnorm='.implode(':', [
            "i={$i}",
            "lra={$lra}",
            "tp={$tp}",

            "measured_i={$measuredI}",
            "measured_lra={$measuredLra}",
            "measured_tp={$measuredTp}",
            "measured_thresh={$measuredThresh}",

            "offset={$offset}",

            'linear=true',
        ]);
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
        return $this->osuFileList ??= array_values(array_unique([
            // use db order
            // filename column in beatmaps table is nullable
            ...array_reject_null($this->beatmapset?->beatmaps->pluck('filename') ?? []),
            ...preg_grep('/\.osu$/i', $this->fileList()),
        ]));
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

    public function generateAudioPreview(): ?string
    {
        foreach ($this->getParsedFiles() as $parsedFile) {
            $previewTime = $parsedFile->previewTime;
            $audioFilename = $parsedFile->audioFilename;

            if (isset($audioFilename)) {
                $audioFile = $this->readFile($audioFilename);

                if ($audioFile !== false) {
                    return static::convertAudioForPreview($audioFile, $previewTime);
                }
            }
        }

        return null;
    }

    public function scanBeatmapsForBackground(): ?string
    {
        foreach ($this->getParsedFiles() as $parsedFile) {
            $filename = $parsedFile->backgroundImage;

            // return if background is set in the file and present in .osz
            if ($filename !== null && $this->hasFile($filename)) {
                return $filename;
            }
        }

        return null;
    }

    private function getParsedFile(string $file): ?BeatmapFile
    {
        if (!array_key_exists($file, $this->parsedFiles)) {
            $content = $this->readFile($file);

            $this->parsedFiles[$file] = $content === false
                ? null
                : new BeatmapFile($content);
        }

        return $this->parsedFiles[$file];
    }

    private function getParsedFiles(): iterable
    {
        foreach ($this->osuFileList() as $file) {
            $parsedFile = $this->getParsedFile($file);

            if ($parsedFile !== null) {
                yield $parsedFile;
            }
        }
    }
}
