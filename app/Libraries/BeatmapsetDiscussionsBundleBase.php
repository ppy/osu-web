<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

abstract class BeatmapsetDiscussionsBundleBase
{
    protected $isModerator;
    protected $paginator;
    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;

        $this->isModerator = priv_check('BeatmapDiscussionModerate')->can();
        if ($this->isModerator) {
            // TODO: normalize with mail beatmap discussions behaviour (discussion by restricted user visible for all users, name is not).
            $this->params['is_moderator'] = true;
        } else {
            $this->params['with_deleted'] = false;
        }
    }

    /**
     * That main paginated dataset for the bundle.
     */
    abstract public function getData();

    public function getPaginator()
    {
        if ($this->paginator === null) {
            $this->getData();
        }

        return $this->paginator;
    }
}
