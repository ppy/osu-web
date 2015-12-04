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
namespace App\Traits;

use App\Libraries\ImageProcessor;
use App\Libraries\StorageAuto;

trait Imageable
{
    public $_storage = null;

    // public $maxDimensions = [1000, 1000];
    // public $maxFileSize = 1000000;
    // public $fileRoot = 'imageable';

    public function storage()
    {
        if ($this->_storage === null) {
            $this->_storage = StorageAuto::get();
        }

        return $this->_storage;
    }

    public function fileDir()
    {
        return "{$this->fileRoot}/{$this->id}";
    }

    public function fileName()
    {
        return "{$this->hash}.{$this->ext}";
    }

    public function filePath()
    {
        return $this->fileDir().'/'.$this->fileName();
    }

    public function fileUrl()
    {
        return $this->storage()->url($this->filePath());
    }

    public function deleteWithFile()
    {
        $this->deleteFile();

        return $this->delete();
    }

    public function deleteFile()
    {
        if (presence($this->hash) === null) {
            return;
        }

        return $this->storage()->deleteDirectory($this->fileDir());
    }

    public function storeFile($filePath)
    {
        $image = new ImageProcessor($filePath, $this->maxDimensions, $this->maxFileSize);
        $image->process();

        $this->deleteFile();
        $this->hash = hash_file('sha256', $image->inputPath);
        $this->ext = $image->ext();

        $this->storage()->put($this->filePath(), file_get_contents($image->inputPath));
    }
}
