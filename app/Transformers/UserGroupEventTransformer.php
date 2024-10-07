<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\UserGroupEvent;
use League\Fractal\Resource\ResourceInterface;

class UserGroupEventTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'actor',
    ];

    protected array $defaultIncludes = [
        'actor',
    ];

    protected $permissions = [
        'actor' => 'UserGroupEventShowActor',
    ];

    public function transform(UserGroupEvent $event): array
    {
        $json = [
            'created_at' => $event->created_at_json,
            'group_id' => $event->group_id,
            'hidden' => $event->isHidden(),
            'id' => $event->id,
            'type' => $event->type,
            'user_id' => $event->user_id,
            ...$event->details,
        ];

        unset($json['actor_name']);

        return $json;
    }

    public function includeActor(UserGroupEvent $event): ResourceInterface
    {
        if ($event->actor_id === null) {
            return $this->null();
        }

        return $this->primitive([
            'id' => $event->actor_id,
            'username' => $event->details['actor_name'],
        ]);
    }
}
