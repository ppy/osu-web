<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Score;

use App\Libraries\Score\LegacyReplayFile;
use App\Models\Beatmap;
use App\Models\Solo\Score;
use App\Models\User;
use Tests\TestCase;

class LegacyReplayFileTest extends TestCase
{
    public function testEndChunk()
    {
        // known good end chunk.
        $known = 'd75c989400000000';

        $replayFile = new LegacyReplayFile($this->knownScore());

        $this->assertSame($known, bin2hex($replayFile->endChunk()));
    }

    public function testHeaderChunk()
    {
        // known good header.
        $known = '0056ef33010b2039323536623735613064663334356262623237396533353438303732396631340b08492e522e5265616c0b2033393336326435393239313738633162626265373465323130646639316232399e000600000000000000000059911f00460101784200000b008014b73dec8dd508';

        $replayFile = new LegacyReplayFile($this->knownScore());

        $this->assertSame($known, bin2hex($replayFile->headerChunk()));
    }

    public function testHeaderChunkDefaultVersion()
    {
        $known = '00bc7b33010b2039323536623735613064663334356262623237396533353438303732396631340b08492e522e5265616c0b2033393336326435393239313738633162626265373465323130646639316232399e000600000000000000000059911f00460101784200000b008014b73dec8dd508';

        $replayFile = new LegacyReplayFile($this->knownScore(true, null));

        $this->assertSame($known, bin2hex($replayFile->headerChunk()));
    }

    public function testHeaderChunkMissingReplayRecord()
    {
        $known = '00bc7b33010b2039323536623735613064663334356262623237396533353438303732396631340b08492e522e5265616c0b2033393336326435393239313738633162626265373465323130646639316232399e000600000000000000000059911f00460101784200000b008014b73dec8dd508';

        $replayFile = new LegacyReplayFile($this->knownScore(false));

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

        $legacyScoreId = 2493013207;

        $score = Score::make([
            'ruleset_id' => 0,
            'legacy_score_id' => $legacyScoreId,
            'beatmap_id' => $beatmapId,
            'user_id' => $userId,
            'legacy_total_score' => 2068825,
            'max_combo' => 326,
            'rank' => 'SH',
            'passed' => true,
            'data' => [
                'mods' => [
                    ['acronym' => 'HD'],
                    ['acronym' => 'HR'],
                    ['acronym' => 'NC'],
                    ['acronym' => 'PF'],
                ],
                'statistics' => [
                    'meh' => 0,
                    'ok' => 6,
                    'great' => 158,
                    'miss' => 0,
                ],
                'maximum_statistics' => [
                    'legacy_combo_increase' => 326 - 158 - 6,
                    'great' => 158 + 6,
                ],
            ],
            'perfect' => true,
            'ended_at' => '2018-03-19 22:53:33',
            'pp' => 68.41,
            'has_replay' => true,
            'country_acronym' => 'DE',
        ]);

        if ($hasReplayRecord) {
            $score->legacyReplayViewCount()->create([
                'score_id' => $legacyScoreId,
                'play_count' => 1,
                'version' => $version,
            ]);
        }

        return $score;
    }
}
