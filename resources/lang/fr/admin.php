<?php
/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'beatmapsets' => [
        'show' => [
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'activer',
                'activate_confirm' => 'activer Modding v2 pour cette beatmap ?',
                'active' => 'actif',
                'inactive' => 'inactif',
            ],
        ],
    ],
    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Supprimer',
                'forum-name' => 'Forum #:id: :name',
                'no-cover' => 'Pas de bannière définie',
                'submit' => [
                    'save' => 'Sauvegarder',
                    'update' => 'Modifier',
                ],
                'title' => 'Liste des bannières forum',
                'type-title' => [
                    'default-topic' => 'Bannière topic par défaut',
                    'main' => 'Bannière du forum',
                ],
            ],
        ],
    ],
    'logs' => [
        'index' => [
            'title' => 'Visionneuse de logs',
        ],
    ],
    'pages' => [
        'root' => [
            'title' => 'Console d\'administration',
            'sections' => [
                'forum' => 'Forum',
                'general' => 'Général',
                'store' => 'Magasin',
            ],
        ],
    ],
    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Liste des commandes',
            ],
        ],
    ],
];
