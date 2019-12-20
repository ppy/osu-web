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

return [
    'show' => [
        'fallback_translation' => 'Requested page is not yet translated to the selected language (:language). Showing English version.',
        'incomplete_or_outdated' => 'The content on this page is incomplete or outdated. If you are able to help out, please consider updating the article!',
        'missing' => 'Requested page ":keyword" could not be found.',
        'missing_title' => 'Not Found',
        'missing_translation' => 'Requested page could not be found for currently selected language.',
        'needs_cleanup_or_rewrite' => 'This page does not meet the standards of the osu! wiki and needs to be cleaned up or rewritten. If you are able to help out, please consider updating the article!',
        'search' => 'Search existing pages for :link.',
        'toc' => 'Contents',

        'edit' => [
            'link' => 'Show on GitHub',
            'refresh' => 'Refresh',
        ],

        'translation' => [
            'legal' => 'This translation is provided for convenience only. The original :default shall be the sole legally binding version of this text.',
            'outdated' => 'This page contains an outdated translation of the original content. Please check the :default for the most accurate information (and consider updating the translation if you are able to help out)!',

            'default' => 'English version',
        ],
    ],
    'main' => [
        'title' => 'knowledge base',
        'subtitle' => 'because osu!pedia sounds lame',
    ],
];
