<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

abstract class BeatmapsetDiscussionsBundleBase
{
    protected array $extraParams;
    protected bool $isModerator;
    protected $paginator;
    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;

        $this->isModerator = priv_check('BeatmapDiscussionModerate')->can();
        $this->extraParams = [
            // TODO: normalize with mail beatmap discussions behaviour (discussion by restricted user visible for all users, name is not).
            'is_moderator' => $this->isModerator,
        ];
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

    protected function getCursor()
    {
        $paginator = $this->getPaginator();
        return $paginator->hasMorePages() ? [
            // TODO: move to non-offset
            'page' => $paginator->currentPage() + 1,
            'limit' => $paginator->perPage(),
        ] : null;
    }
}
