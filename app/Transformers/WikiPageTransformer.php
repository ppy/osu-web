<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Wiki\Page;

class WikiPageTransformer extends TransformerAbstract
{
    public function transform(Page $page)
    {
        return [
            'layout' => $page->layout(),
            'locale' => $page->locale,
            'markdown' => $page->getMarkdown(),
            'path' => $page->path,
            'subtitle' => $page->subtitle(),
            'tags' => $page->tags(),
            'title' => $page->title(),
            'other_locales' => $page->otherLocales(),
        ];
    }
}
