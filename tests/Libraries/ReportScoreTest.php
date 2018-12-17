<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
use App\Exceptions\ValidationException;
use App\Libraries\ReportScore;
use App\Models\User;
use App\Models\Score\Best;
use App\Models\UserReport;
use Illuminate\Auth\AuthenticationException;

class ReportScoreTest extends TestCase
{
    private $reporter;

    public function setUp()
    {
        parent::setUp();
        $this->reporter = factory(User::class)->create();
    }

    public function testReporterIsNotLoggedIn()
    {
        $score = Best\Osu::create(['user_id' => factory(User::class)->create()->getKey()]);

        $this->expectException(AuthenticationException::class);
        (new ReportScore($this->reporter, $score, []))->report();
    }

    public function testCannotReportOwnScore()
    {
        $score = Best\Osu::create(['user_id' => $this->reporter->getKey()]);
        auth()->login($this->reporter);

        $this->expectException(ValidationException::class);
        (new ReportScore($this->reporter, $score, []))->report();
    }

    public function testReasonIsIgnored()
    {
        $score = Best\Osu::create(['user_id' => factory(User::class)->create()->getKey()]);
        auth()->login($this->reporter);

        $report = (new ReportScore($this->reporter, $score, [
            'reason' => 'NotAValidReason',
        ]))->report();

        $this->assertSame('Cheating', $report->reason);
    }

    public function testReportIsLoggedIn()
    {
        $score = Best\Osu::create(['user_id' => factory(User::class)->create()->getKey()]);
        auth()->login($this->reporter);

        $query = UserReport::where('reportable_type', 'score')->where('reportable_id', $score->getKey());
        $reportedCount = $query->count();
        $reportsCount = $this->reporter->reportsMade()->count();

        (new ReportScore($this->reporter, $score, []))->report();
        $this->assertSame($reportedCount + 1, $query->count());
        $this->assertSame($reportsCount + 1, $this->reporter->reportsMade()->count());
    }
}
