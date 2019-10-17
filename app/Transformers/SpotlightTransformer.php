<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Transformers;

use App\Models\Spotlight;
use League\Fractal;

class SpotlightTransformer extends Fractal\TransformerAbstract
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
