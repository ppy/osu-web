<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Event;

class EventTransformer extends TransformerAbstract
{
    public function transform(Event $event)
    {
        $event->parse();
        $createdAt = $event->getJsonTime('date');

        return [
            'created_at' => $createdAt,
            'createdAt' => $createdAt, // TODO: remove when confirmed not used.
            'id' => $event->getKey(),
            'type' => $event->type,
            ...$event->details,
        ];
    }
}
