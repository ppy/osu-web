<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\OAuth\Client;
use App\Models\Score\Best as ScoreBest;
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

    private static function getLegacyScoreReplayViewCount(ScoreBest\Model $legacyScore): int
    {
        return $legacyScore->replayViewCount()->first()?->play_count ?? 0;
    }

    private static function getScoreReplayViewCount(Score $score): int
    {
        return ScoreReplayStats::find($score->getKey())?->watch_count ?? 0;
    }

    private static function getUserReplaysWatchedCount(Score $score): int
    {
        $month = format_month_column(new \DateTime());

        return $score->user->replaysWatchedCounts()->firstWhere('year_month', $month)?->count ?? 0;
    }

    private static function getUserReplayPopularity(Score $score): int
    {
        return $score->user->statistics($score->getMode(), true)->first()?->replay_popularity ?? 0;
    }

    public function testDownloadApiSameUser(): void
    {
        $this->expectCountChange(fn () => static::getScoreReplayViewCount($this->score), 0);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($this->score), 0);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($this->score), 0);

        $this
            ->actAsPasswordClientUser($this->user)
            ->get(route('api.scores.download', $this->score))
            ->assertSuccessful();
    }

    public function testDownload(): void
    {
        $this->expectCountChange(fn () => static::getScoreReplayViewCount($this->score), 0);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($this->score), 0);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($this->score), 0);

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download', $this->score))
            ->assertSuccessful();
    }

    public function testDownloadApi(): void
    {
        $this->expectCountChange(fn () => static::getScoreReplayViewCount($this->score), 1);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($this->score), 1);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($this->score), 1);

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

        $this->expectCountChange(fn () => static::getScoreReplayViewCount($this->score), 0);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($this->score), 0);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($this->score), 0);

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
        [$legacyScore, $score] = $this->createLegacyScore();

        $this->expectCountChange(fn () => static::getLegacyScoreReplayViewCount($legacyScore), 0);
        $this->expectCountChange(fn () => static::getScoreReplayViewCount($score), 0);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($score), 0);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($score), 0);

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', static::legacyParams($legacyScore)))
            ->assertSuccessful();
    }

    public function testDownloadLegacyApi(): void
    {
        [$legacyScore, $score] = $this->createLegacyScore();

        $this->expectCountChange(fn () => static::getLegacyScoreReplayViewCount($legacyScore), 1);
        $this->expectCountChange(fn () => static::getScoreReplayViewCount($score), 1);
        $this->expectCountChange(fn () => static::getUserReplayPopularity($score), 1);
        $this->expectCountChange(fn () => static::getUserReplaysWatchedCount($score), 1);

        $this
            ->actAsPasswordClientUser($this->otherUser)
            ->get(route('api.scores.download-legacy', static::legacyParams($legacyScore)))
            ->assertSuccessful();
    }

    public function testDownloadLegacyInvalidRuleset(): void
    {
        [$legacyScore] = $this->createLegacyScore();

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', [...static::legacyParams($legacyScore), 'ruleset' => 'nope']))
            ->assertStatus(404);
    }

    public function testDownloadLegacyMissingBeatmap(): void
    {
        [$legacyScore] = $this->createLegacyScore();
        $legacyScore->beatmap->forceDelete();

        $this
            ->actingAs($this->user)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', static::legacyParams($legacyScore)))
            ->assertStatus(422);
    }

    public function testDownloadLegacyMissingUser(): void
    {
        [$legacyScore] = $this->createLegacyScore();
        $legacyScore->user->delete();

        $this
            ->actingAs($this->otherUser)
            ->withHeaders(['HTTP_REFERER' => $GLOBALS['cfg']['app']['url'].'/'])
            ->get(route('scores.download-legacy', static::legacyParams($legacyScore)))
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

    private function createLegacyScore(): array
    {
        $legacyScore = ScoreBest\Model::getClass($this->score->getMode())::factory()->withReplay()->create([
            'beatmap_id' => $this->score->beatmap_id,
            'user_id' => $this->score->user_id,
        ]);
        $score = Score::factory()->create([
            'beatmap_id' => $legacyScore->beatmap_id,
            'has_replay' => true,
            'legacy_score_id' => $legacyScore->getKey(),
            'user_id' => $legacyScore->user_id,
        ]);

        return [$legacyScore, $score];
    }

    private function legacyParams(ScoreBest\Model $legacyScore): array
    {
        return [
            'ruleset' => $legacyScore->getMode(),
            'score' => $legacyScore->getKey(),
        ];
    }
}
