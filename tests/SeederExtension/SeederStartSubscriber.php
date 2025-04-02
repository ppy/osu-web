<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\SeederExtension;

use Database\Seeders\ModelSeeders\GroupSeeder;
use PHPUnit\Event\TestRunner\Started;
use PHPUnit\Event\TestRunner\StartedSubscriber;
use Tests\TestCase;

class SeederStartSubscriber implements StartedSubscriber
{
    public function notify(Started $event): void
    {
        TestCase::withDbAccess(function () {
            (new GroupSeeder())->run();
        });
    }
}
