<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Exceptions\InvariantException;
use App\Exceptions\ValidationException;
use App\Libraries\MorphMap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Forum;
use App\Models\Team;
use App\Models\Traits\ReportableInterface;
use App\Models\User;
use App\Models\UserReport;
use Carbon\Carbon;
use Exception;
use Tests\TestCase;

class UserReportTest extends TestCase
{
    public static function reportableClasses(): array
    {
        $reportables = [];

        foreach (MorphMap::MAP as $class => $_name) {
            if (isset(class_implements($class)[ReportableInterface::class])) {
                $reportables[] = [$class];
            }
        }

        // Sanity check to make sure there are models to test.
        if (count($reportables) === 0) {
            throw new Exception('No reportables found');
        }

        return $reportables;
    }

    private static function getReportableUser(ReportableInterface $reportable)
    {
        return match ($reportable::class) {
            Message::class => $reportable->sender,
            Team::class => $reportable->leader,
            User::class => $reportable,
            default => $reportable->user,
        };
    }

    private static function makeReportable(string $class): ReportableInterface
    {
        $modelFactory = $class::factory();
        $userColumn = 'user_id';

        switch ($class) {
            case Beatmapset::class:
                $modelFactory = $modelFactory->pending();
                break;

            case BeatmapDiscussionPost::class:
                $modelFactory = $modelFactory->state([
                    'beatmap_discussion_id' => BeatmapDiscussion::factory()->general()->state([
                        'beatmapset_id' => Beatmapset::factory(),
                    ]),
                ]);
                break;

            case Forum\Post::class:
                $userColumn = 'poster_id';
                break;

            case Message::class:
                $modelFactory = $modelFactory->state([
                    'channel_id' => Channel::factory()->type('public'),
                ]);
                break;

            case Team::class:
                $userColumn = 'leader_id';
                break;
        }

        return $class === User::class
            ? $modelFactory->create()
            : $modelFactory->create([$userColumn => User::factory()]);
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
        $reportable->reportBy(static::getReportableUser($reportable), static::reportParams());
    }

    public function testCannotReportScoreableBeatmapset()
    {
        $beatmapset = Beatmapset::factory()->qualified()->create();
        $reporter = User::factory()->create();

        $this->expectException(ValidationException::class);
        $beatmapset->reportBy($reporter, static::reportParams());
    }

    public function testCannotReportIfNotInChannel()
    {
        $channel = Channel::factory()->type('pm')->create();
        $message = Message::factory()->create(['channel_id' => $channel, 'user_id' => $channel->users()->first()]);
        $reporter = User::factory()->create();

        $this->expectException(ValidationException::class);
        $message->reportBy($reporter, static::reportParams());
    }

    public function testCannotReportIfInTeam(): void
    {
        $team = Team::factory()->create();
        $reporter = User::factory()->create();
        $team->addMember($team->applications()->create(['user_id' => $reporter->getKey()]));

        $this->expectException(ValidationException::class);
        $team->reportBy($reporter, static::reportParams());
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
    public function testNoComments(string $class): void
    {
        $reportable = static::makeReportable($class);
        $reporter = User::factory()->create();

        if ($class === Message::class) {
            $this->expectCountChange(fn () => UserReport::count(), 1);
        } else {
            $this->expectException(ValidationException::class);
        }
        $reportable->reportBy($reporter, static::reportParams([
            'comments' => null,
        ]));
    }

    /**
     * @dataProvider reportableClasses
     */
    public function testNoCommentsReasonOther(string $class): void
    {
        $reportable = static::makeReportable($class);
        $reporter = User::factory()->create();

        $this->expectException(ValidationException::class);
        $reportable->reportBy($reporter, static::reportParams([
            'comments' => null,
            'reason' => 'Other',
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
        $reportableUserId = match ($reportable::class) {
            Forum\Post::class => $reportable->poster_id,
            Team::class => $reportable->leader_id,
            default => $reportable->user_id
        };
        $this->assertSame($reportableUserId, $report->user_id);
        $this->assertTrue($report->reportable->is($reportable));
    }

    /**
     * @dataProvider reportableClasses
     */
    public function testReportableNotificationEndpoint(string $class): void
    {
        $reportable = static::makeReportable($class);
        $reporter = User::factory()->create();

        $report = $reportable->reportBy($reporter, static::reportParams());

        $report->routeNotificationForSlack(null);

        $this->assertTrue(true, 'should not fail getting notification routing url');
    }

    public function testReportingAgainAfterAWhile(): void
    {
        $reportable = static::makeReportable(User::class);
        $reporter = User::factory()->create();

        $oldReport = $reportable->reportBy($reporter, static::reportParams([
            'comments' => 'test',
        ]));
        $oldReport->update(['timestamp' => Carbon::now()->subYears(1)]);

        $this->expectCountChange(fn () => $reportable->fresh()->reportedIn()->count(), 1);

        $reportable->reportBy($reporter, static::reportParams([
            'comments' => 'test',
        ]));
    }

    public function testReportingAgainImmediate(): void
    {
        $reportable = static::makeReportable(User::class);
        $reporter = User::factory()->create();

        $oldReport = $reportable->reportBy($reporter, static::reportParams([
            'comments' => 'test',
        ]));
        $oldReport->update(['timestamp' => Carbon::now()->subMinute(1)]);

        $this->expectCountChange(fn () => $reportable->fresh()->reportedIn()->count(), 0);

        $this->expectExceptionCallable(function () use ($reportable, $reporter) {
            $reportable->reportBy($reporter, static::reportParams([
                'comments' => 'test',
            ]));
        }, InvariantException::class, osu_trans('errors.user_report.recently_reported'));
    }
}
