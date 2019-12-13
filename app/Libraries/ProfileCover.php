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

namespace App\Libraries;

use App\Traits\Imageable;

class ProfileCover
{
    use Imageable;

    public $data;
    public $userId;

    private $availableIds = ['1', '2', '3', '4', '5', '6', '7', '8'];

    public function __construct($userId, $data)
    {
        $this->data = $data;
        $this->userId = $userId;
    }

    public function getMaxDimensions()
    {
        return [2400, 640];
    }

    public function getFileRoot()
    {
        return 'user-profile-covers';
    }

    public function getFileId()
    {
        return $this->userId;
    }

    public function getFileProperties()
    {
        return array_get($this->data, 'file');
    }

    public function setFileProperties($props)
    {
        if ($this->data === null) {
            $this->data = [];
        }

        $this->data['file'] = $props;
    }

    public function hasCustomCover()
    {
        return array_get($this->data, 'id') === null && array_get($this->data, 'file') !== null;
    }

    public function id()
    {
        if ($this->hasCustomCover()) {
            return;
        }

        if (!in_array($this->data['id'], $this->availableIds, true)) {
            return $this->availableIds[$this->userId % count($this->availableIds)];
        }

        return $this->data['id'];
    }

    public function set($id, $file)
    {
        if ($id !== null && in_array($id, $this->availableIds, true)) {
            $this->data['id'] = $id;
        } else {
            $this->data['id'] = null;
        }

        if ($file !== null) {
            $this->storeFile($file->getRealPath());
        }

        return array_only($this->data, ['id', 'file']);
    }

    public function url()
    {
        if ($this->hasCustomCover()) {
            return $this->fileUrl();
        }

        return config('app.url').'/images/headers/profile-covers/c'.$this->id().'.jpg';
    }
}
