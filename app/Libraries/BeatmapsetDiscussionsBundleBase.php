<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

abstract class BeatmapsetDiscussionsBundleBase
{
    protected $isModerator;
    protected $paginator;
    protected $params;
    protected $search;

    public function __construct(array $params)
    {
        $this->params = $params;

        $this->isModerator = priv_check('BeatmapDiscussionModerate')->can();
        if (!$this->isModerator) {
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

    public function getParams()
    {
        return $this->params;
    }

    public function getSearch()
    {
        return $this->search;
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
