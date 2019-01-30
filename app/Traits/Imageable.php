<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
