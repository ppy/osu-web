<?php

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

        if (empty($tags)) {
            return [];
        }

        return [
            'cursor_string' => [
                'description' => '[CursorString](#cursorstring) for pagination.',
                'required' => false,
                'example' => null,
            ],
        ];
    }
}
