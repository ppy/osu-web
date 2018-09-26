<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Models\Wiki\Pages;

use App\Exceptions\GitHubNotFoundException;
use App\Libraries\OsuMarkdownProcessor;
use App\Libraries\OsuWiki;
use Exception;

class NormalPage extends BasePage
{
    private $defaultTitle;
    private $defaultSubtitle;

    public function __construct($path, $locale, $esCache = null)
    {
        parent::__construct($path, $locale, $esCache);

        $defaultTitles = explode('/', str_replace('_', ' ', $this->path));
        $this->defaultTitle = array_pop($defaultTitles);
        $this->defaultSubtitle = array_pop($defaultTitles);
    }

    public function pagePath()
    {
        return $this->path.'/'.$this->locale.'.md';
    }

    public function pageContent()
    {
        try {
            $body = OsuWiki::fetchContent('wiki/'.$this->pagePath());
        } catch (Exception $e) {
            if (!$e instanceof GitHubNotFoundException) {
                $index = false;

                log_error($e);
            }

            $body = null;
        }

        if (present($body)) {
            return OsuMarkdownProcessor::process($body, [
                'path' => route('wiki.show', $this->path),
            ]);
        }
    }

    public function pageTemplate()
    {
        return 'wiki.show';
    }

    public function title($withSubtitle = false)
    {
        if ($this->page() === null) {
            return trans('wiki.show.missing_title');
        }

        $title = presence($this->page()['header']['title'] ?? null) ?? $this->defaultTitle;

        if ($withSubtitle && present($this->subtitle())) {
            $title = $this->subtitle().' / '.$title;
        }

        return $title;
    }

    public function subtitle()
    {
        if ($this->page() === null) {
            return;
        }

        return presence($this->page()['header']['subtitle'] ?? null) ?? $this->defaultSubtitle;
    }
}
