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
    'button' => [
        'action' => [
            'to_0' => 'Ne plus surveiller',
            'to_1' => 'Surveiller',
        ],
    ],

    'index' => [
        'description' => 'Ce sont les discussions de beatmapsets que vous suivez. Vous serez notifiés quand il y aura de nouveaux posts ou des mises à jour.',
        'title_compact' => 'liste de surveillance du modding',
        'title_main' => 'Liste de Surveillance du Modding',

        'table' => [
            'empty' => 'Aucune discussion de beatmap surveillée.',
            'open_issues' => 'Problèmes ouverts',
            'state' => 'État',
            'title' => 'Titre',
        ],
    ],

    'mail' => [
        'update' => 'Nouvelle mise à jour pour la beatmap ":title"',
    ],

    'status' => [
        'read' => 'Lu',
        'unread' => 'Non lu',
    ],
];
