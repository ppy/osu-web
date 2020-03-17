<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

abstract class SilentEnabledCommand extends Command
{
    public function info($string)
    {
        if (!$this->option('silent')) {
            parent::info($string);
        }
    }

    public function comment($string)
    {
        if (!$this->option('silent')) {
            parent::comment($string);
        }
    }

    public function getOptions()
    {
        return [
            ['silent', null, InputOption::VALUE_NONE, 'Silence the output from the function', null],
        ];
    }
}
