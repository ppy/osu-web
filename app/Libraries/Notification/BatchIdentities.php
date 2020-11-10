<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Notification;

use App\Models\Notification;

class BatchIdentities
{
    private $notificationIds;
    private $identities;

    public static function fromParams(array $params)
    {
        $obj = new static();

        if (is_array($params['notifications'] ?? null)) {
            $obj->notificationIds = [];
            $obj->identities = [];
            foreach ($params['notifications'] as $identity) {
                $identity = static::scrubIdentity($identity);

                if (isset($identity['id'])) {
                    $obj->notificationIds[] = $identity['id'];
                    $obj->identities[] = $identity;
                }
            }
        } else {
            $identity = static::scrubIdentity($params);
            $obj->notificationIds = Notification::byIdentity($identity)->select('id');
            $obj->identities = [$identity];
        }

        return $obj;
    }

    public static function scrubIdentity(array $identity)
    {
        return get_params($identity, null, [
            'category',
            'id:int',
            'object_id:int',
            'object_type',
        ]);
    }

    /**
     * @return array
     */
    public function getIdentities()
    {
        return $this->identities;
    }

    /**
     * Returns object suitable to be passed to `whereIn` query.
     *
     * @return array|\Illuminate\Database\Eloquent\Builder
     */
    public function getNotificationIds()
    {
        return $this->notificationIds;
    }
}
