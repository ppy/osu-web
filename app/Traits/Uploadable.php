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

use App\Libraries\StorageWithUrl;

trait Uploadable
{
    protected $_storage = null;

    /**
     * Returns maximum size of the file in bytes. Defaults to 1 MB.
     */
    public function getMaxFileSize()
    {
        return 1000000;
    }

    /**
     * Returns root path of where the files are to be stored.
     */
    abstract public function getFileRoot();

    public function getFileId()
    {
        return $this->id;
    }

    /**
     * Returns a hash with contents of at least 'hash' and 'ext' if there's
     * image or otherwise null.
     *
     * Assumes attributes 'hash' and 'ext' of the object by default.
     */
    public function getFileProperties()
    {
        if (!present($this->hash) || !present($this->ext)) {
            return;
        }

        return [
            'hash' => $this->hash,
            'ext' => $this->ext,
        ];
    }

    /**
     * Sets file properties. Either a hash of 'hash' and 'ext' or null.
     *
     * Assumes attributes 'hash' and 'ext' of the object by default.
     */
    public function setFileProperties($props)
    {
        $this->hash = $props['hash'] ?? null;
        $this->ext = $props['ext'] ?? null;
    }

    public function storage()
    {
        if ($this->_storage === null) {
            $this->_storage = new StorageWithUrl();
        }

        return $this->_storage;
    }

    public function fileDir()
    {
        return $this->getFileRoot().'/'.$this->getFileId();
    }

    public function fileName()
    {
        return $this->getFileProperties()['hash'].'.'.$this->getFileProperties()['ext'];
    }

    public function filePath()
    {
        return $this->fileDir().'/'.$this->fileName();
    }

    public function fileUrl()
    {
        if ($this->getFileProperties() === null) {
            return;
        }

        return $this->storage()->url($this->filePath());
    }

    public function deleteWithFile()
    {
        $this->deleteFile();

        return $this->delete();
    }

    public function deleteFile()
    {
        if ($this->getFileProperties() === null) {
            return;
        }

        $this->setFileProperties(null);

        return $this->storage()->deleteDirectory($this->fileDir());
    }

    public function storeFile($filePath, $fileExtension = '')
    {
        $this->deleteFile();
        $this->setFileProperties([
            'hash' => hash_file('sha256', $filePath),
            'ext' => $fileExtension,
        ]);

        $this->storage()->put($this->filePath(), file_get_contents($filePath));
    }
}
