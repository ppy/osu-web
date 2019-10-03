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
use App\Models\User;
use Illuminate\Database\QueryException;
use Tests\TestCase;

class ReportUserTest extends TestCase
{
    private $reporter;

    public function testCannotReportSelf()
    {
        $this->expectException(ValidationException::class);
        $this->reporter->reportBy($this->reporter);
    }

    public function testReasonIsNotValid()
    {
        $user = factory(User::class)->create();

        $this->expectException(QueryException::class);
        $user->reportBy($this->reporter, [
            'reason' => 'NotAValidReason',
        ]);
    }

    public function testReportableInstance()
    {
        $user = factory(User::class)->create();
        $reportedCount = $user->reportedIn()->count();
        $reportsCount = $this->reporter->reportsMade()->count();

        $report = $user->reportBy($this->reporter);
        $this->assertSame($reportedCount + 1, $user->reportedIn()->count());
        $this->assertSame($reportsCount + 1, $this->reporter->reportsMade()->count());
        $this->assertSame($report->user_id, $report->user_id);
        $this->assertTrue($report->reportable->is($user));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->reporter = factory(User::class)->create();
    }
}
