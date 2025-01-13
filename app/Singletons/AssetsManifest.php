<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use Exception;
use Illuminate\Support\HtmlString;

class AssetsManifest
{
    private const MANIFEST_TIMEOUT_INTERVAL_SECONDS = 3; // Interval at which to check for the manifest file if it's missing.
    private const MANIFEST_TIMEOUT_SECONDS = 60; // Time limit to wait for a missing manifest file before throwing.

    private $manifest;

    public function __construct()
    {
        $manifestPath = public_path('assets/manifest.json');

        $startTimeSeconds = microtime(true);
        $elapsedTimeSeconds = 0;

        while (!file_exists($manifestPath)) {
            sleep(self::MANIFEST_TIMEOUT_INTERVAL_SECONDS);
            $elapsedTimeSeconds = microtime(true) - $startTimeSeconds;
            if ($elapsedTimeSeconds >= self::MANIFEST_TIMEOUT_SECONDS) {
                throw new Exception('The manifest does not exist.');
            }
        }

        $this->manifest = json_decode(file_get_contents($manifestPath), true);
    }

    public function src(string $resource): HtmlString
    {
        if (!isset($this->manifest[$resource])) {
            throw new Exception("resource not defined: {$resource}.");
        }

        return new HtmlString($this->manifest[$resource]);
    }
}
