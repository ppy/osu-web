<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Jobs;

use Illuminate\Queue\Events\JobProcessed;
use Queue;
use Tests\TestCase;

class JobDisplayNameTest extends TestCase
{
    public function testDisplayName()
    {
        $job = new TestJob('test');

        Queue::after(function (JobProcessed $event) use ($job) {
            $payload = $event->job->payload();
            $this->assertSame($job::class, $payload['data']['commandName']);
            $this->assertSame($job->displayName(), $payload['displayName']);
        });

        dispatch($job);
    }
}
