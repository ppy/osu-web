<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Exceptions\ValidationException;
use App\Models\Build;
use App\Models\User;
use App\Models\UserReport;
use Tests\TestCase;

class ReportCommentTest extends TestCase
{
    private $reporter;

    public function testCannotReportOwnComment()
    {
        $comment = $this->createComment($this->reporter);

        $this->expectException(ValidationException::class);
        $comment->reportBy($this->reporter);
    }

    public function testReasonIsIgnored()
    {
        $comment = $this->createComment(User::factory()->create());

        $this->expectException(ValidationException::class);

        $comment->reportBy($this->reporter, [
            'reason' => 'NotAValidReason',
        ]);
    }

    public function testReportableInstance()
    {
        $comment = $this->createComment(User::factory()->create());

        $query = UserReport::where('reportable_type', 'comment')->where('reportable_id', $comment->getKey());
        $reportedCount = $query->count();
        $reportsCount = $this->reporter->reportsMade()->count();

        $report = $comment->reportBy($this->reporter);
        $this->assertSame($reportedCount + 1, $query->count());
        $this->assertSame($reportsCount + 1, $this->reporter->reportsMade()->count());
        $this->assertSame($report->user_id, $report->user_id);
        $this->assertTrue($report->reportable->is($comment));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->reporter = User::factory()->create();
    }

    private function createComment($user)
    {
        $commentable = Build::factory()->create();

        return $commentable->comments()->create([
            'message' => 'Test',
            'user_id' => $user->getKey(),
        ]);
    }
}
