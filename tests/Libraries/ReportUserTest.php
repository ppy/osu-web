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
use App\Libraries\ReportUser;
use App\Models\User;
use App\Models\UserReport;
use Illuminate\Auth\AuthenticationException;

class ReportUserTest extends TestCase
{
    private $reporter;

    public function setUp()
    {
        parent::setUp();
        $this->reporter = factory(User::class)->create();
    }

    public function testReporterIsNotLoggedIn()
    {
        $user = factory(User::class)->create();

        $this->expectException(AuthenticationException::class);
        (new ReportUser($this->reporter, $user, []))->report();
    }

    public function testCannotReportSelf()
    {
        auth()->login($this->reporter);

        $this->expectException(ValidationException::class);
        (new ReportUser($this->reporter, $this->reporter, [
            'reason' => 'Cheating',
        ]))->report();
    }

    public function testReasonIsNotValid()
    {
        $user = factory(User::class)->create();
        auth()->login($this->reporter);

        $this->expectException(Illuminate\Database\QueryException::class);
        (new ReportUser($this->reporter, $user, [
            'reason' => 'NotAValidReason',
        ]))->report();
    }

    public function testReportIsLoggedIn()
    {
        $user = factory(User::class)->create();
        auth()->login($this->reporter);
        $reportedCount = $user->reportedIn()->count();
        $reportsCount = $this->reporter->reportsMade()->count();

        (new ReportUser($this->reporter, $user, [
            'reason' => 'Cheating',
        ]))->report();
        $this->assertSame($reportedCount + 1, $user->reportedIn()->count());
        $this->assertSame($reportsCount + 1, $this->reporter->reportsMade()->count());
    }
}
