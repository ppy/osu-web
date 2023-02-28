<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Ip2AsnUpdater;
use Illuminate\Console\Command;

class Ip2AsnUpdate extends Command
{
    protected $signature = 'ip2asn:update';
    protected $description = 'Update or initialise ip2asn database';

    public function handle()
    {
        $this->info('Updating ip2asn database');
        (new Ip2AsnUpdater())->run(function (string $message): void {
            $this->info($message);
        });
        $this->info('Done');
    }
}
