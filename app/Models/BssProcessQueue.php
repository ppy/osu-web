<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

/**
 * @property int $queue_id
 * @property int $beatmapset_id
 * @property \Carbon\CarbonImmutable|null $start_time
 * @property int $status
 * @property \Carbon\CarbonImmutable|null $update_time
 */
class BssProcessQueue extends Model
{
    public $timestamps = false;

    protected $casts = [
        'start_time' => 'immutable_datetime',
        'update_time' => 'immutable_datetime',
    ];
    protected $primaryKey = 'queue_id';
    protected $table = 'bss_process_queue';
}
