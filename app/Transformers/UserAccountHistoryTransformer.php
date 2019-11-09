<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers;

use App\Models\UserAccountHistory;
use League\Fractal;

class UserAccountHistoryTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'actor',
        'supporting_url',
    ];

    public function transform(UserAccountHistory $h)
    {
        return [
            'description' => $h->reason,
            'type' => $h->type,
            'timestamp' => json_time($h->timestamp),
            'length' => $h->period,
        ];
    }

    public function includeActor(UserAccountHistory $h)
    {
        if ($h->actor !== null) {
            return $this->item($h->actor, new UserCompactTransformer);
        }
    }

    public function includeSupportingUrl(UserAccountHistory $h)
    {
        return $this->primitive($h->supporting_url);
    }
}
