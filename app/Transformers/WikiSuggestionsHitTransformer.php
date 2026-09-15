<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Libraries\Elasticsearch\Hit;

class WikiSuggestionsHitTransformer extends TransformerAbstract
{
    public function transform(Hit $hit)
    {
        return [
            'highlight' => $hit->highlights('title.autocomplete')[0],
            'locale' => $hit->source('locale'),
            'path' => $hit->source('path'),
            'title' => $hit->source('title'),
        ];
    }
}
