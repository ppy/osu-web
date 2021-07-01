<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Exception;
use Illuminate\Support\HtmlString;

class AssetsManifest
{
    private $manifest;

    public function __construct()
    {
        $manifestPath = public_path('assets/manifest.json');

        if (!file_exists($manifestPath)) {
            throw new Exception('The manifest does not exist.');
        }

        $this->manifest = json_decode(file_get_contents($manifestPath), true);
    }

    public function src(string $resource)
    {
        if (!isset($this->manifest[$resource])) {
            throw new Exception("resource not defined: {$resource}.");
        }

        return new HtmlString($this->manifest[$resource]);
    }
}
