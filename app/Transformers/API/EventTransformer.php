<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers\API;

use App\Models\Event;
use League\Fractal;

class EventTransformer extends Fractal\TransformerAbstract
{
    public function transform(Event $event)
    {
        return [
            'display_html' => $event->text,
            'beatmap_id' => $event->beatmap_id,
            'beatmapset_id' => $event->beatmapset_id,
            'date' => $event->date->tz('Australia/Perth')->toDateTimeString(),
            'epicfactor' => $event->epicfactor,
        ];
    }
}
