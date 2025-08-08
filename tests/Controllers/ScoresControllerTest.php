<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\OAuth\Client;
use App\Models\Score\Best\Osu;
use App\Models\ScoreReplayStats;
use App\Models\Solo\Score as SoloScore;
use App\Models\User;
use App\Models\UserStatistics;
use Illuminate\Filesystem\Filesystem;
use Storage;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    private Osu $score;
    private SoloScore $soloScore;
    private User $user;
    private User $otherUser;

    private static function getLegacyScoreReplayViewCount(Osu $score): int
    {
        return $score->replayViewCount()->first()?->play_count ?? 0;
    }

    private static function getScoreReplayViewCount(SoloScore $score): int
    {
        return ScoreReplayStats::find($score->getKey())?->watch_count ?? 0;
    }

    private static function getUserReplaysWatchedCount(Osu|SoloScore $score): int
    {
        $month = format_month_column(new \DateTime());

        return $score->user->replaysWatchedCounts()->firstWhere('year_month', $month)?->count ?? 0;
    }

    private static function getUserReplayPopularity(Osu|SoloScore $score): int
    {
        return $score->user->statistics($score->getMode(), true)->first()?->replay_popularity ?? 0;
    }

    public function testDownloadApiSameUser()
    {
        $this->expectCountChange(fn () => static::getLegacyScoreReplayViewCount($this->score), 0);
        $this->expectCountChange(fn () => static::getScoreReplayViewCount($this->soloScore), 0);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($this->score), 0);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($this->score), 0);

        $this
            ->actAsPasswordClientUser($this->user)
            ->json(
                'GET',
                route('api.scores.download-legacy', $this->params())
            )
            ->assertSuccessful();
    }

    public function testDownloadApiSoloScoreSameUser()
    {
        $soloScore = SoloScore::factory()
            ->withReplay()
            ->create(['user_id' => $this->user->getKey()]);

        $this->expectCountChange(fn () => static::getUserReplayPopularity($soloScore), 0);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($soloScore), 0);

        $this
            ->actAsPasswordClientUser($this->user)
            ->json(
                'GET',
                route('api.scores.download', $soloScore)
            )
            ->assertSuccessful();
    }

    public function testDownload()
    {
        $this->expectCountChange(fn () => static::getLegacyScoreReplayViewCount($this->score), 0);
        $this->expectCountChange(fn () => static::getScoreReplayViewCount($this->soloScore), 0);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($this->score), 0);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($this->score), 0);

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->json(
                'GET',
                route('scores.download-legacy', $this->params())
            )
            ->assertSuccessful();
    }

    public function testDownloadApi(): void
    {
        $this->expectCountChange(fn () => static::getLegacyScoreReplayViewCount($this->score), 1);
        $this->expectCountChange(fn () => static::getScoreReplayViewCount($this->soloScore), 1);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($this->score), 1);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($this->score), 1);

        $this
            ->actAsPasswordClientUser($this->otherUser)
            ->json(
                'GET',
                route('api.scores.download-legacy', $this->params())
            )
            ->assertSuccessful();
    }

    public function testDownloadApiTwiceNoCountChange(): void
    {
        $this
            ->actAsPasswordClientUser($this->otherUser)
            ->json(
                'GET',
                route('api.scores.download-legacy', $this->params())
            )
            ->assertSuccessful();

        $this->expectCountChange(fn () => static::getLegacyScoreReplayViewCount($this->score), 0);
        $this->expectCountChange(fn () => static::getScoreReplayViewCount($this->soloScore), 0);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($this->score), 0);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($this->score), 0);

        $this
            ->actAsPasswordClientUser($this->otherUser)
            ->json(
                'GET',
                route('api.scores.download-legacy', $this->params())
            )
            ->assertSuccessful();
    }

    public function testDownloadSoloScore()
    {
        $soloScore = SoloScore::factory()
            ->withReplay()
            ->create(['user_id' => $this->user->getKey()]);

        $this->expectCountChange(fn () => static::getUserReplayPopularity($soloScore), 0);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($soloScore), 0);

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->json(
                'GET',
                route('scores.download', $soloScore)
            )
            ->assertSuccessful();
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
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', $this->params()))
            ->assertStatus(422);
    }

    public function testDownloadInvalidReferer()
    {
        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => rtrim($GLOBALS['cfg']['app']['url'], '/').'.example.com'])
            ->json(
                'GET',
                route('scores.download-legacy', $this->params())
            )
            ->assertRedirect(route('scores.show', $this->params()));
    }

    public function testDownloadLegacyInvalidRuleset()
    {
        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->json(
                'GET',
                route('scores.download-legacy', [...$this->params(), 'rulesetOrScore' => 'nope'])
            )
            ->assertStatus(404);
    }

    public function testDownloadNoReferer()
    {
        $this
            ->actingAs($this->user)
            ->json(
                'GET',
                route('scores.download-legacy', $this->params())
            )
            ->assertRedirect(route('scores.show', $this->params()));
    }

    protected function setUp(): void
    {
        parent::setUp();

        // fake all the replay disks
        $disks = [SoloScore::replayFileDiskName()];
        foreach (['local', 's3'] as $type) {
            foreach (Beatmap::MODES as $ruleset => $_rulesetId) {
                $disks[] = "{$type}-legacy-replay-{$ruleset}";
            }
        }
        foreach ($disks as $disk) {
            Storage::fake($disk);
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
        $this->soloScore = SoloScore::factory()->create([
            'beatmap_id' => $this->score->beatmap_id,
            'has_replay' => true,
            'legacy_score_id' => $this->score->getKey(),
            'user_id' => $this->score->user_id,
        ]);
    }

    private function actAsPasswordClientUser(User $user): static
    {
        $this->actAsScopedUser($user, ['*'], Client::factory()->create(['password_client' => true]));

        return $this;
    }

    private function params()
    {
        return [
            'rulesetOrScore' => $this->score->getMode(),
            'score' => $this->score->getKey(),
        ];
    }
}
