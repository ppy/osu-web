<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserAccountHistory;

class UserAccountHistoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'actor',
        'supporting_url',
    ];

    protected $permissions = [
        'actor' => 'UserSilenceShowExtendedInfo',
        'supporting_url' => 'UserSilenceShowExtendedInfo',
    ];

    public function transform(UserAccountHistory $h)
    {
        return [
            'description' => $h->reason,
            'id' => $h->getKey(),
            'length' => $h->period,
            'timestamp' => json_time($h->timestamp),
            'type' => $h->type,
        ];
    }

    public function includeActor(UserAccountHistory $h)
    {
        if ($h->actor !== null) {
            return $this->item($h->actor, new UserCompactTransformer());
        }
    }

    public function includeSupportingUrl(UserAccountHistory $h)
    {
        return $this->primitive($h->supporting_url);
    }
}
