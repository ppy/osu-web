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

use File;
use Illuminate\Console\Command;

class LocaleCheck extends Command
{
    const FILE_EXTENSION = 'php';

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

        $fallbackNamespaces = $this->namespaces($fallbackLocale);
        $fallbackAll = $this->everything($fallbackLocale, $fallbackNamespaces);

        foreach ($locales as $locale) {
            if ($locale === $fallbackLocale) {
                continue;
            }

            $this->info("Checking locale {$locale}");
            $this->info('');

            $namespaces = $this->namespaces($locale);
            $all = $this->everything($locale, $namespaces);

            $this->checkExtraFiles($locale, $fallbackNamespaces, $namespaces);
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

    public function checkExtraFiles($locale, $baseNamespaces, $targetNamespaces)
    {
        $extras = array_diff($targetNamespaces, $baseNamespaces);

        if (count($extras) > 0) {
            $this->warn('Extraneous files:');
            foreach ($extras as $extra) {
                $message = sprintf('- %s/%s.%s', $locale, $extra, static::FILE_EXTENSION);
                $this->warn($message);
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

    public function everything($locale, $namespaces)
    {
        $entries = [];

        foreach ($namespaces as $namespace) {
            $baseEntries = trans($namespace, [], $locale);
            // trans returns plain string if the file is empty.
            if (is_array($baseEntries)) {
                $entries = array_merge($entries, array_dot([$namespace => $baseEntries]));
            }
        }

        ksort($entries);

        return $entries;
    }

    public function namespaces($locale)
    {
        $namespaces = [];
        $trimEnd = -(1 + strlen(static::FILE_EXTENSION));

        foreach (File::allFiles($this->basePath($locale)) as $file) {
            if ($file->getExtension() !== static::FILE_EXTENSION) {
                continue;
            }

            $relativePath = $file->getRelativePathname();
            $namespaces[] = substr($relativePath, 0, $trimEnd);
        }

        return $namespaces;
    }
}
