<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Beatmap $beatmap
 * @property int $beatmap_id
 * @property mixed $data
 * @property int $p1
 * @property int $p10
 * @property int $p100
 * @property int $p11
 * @property int $p12
 * @property int $p13
 * @property int $p14
 * @property int $p15
 * @property int $p16
 * @property int $p17
 * @property int $p18
 * @property int $p19
 * @property int $p2
 * @property int $p20
 * @property int $p21
 * @property int $p22
 * @property int $p23
 * @property int $p24
 * @property int $p25
 * @property int $p26
 * @property int $p27
 * @property int $p28
 * @property int $p29
 * @property int $p3
 * @property int $p30
 * @property int $p31
 * @property int $p32
 * @property int $p33
 * @property int $p34
 * @property int $p35
 * @property int $p36
 * @property int $p37
 * @property int $p38
 * @property int $p39
 * @property int $p4
 * @property int $p40
 * @property int $p41
 * @property int $p42
 * @property int $p43
 * @property int $p44
 * @property int $p45
 * @property int $p46
 * @property int $p47
 * @property int $p48
 * @property int $p49
 * @property int $p5
 * @property int $p50
 * @property int $p51
 * @property int $p52
 * @property int $p53
 * @property int $p54
 * @property int $p55
 * @property int $p56
 * @property int $p57
 * @property int $p58
 * @property int $p59
 * @property int $p6
 * @property int $p60
 * @property int $p61
 * @property int $p62
 * @property int $p63
 * @property int $p64
 * @property int $p65
 * @property int $p66
 * @property int $p67
 * @property int $p68
 * @property int $p69
 * @property int $p7
 * @property int $p70
 * @property int $p71
 * @property int $p72
 * @property int $p73
 * @property int $p74
 * @property int $p75
 * @property int $p76
 * @property int $p77
 * @property int $p78
 * @property int $p79
 * @property int $p8
 * @property int $p80
 * @property int $p81
 * @property int $p82
 * @property int $p83
 * @property int $p84
 * @property int $p85
 * @property int $p86
 * @property int $p87
 * @property int $p88
 * @property int $p89
 * @property int $p9
 * @property int $p90
 * @property int $p91
 * @property int $p92
 * @property int $p93
 * @property int $p94
 * @property int $p95
 * @property int $p96
 * @property int $p97
 * @property int $p98
 * @property int $p99
 * @property mixed $type
 */
class BeatmapFailtimes extends Model
{
    protected $table = 'osu_beatmap_failtimes';

    public $timestamps = false;

    public function getDataAttribute()
    {
        $data = [];

        for ($i = 1; $i <= 100; $i++) {
            $column = 'p'.strval($i);

            $data[] = intval($this->$column);
        }

        return $data;
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function delete()
    {
        // only because laravel can't seem to support composite primary keys
        static::where('beatmap_id', $this->beatmap_id)
            ->where('type', $this->type)
            ->delete();
    }

    public static function find($beatmap_id, $type)
    {
        return static::where('beatmap_id', '=', $beatmap_id)
            ->where('type', '=', $type)
            ->first();
    }
}
