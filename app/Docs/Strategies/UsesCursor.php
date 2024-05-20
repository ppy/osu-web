<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Docs\Strategies;

use Knuckles\Camel\Extraction\ExtractedEndpointData;
use Knuckles\Scribe\Extracting\RouteDocBlocker;
use Knuckles\Scribe\Extracting\Strategies\Strategy;

class UsesCursor extends Strategy
{
    public function __invoke(ExtractedEndpointData $endpointData, array $routeRules = []): ?array
    {
        $docBlock = RouteDocBlocker::getDocBlocksFromRoute($endpointData->route)['method'];
        $tags = $docBlock->getTagsByName('usesCursor');

        return empty($tags)
            ? []
            : [
                'cursor_string' => [
                    'description' => '[CursorString](#cursorstring) for pagination.',
                    'required' => false,
                    'example' => null,
                ],
            ];
    }
}
