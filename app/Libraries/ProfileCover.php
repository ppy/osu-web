<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        return !isset($this->data['id']) && isset($this->data['file']);
    }

    public function id()
    {
        if ($this->hasCustomCover()) {
            return;
        }

        if ($this->userId === null || $this->userId < 1) {
            return;
        }

        if (!in_array($this->data['id'] ?? null, $this->availableIds, true)) {
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

        $id = $this->id();

        if ($id !== null) {
            return config('app.url').'/images/headers/profile-covers/c'.$id.'.jpg';
        }
    }
}
