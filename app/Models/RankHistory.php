<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property mixed $data
 * @property int $mode
 * @property int $r0
 * @property int $r1
 * @property int $r10
 * @property int $r11
 * @property int $r12
 * @property int $r13
 * @property int $r14
 * @property int $r15
 * @property int $r16
 * @property int $r17
 * @property int $r18
 * @property int $r19
 * @property int $r2
 * @property int $r20
 * @property int $r21
 * @property int $r22
 * @property int $r23
 * @property int $r24
 * @property int $r25
 * @property int $r26
 * @property int $r27
 * @property int $r28
 * @property int $r29
 * @property int $r3
 * @property int $r30
 * @property int $r31
 * @property int $r32
 * @property int $r33
 * @property int $r34
 * @property int $r35
 * @property int $r36
 * @property int $r37
 * @property int $r38
 * @property int $r39
 * @property int $r4
 * @property int $r40
 * @property int $r41
 * @property int $r42
 * @property int $r43
 * @property int $r44
 * @property int $r45
 * @property int $r46
 * @property int $r47
 * @property int $r48
 * @property int $r49
 * @property int $r5
 * @property int $r50
 * @property int $r51
 * @property int $r52
 * @property int $r53
 * @property int $r54
 * @property int $r55
 * @property int $r56
 * @property int $r57
 * @property int $r58
 * @property int $r59
 * @property int $r6
 * @property int $r60
 * @property int $r61
 * @property int $r62
 * @property int $r63
 * @property int $r64
 * @property int $r65
 * @property int $r66
 * @property int $r67
 * @property int $r68
 * @property int $r69
 * @property int $r7
 * @property int $r70
 * @property int $r71
 * @property int $r72
 * @property int $r73
 * @property int $r74
 * @property int $r75
 * @property int $r76
 * @property int $r77
 * @property int $r78
 * @property int $r79
 * @property int $r8
 * @property int $r80
 * @property int $r81
 * @property int $r82
 * @property int $r83
 * @property int $r84
 * @property int $r85
 * @property int $r86
 * @property int $r87
 * @property int $r88
 * @property int $r89
 * @property int $r9
 * @property User $user
 * @property int $user_id
 */
class RankHistory extends Model
{
    protected $table = 'osu_user_performance_rank';

    public $timestamps = false;

    public function getDataAttribute()
    {
        $data = [];

        $startOffset = Count::currentRankStart($this->mode);
        $end = $startOffset + 90;

        for ($i = $startOffset; $i < $end; $i++) {
            $column = 'r'.strval($i % 90);

            $data[] = intval($this->$column);
        }

        $diffHead = $data[0] - $data[1];
        $diffTail = $data[0] - array_last($data);

        $shiftData = abs($diffTail) < abs($diffHead);

        if (!$shiftData) {
            $userStatistics = $this->user->statistics($this->mode);

            if ($userStatistics !== null) {
                $currentRank = $userStatistics->globalRank();
                $shiftData = $currentRank === $data[0];
            }
        }

        if ($shiftData) {
            $lastRank = array_shift($data);
            $data[] = $lastRank;
        }

        return $data;
    }

    public function getModeAttribute($value)
    {
        return Beatmap::modeStr($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
