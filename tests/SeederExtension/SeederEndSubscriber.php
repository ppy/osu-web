<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\SeederExtension;

use App\Models\Group;
use PHPUnit\Event\TestRunner\Finished;
use PHPUnit\Event\TestRunner\FinishedSubscriber;
use Tests\TestCase;

class SeederEndSubscriber implements FinishedSubscriber
{
    public function notify(Finished $event): void
    {
        TestCase::withDbAccess(function () {
            Group::truncate();
        });
    }
}
