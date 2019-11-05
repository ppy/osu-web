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

namespace App\Libraries\Wiki;

use App\Models\Wiki\Page;

/**
 * @property Page $page
 * @property string $body
 */
abstract class Renderer
{
    /**
     * @param Page $page
     * @param string $body
     */
    public function __construct($page, $body)
    {
        $this->page = $page;
        $this->body = $body;
    }

    /**
     * Renders the {@see App\Models\Wiki\Page::get()} representation of this wiki page.
     */
    abstract public function render();

    /**
     * Renders the indexable {@see App\Models\Wiki\Page::get()} representation of this wiki page.
     */
    abstract public function renderIndexable();
}
