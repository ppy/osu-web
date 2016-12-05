<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

    public function __construct($inputPath, $targetDim, $targetFileSize)
    {
        $this->inputPath = $inputPath;
        $this->targetDim = $targetDim;
        $this->targetFileSize = $targetFileSize;
    }

    public function basicCheck()
    {
        $this->parseInput();

        if ($this->inputFileSize > $this->hardMaxFileSize) {
            throw new ImageProcessorException(trans('users.show.edit.cover.upload.too_large'));
        }

        if ($this->inputDim === false || !in_array($this->inputDim[2], $this->allowedTypes, true)) {
            throw new ImageProcessorException(trans('users.show.edit.cover.upload.unsupported_format'));
        }

        if ($this->inputDim[0] > $this->hardMaxDim[0] || $this->inputDim[1] > $this->hardMaxDim[1]) {
            throw new ImageProcessorException(trans('users.show.edit.cover.upload.too_large'));
        }
    }

    public function ext()
    {
        $this->parseInput();

        return image_type_to_extension($this->inputDim[2], false);
    }

    public function parseInput($force = false)
    {
        if ($force === false && $this->inputDim !== null && $this->inputFileSize !== null) {
            return;
        }

        $this->inputDim = getimagesize($this->inputPath);
        $this->inputFileSize = filesize($this->inputPath);
    }

    public function purgeExif()
    {
        $this->parseInput();

        if ($this->inputDim[2] !== IMAGETYPE_JPEG) {
            return;
        }

        exec('jhead -autorot -purejpg -q '.escapeshellarg($this->inputPath));
        $this->parseInput(true);
    }

    public function process()
    {
        $this->parseInput();

        $this->basicCheck();

        $this->purgeExif();

        $inputImage = open_image($this->inputPath, $this->inputDim);

        if ($inputImage === null) {
            throw new ImageProcessorException(trans('users.show.edit.cover.upload.broken_file'));
        }

        if ($this->inputDim[0] === $this->targetDim[0] &&
            $this->inputDim[1] === $this->targetDim[1]) {
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
            imagecopyresampled($image, $inputImage, 0, 0, $start[0], $start[1], $outDim[0], $outDim[1], $inDim[0], $inDim[1]);
        }

        imagejpeg($image, $this->inputPath);
        $this->parseInput(true);
    }
}
