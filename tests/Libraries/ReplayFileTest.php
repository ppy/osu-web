<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Libraries\ReplayFile;
use App\Models\Beatmap;
use App\Models\ReplayViewCount;
use App\Models\Score\Best;
use App\Models\User;
use Tests\TestCase;

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

        $this->assertSame($known, bin2hex($replayFile->headerChunk()));
    }

    public function testHeaderChunkDefaultVersion()
    {
        $known = '00bc7b33010b2039323536623735613064663334356262623237396533353438303732396631340b08492e522e5265616c0b2033393336326435393239313738633162626265373465323130646639316232399e000600000016000500000059911f00460101784200000b008014b73dec8dd508';

        $replayFile = new ReplayFile($this->knownScore(true, null));

        $this->assertSame($known, bin2hex($replayFile->headerChunk()));
    }

    public function testHeaderChunkMissingReplayRecord()
    {
        $known = '00bc7b33010b2039323536623735613064663334356262623237396533353438303732396631340b08492e522e5265616c0b2033393336326435393239313738633162626265373465323130646639316232399e000600000016000500000059911f00460101784200000b008014b73dec8dd508';

        $replayFile = new ReplayFile($this->knownScore(false));

        $this->assertSame($known, bin2hex($replayFile->headerChunk()));
    }

    private function knownScore($hasReplayRecord = true, ?int $version = 20180822)
    {
        $beatmapId = 1103293;
        $beatmap = Beatmap::find($beatmapId) ?? Beatmap::factory()->create(['beatmap_id' => $beatmapId]);
        $beatmap->fill(['checksum' => '9256b75a0df345bbb279e35480729f14'])->saveOrExplode();

        $userId = 6258604;
        $user = User::find($userId) ?? User::factory()->create(['user_id' => $userId]);
        $user->fill(['username' => 'I.R.Real'])->saveOrExplode(['skipValidations' => true]);

        $score = Best\Osu::make([
            'score_id' => 2493013207,
            'beatmap_id' => $beatmapId,
            'user_id' => $userId,
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
        ]);

        if ($hasReplayRecord) {
            $score->fill([
                'replayViewCount' => ReplayViewCount\Osu::make([
                    'score_id' => 2493013207,
                    'play_count' => 1,
                    'version' => $version,
                ]),
            ]);
        }

        return $score;
    }
}
