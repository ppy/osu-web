<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'landing' => [
        'online' => '<strong>:players</strong> joueurs en ligne en ce moment in <strong>:games</strong> games',
        'peak' => 'Pic, :count joueurs en ligne',
        'players' => '<strong>:count</strong> joueurs inscrits',

        'download' => [
            '_' => 'Télécharger maitenant',
            'soon' => "osu! pour d'autres systèmes d'exploitations à venir",
            'for' => 'pour :os',
            'other' => 'cliquez ici pour :os1 ou :os2',
        ],

        'slogan' => [
            'main' => 'simulateur de cercles free-to-win',
            'sub' => 'Le rythme est à un seul clic',
        ],
    ],

    'user' => [
        'title' => 'nouvelles',
        'news' => [
            'title' => 'Nouvelles',
            'error' => 'Erreur lors du chargement des nouvelles, essayez de recharger la page?...',
        ],
        'header' => [
            'welcome' => 'Bonjour, <strong>:username</strong>!',
            'messages' => 'Vous avez 1 nouveau message|Vous avez :count nouveaux messages',
            'stats' => [
                'online' => 'Utilisateurs en ligne',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nouvelles Beatmaps Approuvées',
            'popular' => 'Beatmaps Populaires',
        ],
        'buttons' => [
            'download' => 'Télécharger osu!',
            'support' => 'Supporter osu!',
            'store' => 'osu!store',
        ],
    ],
];
