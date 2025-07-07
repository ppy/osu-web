<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Search\ScoreSearch;
use Illuminate\Console\Command;

class EsIndexScoresSetSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:index-scores:set-schema
        {--schema= : Schema version to be set}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set schema version of score index.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schema = presence($this->option('schema'));

        if ($schema === null) {
            return $this->error('Index schema must be specified');
        }

        ScoreSearch::setSchema($schema);

        $this->info("Set score index schema version to {$schema}");
    }
}
