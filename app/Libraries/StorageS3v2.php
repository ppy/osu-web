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
 */

namespace App\Libraries;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v2\AwsS3Adapter;
use League\Flysystem\Filesystem;

class StorageS3v2
{
    public $filesystem;

    public function __construct()
    {
        $client = S3Client::factory([
            'key' => env('S3_KEY'),
            'secret' => env('S3_SECRET'),
            'region' => env('S3_REGION'),
        ]);

        $adapter = new AwsS3Adapter($client, env('S3_BUCKET'));

        $this->filesystem = new Filesystem($adapter);
    }

    public function put($path, $content)
    {
        return $this->filesystem->put($path, $content);
    }

    public function deleteDirectory($path)
    {
        return $this->filesystem->deleteDir($path);
    }

    public function url($path)
    {
        return config('osu.urls.assets').$path;
    }
}
