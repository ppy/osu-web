<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
