<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Exceptions\ValidationException;
use App\Libraries\MorphMap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Forum;
use App\Models\Traits\ReportableInterface;
use App\Models\User;
use App\Models\UserReport;
use Tests\TestCase;

class UserReportTest extends TestCase
{
    private static function makeReportable(string $class): ReportableInterface
    {
        $user = User::factory()->create();

        switch ($class) {
            case Forum\Post::class:
                $modelFactory = factory(Forum\Post::class);
                $userColumn = 'poster_id';
                break;
            default:
                $modelFactory = $class::factory();
                $userColumn = 'user_id';
                break;
        }

        if ($class === Beatmapset::class) {
            $modelFactory = $modelFactory->pending();
        }

        if ($class === BeatmapDiscussionPost::class) {
            $modelFactory = $modelFactory->state([
                'beatmap_discussion_id' => BeatmapDiscussion::factory()->general()->state([
                    'beatmapset_id' => Beatmapset::factory(),
                ]),
            ]);
        }

        return $modelFactory->create([$userColumn => $user->getKey()]);
    }

    private static function reportParams(array $additionalParams = []): array
    {
        return array_merge([
            'comments' => 'some comment',
        ], $additionalParams);
    }

    private User $reporter;

    /**
     * @dataProvider reportableClasses
     */
    public function testCannotReportOwnThing(string $class)
    {
        $reportable = static::makeReportable($class);

        $this->expectException(ValidationException::class);
        $reportable->reportBy($reportable->user, static::reportParams());
    }

    public function testCannotReportScoreableBeatmapset()
    {
        $beatmapset = Beatmapset::factory()->qualified()->create();
        $reporter = User::factory()->create();

        $this->expectException(ValidationException::class);
        $beatmapset->reportBy($reporter, static::reportParams());
    }

    /**
     * @dataProvider reportableClasses
     */
    public function testInvalidReason(string $class)
    {
        $reportable = static::makeReportable($class);
        $reporter = User::factory()->create();

        $this->expectException(ValidationException::class);

        $reportable->reportBy($reporter, static::reportParams([
            'reason' => 'NotAValidReason',
        ]));
    }

    /**
     * @dataProvider reportableClasses
     */
    public function testNoComments(string $class)
    {
        $reportable = static::makeReportable($class);
        $reporter = User::factory()->create();

        $this->expectException(ValidationException::class);
        $reportable->reportBy($reporter, static::reportParams([
            'comments' => null,
        ]));
    }

    /**
     * @dataProvider reportableClasses
     */
    public function testReportableInstance(string $class)
    {
        $reportable = static::makeReportable($class);
        $reporter = User::factory()->create();

        $query = UserReport::whereMorphedTo('reportable', $reportable);
        $this->expectCountChange(fn () => $query->count(), 1, 'reportable query');
        $this->expectCountChange(fn () => $reporter->fresh()->reportsMade->count(), 1, 'reportsMade accessor');
        $this->expectCountChange(fn () => $reporter->reportsMade()->count(), 1, 'reportsMade query');
        $this->expectCountChange(fn () => $reportable->fresh()->reportedIn->count(), 1, 'reportedIn accessor');
        $this->expectCountChange(fn () => $reportable->reportedIn()->count(), 1, 'reportedIn query');

        $report = $reportable->reportBy($reporter, static::reportParams());
        if ($reportable instanceof BestModel) {
            $this->assertSame($reportable->getKey(), $report->score_id);
        }
        $reportableUserId = $reportable instanceof Forum\Post
            ? $reportable->poster_id
            : $reportable->user_id;
        $this->assertSame($reportableUserId, $report->user_id);
        $this->assertTrue($report->reportable->is($reportable));
    }

    public function reportableClasses(): array
    {
        return array_map(
            fn (string $morphName): array => [MorphMap::getClass($morphName)],
            array_keys(UserReport::ALLOWED_REASONS),
        );
    }
}
