<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        $score = Best\Osu::create(['user_id' => factory(User::class)->create()->getKey()]);

        $this->expectException(ValidationException::class);

        $score->reportBy($this->reporter, [
            'reason' => 'NotAValidReason',
        ]);
    }

    public function testReportableInstance()
    {
        $score = Best\Mania::create(['user_id' => factory(User::class)->create()->getKey()]);

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
        $this->reporter = factory(User::class)->create();
    }
}
