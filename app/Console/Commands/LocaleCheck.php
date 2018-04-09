<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use Illuminate\Console\Command;

class LocaleCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locale:check {--locales=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks locale against base locale.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $locales = explode(',', $this->option('locales'));
        $fallbackLocale = config('app.fallback_locale');

        if ($locales === ['']) {
            $locales = config('app.available_locales');
        }

        foreach ($locales as $locale) {
            if (!in_array($locale, config('app.available_locales'), true)) {
                return $this->error("Invalid locale specified: {$locale}.");
            }
        }

        $fallbackFiles = $this->files($fallbackLocale);
        $fallbackHeads = $this->heads($fallbackLocale, $fallbackFiles);
        $fallbackAll = $this->everything($fallbackLocale, $fallbackHeads);

        foreach ($locales as $locale) {
            if ($locale === $fallbackLocale) {
                continue;
            }

            $this->info("Checking locale {$locale}");
            $this->info('');

            $files = $this->files($locale);
            $heads = $this->heads($locale, $files);
            $all = $this->everything($locale, $heads);

            $this->checkExtraHeads($locale, $fallbackHeads, $heads);
            $this->info('');

            $this->checkKeys($locale, $fallbackAll, $all);
            $this->info('');

            $this->info("End checking locale {$locale}");
            $this->info('======');
        }
    }

    public function basePath($locale)
    {
        return resource_path("lang/{$locale}");
    }

    public function checkExtraHeads($locale, $baseHeads, $targetHeads)
    {
        $extras = array_diff($targetHeads, $baseHeads);

        if (count($extras) > 0) {
            $this->warn('Extraneous files:');
            foreach ($extras as $extra) {
                $this->warn("- {$locale}/{$extra}.php");
            }
        } else {
            $this->info("There's no extraneous files in {$locale}.");
        }
    }

    public function checkKeys($locale, $baseAll, $targetAll)
    {
        $baseKeys = array_keys($baseAll);
        $targetKeys = array_keys($targetAll);
        $extras = array_diff($targetKeys, $baseKeys);
        $missing = array_diff($baseKeys, $targetKeys);

        if (count($extras) > 0) {
            $this->warn('Extraneous keys:');
            foreach ($extras as $extra) {
                $this->warn("- {$extra}");
            }
        } else {
            $this->info("There's no extraneous keys in {$locale}.");
        }

        $this->info('');

        if (count($missing) > 0) {
            $this->warn('Missing keys:');
            foreach ($missing as $missingEntry) {
                $this->warn("- {$missingEntry}");
            }
        } else {
            $this->info("There's no missing keys in {$locale}.");
        }
    }

    public function everything($locale, $heads)
    {
        $entries = [];

        foreach ($heads as $head) {
            $baseEntries = trans($head, [], $locale);
            // trans returns plain string if the file is empty.
            if (is_array($baseEntries)) {
                $entries = array_merge($entries, array_dot([$head => $baseEntries]));
            }
        }

        ksort($entries);

        return $entries;
    }

    public function files($locale, $path = null)
    {
        if ($path === null) {
            $path = $this->basePath($locale);
        }

        $entries = scandir($path);
        $files = [];

        foreach ($entries as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }

            $entryPath = $path.'/'.$entry;

            if (is_link($entryPath)) {
                continue;
            }

            if (is_dir($entryPath)) {
                $files = array_merge($files, $this->files($locale, $entryPath));
            }

            if (is_file($entryPath) && ends_with($entryPath, '.php')) {
                $files[] = $entryPath;
            }
        }

        return $files;
    }

    public function heads($locale, $files)
    {
        $basePath = $this->basePath($locale);
        $trimStart = strlen($basePath) + 1; // +1 is trailing slash
        $trimEnd = -strlen('.php');

        $heads = [];

        foreach ($files as $file) {
            $heads[] = substr($file, $trimStart, $trimEnd);
        }

        return $heads;
    }
}
