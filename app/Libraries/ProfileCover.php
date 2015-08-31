<?php

/**
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
*/

namespace App\Libraries;

use League\Flysystem\FileNotFoundException;

class ProfileCover
{
	public $data;
	public $userId;
	public $errors = [];

	public $hardMaxDim = [5000, 5000];
	public $hardMaxFileSize = 10000000;

	public $storage;

	private $availableIds = ['1', '2', '3', '4', '5', '6', '7', '8'];

	public function __construct($userId, $data)
	{
		$this->data = $data;
		$this->userId = $userId;

		switch (config('filesystems.default')) {
			case 'local':
				$this->storage = new StorageLocal;
				break;
			case 's3':
				$this->storage = new StorageS3v2;
				break;
		}
	}

	public function hasCustomCover()
	{
		return $this->data['file'] !== null;
	}

	public function delete()
	{
		if (!$this->hasCustomCover()) { return; }

		return $this->storage->deleteDirectory($this->dirPath());
	}

	public function id()
	{
		if ($this->hasCustomCover()) { return; }

		if (!in_array($this->data['id'], $this->availableIds, true)) {
			return $this->availableIds[$this->userId % count($this->availableIds)];
		}

		return $this->data['id'];
	}

	public function set($id, $file)
	{
		if ($file !== null) {
			$id = null;
			$this->store($file->getRealPath());
		} else {
			$this->data['file'] = null;
			$this->delete();
		}

		if ($id !== null && !in_array($id, $this->availableIds, true)) {
			$id = null;
		}

		$this->data['id'] = $id;

		return $this->data;
	}

	public function url()
	{
		if ($this->hasCustomCover()) {
			return $this->storage->url($this->filePath());
		}

		return '/images/headers/profile-covers/c' . $this->id() . '.jpg';
	}

	public function dirPath()
	{
		return "user-profile-covers/{$this->userId}";
	}

	public function filePath()
	{
		if (!$this->hasCustomCover()) { return; }

		return $this->dirPath() . "/{$this->data['file']['hash']}.{$this->data['file']['ext']}";
	}

	public function store($inputFilePath)
	{
		if ($this->fix($inputFilePath) === false) { return false; };

		$this->delete();

		$this->data['file'] = [
			'hash' => hash_file('sha256', $inputFilePath),
			'ext' => image_type_to_extension(getimagesize($inputFilePath)[2], false),
		];

		$this->storage->put($this->filePath(), file_get_contents($inputFilePath));
	}

	public function fix($path)
	{
		$dim = getimagesize($path);
		$fileSize = filesize($path);

		if ($fileSize > $this->hardMaxFileSize) {
			$this->errors = [trans('users.show.edit.cover.upload.too_large')];
			return false;
		} elseif ($dim === false || !in_array($dim[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
			$this->errors = [trans('users.show.edit.cover.upload.unsupported_format')];
			return false;
		} elseif ($dim[0] > $this->hardMaxDim[0] || $dim[1] > $this->hardMaxDim[1]) {
			$this->errors = [trans('users.show.edit.cover.upload.too_large')];
			return false;
		}

		if ($dim[2] === IMAGETYPE_JPEG) {
			exec("jhead -autorot -purejpg -q ".escapeshellarg($path));
			$dim = getimagesize($path);
		}

		$maxDim = [1800, 500];
		$maxFileSize = 1000000;

		if ($dim[0] === $maxDim[0] && $dim[1] === $maxDim[1]) {
			if (filesize($path) < $maxFileSize) { return; }

			$image = open_image($path, $dim);
		} else {
			$inputImage = open_image($path, $dim);

			$start = [0, 0];
			$inDim = [$dim[0], $dim[1]];
			$outDim = [$maxDim[0], $maxDim[1]];

			// figure out how to crop.
			if ($dim[0]/$dim[1] >= $maxDim[0]/$maxDim[1]) {
				$inDim[0] = $maxDim[0]/$maxDim[1] * $dim[1];
				$start[0] = ($dim[0] - $inDim[0]) / 2;
			} else {
				$inDim[1] = $maxDim[1]/$maxDim[0] * $dim[0];
				$start[1] = ($dim[1] - $inDim[1]) / 2;
			}

			// don't scale if input image is smaller.
			if ($inDim[0] < $outDim[0] || $inDim[1] < $outDim[1]) {
				$outDim = $inDim;
			}

			$image = imagecreatetruecolor($outDim[0], $outDim[1]);
			imagecopyresampled($image, $inputImage, 0, 0, $start[0], $start[1], $outDim[0], $outDim[1], $inDim[0], $inDim[1]);
		}

		imagejpeg($image, $path);
	}
}
