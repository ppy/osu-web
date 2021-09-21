<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Store\Order;
use Illuminate\Console\Command;

class StoreCleanupStaleOrders extends Command
{
    protected $signature = 'store:cleanup-stale-orders';

    protected $description = 'Removes stale orders';

    public function handle()
    {
        $count = Order::processing()->stale()->update(['status' => Order::STATUS_CANCELLED]);

        $this->line("Cancelled {$count} stale orders.");
    }
}
