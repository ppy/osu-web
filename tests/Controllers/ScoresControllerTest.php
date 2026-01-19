<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\OAuth\Client;
use App\Models\ScoreReplayStats;
use App\Models\Solo\Score;
use App\Models\User;
use App\Models\UserStatistics;
use Illuminate\Filesystem\Filesystem;
use Storage;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    private Score $score;
    private User $user;
    private User $otherUser;

    public function testDownloadApiSameUser(): void
    {
        $this->expectCountChange(fn () => $this->getScoreReplayViewCount(), 0);
        $this->expectCountChange(fn () => $this->getUserReplayPopularity(), 0);
        $this->expectCountChange(fn () => $this->getUserReplaysWatchedCount(), 0);

        $this
            ->actAsPasswordClientUser($this->user)
            ->get(route('api.scores.download', $this->score))
            ->assertSuccessful();
    }

    public function testDownload(): void
    {
        $this->expectCountChange(fn () => $this->getScoreReplayViewCount(), 0);
        $this->expectCountChange(fn () => $this->getUserReplayPopularity(), 0);
        $this->expectCountChange(fn () => $this->getUserReplaysWatchedCount(), 0);

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download', $this->score))
            ->assertSuccessful();
    }

    public function testDownloadApi(): void
    {
        $this->expectCountChange(fn () => $this->getScoreReplayViewCount(), 1);
        $this->expectCountChange(fn () => $this->getUserReplayPopularity(), 1);
        $this->expectCountChange(fn () => $this->getUserReplaysWatchedCount(), 1);

        $this
            ->actAsPasswordClientUser($this->otherUser)
            ->get(route('api.scores.download', $this->score))
            ->assertSuccessful();
    }

    public function testDownloadApiTwiceNoCountChange(): void
    {
        $this
            ->actAsPasswordClientUser($this->otherUser)
            ->get(route('api.scores.download', $this->score))
            ->assertSuccessful();

        $this->expectCountChange(fn () => $this->getScoreReplayViewCount(), 0);
        $this->expectCountChange(fn () => $this->getUserReplayPopularity(), 0);
        $this->expectCountChange(fn () => $this->getUserReplaysWatchedCount(), 0);

        $this
            ->actAsPasswordClientUser($this->otherUser)
            ->get(route('api.scores.download', $this->score))
            ->assertSuccessful();
    }

    public function testDownloadDeletedBeatmap(): void
    {
        $this->score->beatmap->delete();

        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download', $this->score))
            ->assertSuccessful();
    }

    public function testDownloadInvalidReferer(): void
    {
        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => rtrim($GLOBALS['cfg']['app']['url'], '/').'.example.com'])
            ->get(route('scores.download', $this->score))
            ->assertRedirect(route('scores.show', $this->score));
    }

    public function testDownloadLegacy(): void
    {
        $this->createLegacyScore();

        $this->expectCountChange(fn () => $this->getLegacyScoreReplayViewCount(), 0);
        $this->expectCountChange(fn () => $this->getScoreReplayViewCount(), 0);
        $this->expectCountChange(fn () => $this->getUserReplayPopularity(), 0);
        $this->expectCountChange(fn () => $this->getUserReplaysWatchedCount(), 0);

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', $this->legacyParams()))
            ->assertSuccessful();
    }

    public function testDownloadLegacyApi(): void
    {
        $this->createLegacyScore();

        $this->expectCountChange(fn () => $this->getLegacyScoreReplayViewCount(), 1);
        $this->expectCountChange(fn () => $this->getScoreReplayViewCount(), 1);
        $this->expectCountChange(fn () => $this->getUserReplayPopularity(), 1);
        $this->expectCountChange(fn () => $this->getUserReplaysWatchedCount(), 1);

        $this
            ->actAsPasswordClientUser($this->otherUser)
            ->get(route('api.scores.download-legacy', $this->legacyParams()))
            ->assertSuccessful();
    }

    public function testDownloadLegacyInvalidRuleset(): void
    {
        $this->createLegacyScore();

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', [...$this->legacyParams(), 'ruleset' => 'nope']))
            ->assertStatus(404);
    }

    public function testDownloadLegacyMissingBeatmap(): void
    {
        $this->createLegacyScore();
        $this->score->beatmap->forceDelete();

        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', $this->legacyParams()))
            ->assertStatus(422);
    }

    public function testDownloadLegacyMissingUser(): void
    {
        $this->createLegacyScore();
        $this->score->user->delete();

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', $this->legacyParams()))
            ->assertStatus(422);
    }

    public function testDownloadNoReferer(): void
    {
        $this
            ->actingAs($this->user)
            ->get(route('scores.download', $this->score))
            ->assertRedirect(route('scores.show', $this->score));
    }

    protected function setUp(): void
    {
        parent::setUp();

        // fake all the replay disks
        $type = $GLOBALS['cfg']['filesystems']['default'];
        $disks = [
            "{$type}-solo-replay",
            ...prefix_strings("{$type}-legacy-replay-", array_keys(Beatmap::MODES)),
        ];
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

        $this->score = Score::factory()->withReplay()->create();

        $this->user = $this->score->user;
        UserStatistics\Model::getClass($this->score->getMode())::factory()->create(['user_id' => $this->user->getKey()]);

        $this->otherUser = User::factory()->create();
    }

    private function actAsPasswordClientUser(User $user): static
    {
        $this->actAsScopedUser($user, ['*'], Client::factory()->create(['password_client' => true]));

        return $this;
    }

    private function createLegacyScore(): void
    {
        $this->score->update(['legacy_score_id' => time()]);
        $this->score->replayFile()->put('dummy replay file');
    }

    private function getLegacyScoreReplayViewCount(): int
    {
        return $this->score->legacyReplayViewCount()->first()?->play_count ?? 0;
    }

    private function getScoreReplayViewCount(): int
    {
        return ScoreReplayStats::find($this->score->getKey())?->watch_count ?? 0;
    }

    private function getUserReplaysWatchedCount(): int
    {
        $month = format_month_column(new \DateTime());

        return $this->score->user->replaysWatchedCounts()->firstWhere('year_month', $month)?->count ?? 0;
    }

    private function getUserReplayPopularity(): int
    {
        return $this->score->user->statistics($this->score->getMode(), true)->first()?->replay_popularity ?? 0;
    }

    private function legacyParams(): array
    {
        return [
            'ruleset' => $this->score->getMode(),
            'score' => $this->score->legacy_best_id,
        ];
    }
}
