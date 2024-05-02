<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private $name)
    {
    }

    public function displayName()
    {
        return $this->name;
    }

    public function handle()
    {
    }
}
