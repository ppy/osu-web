<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Wiki;

use App\Libraries\Elasticsearch\Hit;

class PageSearchResult extends Page
{
    /** @var Hit */
    private $hit;

    public static function fromEs($hit)
    {
        $page = parent::fromEs($hit);
        $page->hit = $hit;

        return $page;
    }

    public function highlightedTitle()
    {
        $highlights = $this->hit->highlights('title');
        if (empty($highlights)) {
            return $this->title(true);
        }

        $title = $highlights[0];

        if (present($this->subtitle())) {
            $title = $this->subtitle().' / '.$title;
        }

        return $title;
    }

    public function highlights()
    {
        return implode(
            ' ... ',
            $this->hit->highlights(
                'page_text',
                300
            )
        );
    }
}
