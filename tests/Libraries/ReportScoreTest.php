<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Exceptions\ValidationException;
use App\Models\Score\Best;
use App\Models\User;
use App\Models\UserReport;
use Tests\TestCase;

class ReportScoreTest extends TestCase
{
    private $reporter;

    public function testCannotReportOwnScore()
    {
        $score = Best\Osu::create(['user_id' => $this->reporter->getKey()]);

        $this->expectException(ValidationException::class);
        $score->reportBy($this->reporter);
    }

    public function testReasonIsIgnored()
    {
        $score = Best\Osu::create(['user_id' => User::factory()->create()->getKey()]);

        $this->expectException(ValidationException::class);

        $score->reportBy($this->reporter, [
            'reason' => 'NotAValidReason',
        ]);
    }

    public function testReportableInstance()
    {
        $score = Best\Mania::create(['user_id' => User::factory()->create()->getKey()]);

        $query = UserReport::where('reportable_type', 'score_best_mania')->where('reportable_id', $score->getKey());
        $reportedCount = $query->count();
        $reportsCount = $this->reporter->reportsMade()->count();

        $report = $score->reportBy($this->reporter);
        $this->assertSame($reportedCount + 1, $query->count());
        $this->assertSame($reportsCount + 1, $this->reporter->reportsMade()->count());
        $this->assertSame($score->getKey(), $report->score_id);
        $this->assertSame($score->user_id, $report->user_id);
        $this->assertTrue($report->reportable->is($score));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->reporter = User::factory()->create();
    }
}
