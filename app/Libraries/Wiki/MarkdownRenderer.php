<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Wiki;

use App\Libraries\Markdown\OsuMarkdown;

/**
 * {@inheritdoc}
 */
class MarkdownRenderer extends Renderer
{
    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return (new OsuMarkdown('wiki', [
            'wiki_locale' => $this->page->locale,
            'relative_url_root' => wiki_url($this->page->path, $this->page->locale, false, false),
        ]))->load($this->body)->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function renderIndexable()
    {
        return (new OsuMarkdown('wiki', [
            'wiki_locale' => $this->page->locale,
            'relative_url_root' => wiki_url($this->page->path, $this->page->locale, false, false),
        ]))->load($this->body)->toIndexable();
    }
}
