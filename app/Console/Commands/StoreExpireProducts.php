<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Store\Product;
use Illuminate\Console\Command;

class StoreExpireProducts extends Command
{
    protected $signature = 'store:expire-products';

    protected $description = 'Disables products that should no longer be available.';

    public function handle()
    {
        $count = Product
            ::where('enabled', true)
            ->notAvailable()
            ->update(['enabled' => false]);

        $this->line("Disabled {$count} items.");
    }
}
