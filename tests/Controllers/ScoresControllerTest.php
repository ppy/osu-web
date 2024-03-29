<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\Score\Best\Osu;
use App\Models\Solo\Score as SoloScore;
use App\Models\User;
use App\Models\UserCountryHistory;
use App\Models\UserStatistics;
use Carbon\CarbonImmutable;
use Illuminate\Filesystem\Filesystem;
use Storage;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    private Osu $score;
    private User $user;
    private User $otherUser;

    public function testDownloadSameUser()
    {
        $this->expectCountChange(fn () => $this->score->user->statistics($this->score->getMode())->replay_popularity, 0);

        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->json(
                'GET',
                route('scores.download-legacy', $this->params())
            )
            ->assertSuccessful();

        $month = CarbonImmutable::now();
        $currentMonth = UserCountryHistory::formatDate($month);
        $this->assertNull($this->score->user->replaysWatchedCounts()->where('year_month', $currentMonth)->first());

        $this->assertNull($this->score->replayViewCount()->first());
    }

    public function testDownloadSoloScoreSameUser()
    {
        $soloScore = SoloScore::factory()
            ->create([
                'legacy_score_id' => $this->score->getKey(),
                'ruleset_id' => Beatmap::MODES[$this->score->getMode()],
                'user_id' => $this->score->user_id,
                'has_replay' => true,
            ]);

        $this->expectCountChange(fn () => $this->score->user->statistics($this->score->getMode())->replay_popularity, 0);

        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->json(
                'GET',
                route('scores.download', $soloScore)
            )
            ->assertSuccessful();

        $month = CarbonImmutable::now();
        $currentMonth = UserCountryHistory::formatDate($month);
        $this->assertNull($this->score->user->replaysWatchedCounts()->where('year_month', $currentMonth)->first());
    }

    public function testDownload()
    {
        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->json(
                'GET',
                route('scores.download-legacy', $this->params())
            )
            ->assertSuccessful();

        $this->assertEquals($this->score->user->statistics($this->score->getMode())->replay_popularity, 1);

        $month = CarbonImmutable::now();
        $currentMonth = UserCountryHistory::formatDate($month);
        $this->assertEquals($this->score->user->replaysWatchedCounts()->where('year_month', $currentMonth)->first()->count, 1);

        $this->assertEquals($this->score->replayViewCount()->first()->play_count, 1);
    }

    public function testDownloadSoloScore()
    {
        $soloScore = SoloScore::factory()
            ->create([
                'legacy_score_id' => $this->score->getKey(),
                'ruleset_id' => Beatmap::MODES[$this->score->getMode()],
                'user_id' => $this->score->user_id,
                'has_replay' => true,
            ]);

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->json(
                'GET',
                route('scores.download', $soloScore)
            )
            ->assertSuccessful();

        $this->assertEquals($soloScore->user->statistics($soloScore->getMode())->replay_popularity, 1);

        $month = CarbonImmutable::now();
        $currentMonth = UserCountryHistory::formatDate($month);
        $this->assertEquals($soloScore->user->replaysWatchedCounts()->where('year_month', $currentMonth)->first()->count, 1);
    }

    public function testDownloadDeletedBeatmap()
    {
        $this->score->beatmap->delete();

        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', $this->params()))
            ->assertSuccessful();
    }

    public function testDownloadMissingBeatmap()
    {
        $this->score->beatmap->forceDelete();

        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', $this->params()))
            ->assertStatus(422);
    }

    public function testDownloadMissingUser()
    {
        $this->score->user->delete();

        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', $this->params()))
            ->assertStatus(422);
    }

    public function testDownloadInvalidReferer()
    {
        $this
            ->actingAs($this->user)
            ->json(
                'GET',
                route('scores.download-legacy', $this->params())
            )
            ->assertRedirect(route('scores.show', $this->params()));

        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => rtrim($GLOBALS['cfg']['app']['url'], '/').'.example.com'])
            ->json(
                'GET',
                route('scores.download-legacy', $this->params())
            )
            ->assertRedirect(route('scores.show', $this->params()));
    }

    public function testDownloadInvalidMode()
    {
        $this
            ->actingAs($this->user)
            ->json(
                'GET',
                route('scores.download-legacy', ['rulesetOrScore' => 'nope', 'score' => $this->score->getKey()])
            )
            ->assertStatus(302);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // fake all the replay disks
        $disks = [];
        foreach (array_keys($GLOBALS['cfg']['filesystems']['disks']['replays']) as $key) {
            foreach (array_keys($GLOBALS['cfg']['filesystems']['disks']['replays'][$key]) as $type) {
                $disk = "replays.{$key}.{$type}";
                $disks[] = $disk;
                Storage::fake($disk);
            }
        }

        // Laravel doesn't remove the directory created for fakes and
        // Storage::fake() removes the files in the directory when called but leaves the directory there.
        $this->beforeApplicationDestroyed(function () use ($disks) {
            foreach ($disks as $disk) {
                $path = storage_path('framework/testing/disks/'.$disk);
                (new Filesystem())->deleteDirectory($path);
            }
        });

        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();

        UserStatistics\Osu::factory()->create(['user_id' => $this->user->user_id]);
        $this->score = Osu::factory()->withReplay()->create(['user_id' => $this->user->user_id]);
    }

    private function params()
    {
        return [
            'rulesetOrScore' => $this->score->getMode(),
            'score' => $this->score->getKey(),
        ];
    }
}
