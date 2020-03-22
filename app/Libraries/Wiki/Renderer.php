<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
