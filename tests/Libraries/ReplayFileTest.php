<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace Tests;

use App\Libraries\ReplayFile;
use App\Models\Beatmap;
use App\Models\Score\Best;
use App\Models\User;
use TestCase;

class ReplayFileTest extends TestCase
{
    public function testEndChunk()
    {
        // known good end chunk.
        $known = 'd75c989400000000';

        $replayFile = new ReplayFile($this->knownScore());

        $this->assertSame($known, bin2hex($replayFile->endChunk()));
    }

    public function testHeaderChunk()
    {
        // known good header.
        $known = '0056ef33010b2039323536623735613064663334356262623237396533353438303732396631340b08492e522e5265616c0b2033393336326435393239313738633162626265373465323130646639316232399e000600000016000500000059911f00460101784200000b008014b73dec8dd508';

        $replayFile = new ReplayFile($this->knownScore());

        $this->assertSame($known, bin2hex($replayFile->headerChunk('20180822')));
    }

    private function knownScore()
    {
        return Best\Osu::make([
            'score_id' => 2493013207,
            'beatmap_id' => 1103293,
            'user_id' => 6258604,
            'score' => 2068825,
            'maxcombo' => 326,
            'rank' => 'SH',
            'count50' => 0,
            'count100' => 6,
            'count300' => 158,
            'countmiss' => 0,
            'countgeki' => 22,
            'countkatu' => 5,
            'perfect' => true,
            'enabled_mods' => 17016, // [HD, HR, NC, PF]  + implied mods
            'date' => '2018-03-19 22:53:33',
            'pp' => 68.41,
            'replay' => true,
            'hidden' => 0,
            'country_acronym' => 'DE',
            'user' => User::make([
                'user_id' => 6258604,
                'username' => 'I.R.Real',
            ]),
            'beatmap' => Beatmap::make([
                'beatmap_id' => 1103293,
                'checksum' => '9256b75a0df345bbb279e35480729f14',
            ]),
        ]);
    }
}
