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

use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\Sort;
use App\Libraries\Search\BasicSearch;

class SitemapRenderer extends MarkdownRenderer
{
    /**
     * {@inheritdoc}
     */
    public function __construct($page, $body)
    {
        parent::__construct($page, $body);

        $this->fetchPages();
        $this->generateSitemap();
    }

    private function fetchPages()
    {
        $pages = [];
        $titles = [];

        $cursor = [''];

        while ($cursor !== null) {
            $search = $this->newBaseSearch()->searchAfter(array_values($cursor));
            $response = $search->response();

            foreach ($response as $hit) {
                $path = $hit->source('path');
                $title = $hit->source('title');

                $pages[] = [
                    'title' => $hit->source('title'),
                    'path' => $path,
                    'depth' => substr_count($path, '/'),
                ];

                $titles[$path] = $title;
            }

            $cursor = $search->getSortCursor();
        }

        // sorts the pages first by the respective parts of their path,
        // and then, if necessary by their depth (so a parent page
        // will end up before its children)
        usort($pages, function ($left, $right) use ($titles) {
            $l = explode('/', $left['path']);
            $r = explode('/', $right['path']);

            $min = min(count($l), count($r));

            $lpath = $l[0];
            $rpath = $r[0];

            for ($i = 0; $i < $min; $i++) {
                // this is done in case that either:
                //   * a localized version of an article exists, but there's no localized version of the parent article
                //   * there's no parent article (as in it's just a directory with no page,
                //     for instance https://github.com/ppy/osu-wiki/tree/master/wiki/Contests/oMWC)
                $ltitle = array_key_exists($lpath, $titles) ? $titles[$lpath] : $this->cleanTitle($l[0]);
                $rtitle = array_key_exists($rpath, $titles) ? $titles[$rpath] : $this->cleanTitle($r[0]);

                $cmp = strcmp($ltitle, $rtitle);

                if ($cmp !== 0) {
                    return $cmp;
                }

                if ($i !== $min - 1) {
                    $lpath .= '/'.$l[$i + 1];
                    $rpath .= '/'.$r[$i + 1];
                }
            }

            return $left['depth'] - $right['depth'];
        });

        $this->pages = $pages;
    }

    private function generateSitemap()
    {
        $prevPage = $this->pages[0];

        $this->body .= "\n";

        foreach ($this->pages as $page) {
            $depth = $page['depth'];

            // same situation as in the previous comment, but in here we insert a list element
            // relating to the page that doesn't exist in the (localized) wiki, so that it's
            // children don't get attached to a different element
            if (($depth - $prevPage['depth'] > 1) ||
                ($depth > 0 && $depth - $prevPage['depth'] >= 0 &&
                 $this->getPathPart($page['path'], $depth - 1) !== $this->getPathPart($prevPage['path'], $depth - 1))) {
                $this->body .= $this->indentList($page['depth'] - 1);
                $this->body .= '* '.$this->cleanTitle($this->getPathPart($page['path'], $page['depth'] - 1))."\n";
            }

            $this->body .= $this->indentList($page['depth']);
            $this->body .= '* ['.$page['title'].'](/wiki/'.$page['path'].")\n";

            $prevPage = $page;
        }
    }

    private function newBaseSearch() : Search
    {
        return (new BasicSearch(config('osu.elasticsearch.index.wiki_pages'), 'sitemap_generator'))
        ->query([
            'term' => [
                'locale' => [
                    'value' => $this->page->locale,
                ],
            ], ])
        ->source(['title', 'path'])
        ->sort(new Sort('_id', 'asc'));
    }

    private function indentList($depth)
    {
        $return = '';

        for ($i = 0; $i < $depth; $i++) {
            $return .= '  ';
        }

        return $return;
    }

    private function getPathPart($path, $depth)
    {
        $split = explode('/', $path);

        return $split[$depth];
    }

    private function cleanTitle($title)
    {
        return str_replace('_', ' ', $title);
    }
}
