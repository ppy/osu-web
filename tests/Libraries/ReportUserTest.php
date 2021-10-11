<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $user = User::factory()->create();

        $this->expectException(QueryException::class);
        $user->reportBy($this->reporter, [
            'reason' => 'NotAValidReason',
        ]);
    }

    public function testReportableInstance()
    {
        $user = User::factory()->create();
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
        $this->reporter = User::factory()->create();
    }
}
