<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph\Wiki;

use App\Libraries\Opengraph\OpengraphInterface;
use App\Models\Wiki\Page;

class PageOpengraph implements OpengraphInterface
{
    public function __construct(private Page $page)
    {
    }

    public function get(): array
    {
        if (!$this->page->isVisible()) {
            return [];
        }

        return [
            'description' => $this->page->getTextPreview(),
            'title' => $this->page->title(),
        ];
    }
}
