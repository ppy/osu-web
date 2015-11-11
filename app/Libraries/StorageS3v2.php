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

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v2\AwsS3Adapter;
use League\Flysystem\Filesystem;

class StorageS3v2
{
    public $filesystem;

    public function __construct($driver = null)
    {
        if ($driver === null) {
            $driver = config('filesystems.default');
        }

        $config = config("filesystems.disks.{$driver}");

        $client = S3Client::factory([
            'key' => $config['key'],
            'secret' => $config['secret'],
            'region' => $config['region'],
        ]);

        $adapter = new AwsS3Adapter($client, $config['bucket']);

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
