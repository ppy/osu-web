<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph;

use App\Models\Wiki\Page;

class PageOpengraph
{
    public function __construct(private Page $page)
    {
    }

    public function get(): array
    {
        $title = $this->page->title();

        return [
            // TODO: need a way to mark which wiki text to use as excerpt; first_paragraph just returns the title on wiki.
            'description' => html_excerpt($this->page->get()['output']),
            'title' => $title,
        ];
    }
}
