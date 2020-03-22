<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Spotlight;
use League\Fractal;

class SpotlightTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'participant_count',
    ];

    public function transform(Spotlight $spotlight)
    {
        return [
            'end_date' => json_time($spotlight->end_date),
            'id' => $spotlight->getKey(),
            'mode_specific' => $spotlight->mode_specific,
            'name' => $spotlight->name,
            'start_date' => json_time($spotlight->start_date),
            'type' => $spotlight->type,
        ];
    }

    public function includeParticipantCount(Spotlight $spotlight, Fractal\ParamBag $params)
    {
        $mode = $params->get('mode')[0];

        return $this->primitive($spotlight->participantCount($mode));
    }
}
