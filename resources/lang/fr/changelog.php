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

return [
    'feed_title' => 'flux',
    'generic' => 'Corrections de bugs et améliorations mineures.',

    'build' => [
        'title' => 'changements dans :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited utilisateur en ligne|:count_delimited utilisateurs en ligne',
    ],

    'entry' => [
        'by' => 'par :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'liste des changements',
            '_from' => 'changements depuis :from',
            '_from_to' => 'changements entre :from et :to',
            '_stream' => 'changements dans :stream',
            '_stream_from' => 'changements dans :stream depuis :from',
            '_stream_from_to' => 'changements dans :stream entre :from et :to',
            '_stream_to' => 'changements dans :stream jusqu\'à :to',
            '_to' => 'changements jusqu\'à :to',
        ],

        'title' => [
            '_' => 'Changements :info',
            'info' => 'Listage',
        ],
    ],

    'support' => [
        'heading' => 'Vous aimez cette mise à jour ?',
        'text_1' => 'Supportez le développement d\'osu! et :link dès maintenant.',
        'text_1_link' => 'devenez un supporter',
        'text_2' => 'En plus de contribuer à accélérer le développement, vous recevrez des fonctionnalités supplémentaires et des personnalisations diverses !',
    ],
];
