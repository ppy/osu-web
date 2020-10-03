<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\RouteScopesHelper;
use Illuminate\Console\Command;

class RouteConvert extends Command
{
    const FILE_OPTIONS = ['from-csv', 'from-json', 'to-csv', 'to-json'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:convert {--from-csv=} {--from-json=} {--to-csv=} {--to-json=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump existing api routes or convert route dump file.';

    protected $options = [];

    protected $routeScopesHelper;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->readOptions();

        $this->routeScopesHelper = new RouteScopesHelper();

        $this->read();
        $this->write();
    }

    protected function read()
    {
        if ($filename = $this->options['from-csv']) {
            $this->routeScopesHelper->fromCsv($filename);
        } elseif ($filename = $this->options['from-json']) {
            $this->routeScopesHelper->fromJson($filename);
        } else {
            $this->routeScopesHelper->loadRoutes();
        }
    }

    protected function readOptions()
    {
        foreach (static::FILE_OPTIONS as $name) {
            $this->options[$name] = presence($this->option($name));
        }
    }

    protected function write()
    {
        $written = false;
        $this->routeScopesHelper->fillMissingMiddlewares();

        if ($filename = $this->options['to-csv']) {
            $this->routeScopesHelper->toCsv($filename);
            $written = true;
        }

        if ($filename = $this->options['to-json']) {
            $this->routeScopesHelper->toJson($filename);
            $written = true;
        }

        if (!$written) {
            $this->line(json_encode($this->routeScopesHelper->toArray(), JSON_PRETTY_PRINT));
        }
    }
}
