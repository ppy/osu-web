<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Traits;

use App\Libraries\ImageProcessor;

trait Imageable
{
    use Uploadable {
        storeFile as _storeFile; // rename storeFile in the Uploadable trait so we can override it
    }

    /**
     * Returns maximum dimensions of the image as an array of [width, height].
     */
    abstract public function getMaxDimensions();

    public function storeFile($filePath)
    {
        $image = new ImageProcessor($filePath, $this->getMaxDimensions(), $this->getMaxFileSize());
        $image->process();

        $this->_storeFile($image->inputPath, $image->ext());
    }
}
