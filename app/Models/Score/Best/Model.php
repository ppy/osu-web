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
namespace App\Models\Score\Best;

use App\Models\Beatmap;
use App\Models\Score\Model as BaseModel;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v2\AwsS3Adapter;
use League\Flysystem\Filesystem;

abstract class Model extends BaseModel
{
    abstract public function gameModeString();

    public static function getClass($game_mode)
    {
        switch ($game_mode) {
            case Beatmap::OSU:
                $instance = new Osu;
                break;

            case Beatmap::TAIKO:
                $instance = new Taiko;
                break;

            case Beatmap::CTB:
                $instance = new Fruit;
                break;

            case Beatmap::MANIA:
                $instance = new Mania;
                break;
        }

        return $instance;
    }

    public function getReplay()
    {
        // this s3 retrieval should probably be moved out of the model going forward
        if (!$this->replay) {
            return;
        }
        $config = config('filesystems.disks.s3');
        $client = S3Client::factory([
            'key' => $config['key'],
            'secret' => $config['secret'],
            'region' => $config['region'],
        ]);
        $adapter = new AwsS3Adapter($client, "replay-{$this->gameModeString()}");
        $s3 = new Filesystem($adapter);

        try {
            $replay = $s3->read($this->score_id);
        } catch (Exception $e) {
            $replay = null;
        }

        return $replay;
    }
}
