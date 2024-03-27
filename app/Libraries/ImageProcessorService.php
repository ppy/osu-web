<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\ImageProcessorServiceException;
use App\Models\Beatmapset;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ImageProcessorService
{
    private string $endpoint;

    public function __construct(?string $endpoint = null)
    {
        $this->endpoint = $endpoint ?? $GLOBALS['cfg']['osu']['beatmap_processor']['thumbnailer'];
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
        $src = preg_replace('/https?:\/\//', '', $src);
        try {
            $tmpFile = tmpfile();
            $bytesWritten = fwrite(
                $tmpFile,
                (new Client())->request('GET', "{$this->endpoint}/{$method}/{$src}")->getBody()->getContents(),
            );
        } catch (GuzzleException $e) {
            if (str_contains($e->getMessage(), 'VipsJpeg: Premature end of input file')) {
                throw new ImageProcessorServiceException(
                    'Invalid image file',
                    ImageProcessorServiceException::INVALID_IMAGE,
                    $e,
                );
            }
            throw new ImageProcessorServiceException('HTTP request failed!', 0, $e);
        }

        if ($bytesWritten === false || $bytesWritten < 100) {
            throw new ImageProcessorServiceException("Error retrieving processed image: $method.");
        }

        return $tmpFile;
    }
}
