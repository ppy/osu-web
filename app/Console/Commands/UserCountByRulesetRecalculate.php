<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Singletons\UserCountByRuleset;
use Illuminate\Console\Command;

class UserCountByRulesetRecalculate extends Command
{
    protected $description = 'Cache per-ruleset user count data for achievement percentage display.';

    protected $signature = 'user-count-by-ruleset:recalculate';

    public function handle()
    {
        UserCountByRuleset::update();
    }
}
