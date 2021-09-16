<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\ImageProcessorException;

class ImageProcessor
{
    public $errors = [];

    public $hardMaxDim = [5000, 5000];
    public $hardMaxFileSize = 10000000;
    public $allowedTypes = [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG];

    public $inputDim = null;
    public $inputFileSize = null;
    public $inputPath = null;
    public $targetDim = null;
    public $targetFileSize = null;

    public function __construct($inputPath, $targetDim, $targetFileSize)
    {
        $this->inputPath = $inputPath;
        $this->targetDim = $targetDim;
        $this->targetFileSize = $targetFileSize;

        $this->parseInput();
    }

    public function basicCheck()
    {
        if ($this->inputFileSize > $this->hardMaxFileSize) {
            throw new ImageProcessorException(osu_trans('users.show.edit.cover.upload.too_large'));
        }

        if ($this->inputDim === null || !in_array($this->inputDim[2], $this->allowedTypes, true)) {
            throw new ImageProcessorException(osu_trans('users.show.edit.cover.upload.unsupported_format'));
        }

        if ($this->inputDim[0] > $this->hardMaxDim[0] || $this->inputDim[1] > $this->hardMaxDim[1]) {
            throw new ImageProcessorException(osu_trans('users.show.edit.cover.upload.too_large'));
        }
    }

    public function ext()
    {
        return image_type_to_extension($this->inputDim[2], false);
    }

    public function parseInput()
    {
        $this->inputDim = read_image_properties($this->inputPath);
        $this->inputFileSize = filesize($this->inputPath);
    }

    public function purgeExif()
    {
        if ($this->inputDim[2] !== IMAGETYPE_JPEG) {
            return;
        }

        exec('jhead -autorot -purejpg -q '.escapeshellarg($this->inputPath));
        $this->parseInput();
    }

    public function process()
    {
        $this->basicCheck();

        $this->purgeExif();

        $inputImage = open_image($this->inputPath, $this->inputDim);

        if ($inputImage === null) {
            throw new ImageProcessorException(osu_trans('users.show.edit.cover.upload.broken_file'));
        }

        if (
            $this->inputDim[0] <= $this->targetDim[0] &&
            $this->inputDim[1] <= $this->targetDim[1]
        ) {
            if ($this->inputFileSize < $this->targetFileSize) {
                return;
            }

            $image = $inputImage;
        } else {
            $start = [0, 0];
            $inDim = [$this->inputDim[0], $this->inputDim[1]];
            $outDim = [$this->targetDim[0], $this->targetDim[1]];

            // figure out how to crop.
            if ($this->inputDim[0] / $this->inputDim[1] >= $this->targetDim[0] / $this->targetDim[1]) {
                $inDim[0] = $this->targetDim[0] / $this->targetDim[1] * $this->inputDim[1];
                $start[0] = ($this->inputDim[0] - $inDim[0]) / 2;
            } else {
                $inDim[1] = $this->targetDim[1] / $this->targetDim[0] * $this->inputDim[0];
                $start[1] = ($this->inputDim[1] - $inDim[1]) / 2;
            }

            // don't scale if input image is smaller.
            if ($inDim[0] < $outDim[0] || $inDim[1] < $outDim[1]) {
                $outDim = $inDim;
            }

            $image = imagecreatetruecolor($outDim[0], $outDim[1]);
            imagesavealpha($image, true);
            imagefill($image, 0, 0, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagecopyresampled($image, $inputImage, 0, 0, $start[0], $start[1], $outDim[0], $outDim[1], $inDim[0], $inDim[1]);
        }

        $toJpeg = true;

        if ($this->inputDim[2] === IMAGETYPE_PNG || $this->inputDim[2] === IMAGETYPE_GIF) {
            imagepng($image, $this->inputPath);

            $this->parseInput();
            $toJpeg = $this->inputFileSize > $this->targetFileSize;
        }

        if ($toJpeg) {
            imagejpeg($image, $this->inputPath, 90);
        }

        $this->parseInput();
    }
}
