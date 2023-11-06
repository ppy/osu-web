<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests;

use App\Models\Group;
use Database\Seeders\ModelSeeders\GroupSeeder;
use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\BeforeFirstTestHook;

class SeederExtension implements AfterLastTestHook, BeforeFirstTestHook
{
    public function executeAfterLastTest(): void
    {
        TestCase::withDbAccess(function () {
            Group::truncate();
        });
    }

    public function executeBeforeFirstTest(): void
    {
        TestCase::withDbAccess(function () {
            (new GroupSeeder())->run();
        });
    }
}
