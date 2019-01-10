<?php

/**
 *    Copyright 2015-2019 ppy Pty. Ltd.
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
use App\Models\Tournament;
use Illuminate\Console\Command;

class StoreDisableEndedTournamentBanners extends Command
{
    protected $signature = 'store:disable-ended-tournament-banners';

    protected $description = 'Disables banner products of tournaments that have ended';

    public function handle()
    {
        $instance = new Tournament;
        $qualifiedTable = "{$instance->dbName()}.{$instance->getTable()}";

        $count = Product
            ::where('enabled', true)
            ->whereIn('tournament_id', Tournament::from($qualifiedTable)->ended()->select('tournament_id'))
            ->update(['enabled' => false]);

        $this->line("Disabled {$count} items.");
    }
}
