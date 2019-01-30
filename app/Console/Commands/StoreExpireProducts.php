<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
