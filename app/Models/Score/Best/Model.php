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

use App\Libraries\ModsHelper;
use App\Models\Score\Model as BaseModel;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v2\AwsS3Adapter;
use League\Flysystem\Filesystem;

abstract class Model extends BaseModel
{
    public $position = null;
    public $weight = null;

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

    public function position()
    {
        if ($this->position === null) {
            /*
             * pp is float and comparing floats is inaccurate thanks to
             * all the castings involved and thus it's better to obtain the
             * number directly from database. The result is this fancy query.
             */
            $this->position = static::where('user_id', $this->user_id)
                ->where('pp', '>', function ($q) {
                    $q->from($this->table)->where('score_id', $this->score_id)->select('pp');
                })
                ->orderBy('pp', 'desc')
                ->count();
        }

        return $this->position;
    }

    public function weight()
    {
        if ($this->weight === null) {
            $this->weight = pow(0.95, $this->position());
        }

        return $this->weight;
    }

    public function weightedPp()
    {
        return $this->weight() * $this->pp;
    }

    /**
     * $scores shall be pre-sorted by pp (or whatever default scoring order).
     */
    public static function fillInPosition($scores)
    {
        if ($scores->first() === null) {
            return;
        }

        $position = $scores->first()->position();

        foreach ($scores as $score) {
            $score->position = $position;
            $position++;
        }
    }

    public function scopeDefault($query)
    {
        return $query
            ->whereHas('user', function ($userQuery) {
                $userQuery->default();
            });
    }

    public function scopeDefaultListing($query)
    {
        return $query
            ->default()
            ->orderBy('score', 'DESC')
            ->orderBy('date', 'ASC')
            ->limit(config('osu.beatmaps.max-scores'));
    }

    public function scopeWithMods($query, $modsArray)
    {
        return $query->where(function ($q) use ($modsArray) {
            if (in_array('NM', $modsArray, true)) {
                $q->orWhere('enabled_mods', 0);
            }

            $bitset = ModsHelper::toBitset($modsArray);
            if ($bitset > 0) {
                $q->orWhereRaw('enabled_mods & ? != 0', [$bitset]);
            }
        });
    }

    public function scopeFromCountry($query, $countryAcronym)
    {
        return $query->whereHas('user', function ($q) use ($countryAcronym) {
            $q->where('country_acronym', $countryAcronym);
        });
    }

    public function scopeFriendsOf($query, $user)
    {
        $userIds = model_pluck($user->friends(), 'zebra_id');
        $userIds[] = $user->user_id;

        return $query->whereIn('user_id', $userIds);
    }
}
