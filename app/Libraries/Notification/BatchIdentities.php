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

        if ($params['notifications'] ?? null) {
            $obj->notificationIds = [];
            $obj->identities = [];

            $identities = static::scrubIdentities($params['notifications']);
            foreach ($identities as $identity) {
                if (isset($identity['id'])) {
                    $obj->notificationIds[] = $identity['id'];
                    $obj->identities[] = $identity;
                }
            }
        } else {
            // TODO: just use array of ids instead of subquery?
            $obj->identities = static::scrubIdentities($params['identities'] ?? null);

            foreach ($obj->identities as $identity) {
                $query = Notification::byIdentity($identity)->select('id');
                if ($obj->notificationIds === null) {
                    $obj->notificationIds = $query;
                } else {
                    $obj->notificationIds->union($query);
                }
            }
        }

        return $obj;
    }

    public static function scrubIdentities($params): array
    {
        if (!is_array($params)) {
            return [];
        }

        $identities = [];
        foreach ($params as $param) {
            if (is_array($param)) {
                $identities[] = static::scrubIdentity($param);
            }
        }

        return $identities;
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
