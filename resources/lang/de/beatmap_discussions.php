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
    'authorizations' => [
        'update' => [
            'null_user' => 'Zum Bearbeiten bitte einloggen.',
            'system_generated' => 'Automatisch erzeugte Beiträge können nicht bearbeitet werden.',
            'wrong_user' => 'Nur der Autor des Beitrages kann den Beitrag bearbeiten.',
        ],
    ],

    'events' => [
        'empty' => 'Noch ist nichts passiert.',
    ],

    'index' => [
        'deleted_beatmap' => 'gelöscht',
        'title' => 'Beatmapdiskussion',

        'form' => [
            '_' => 'Suche',
            'deleted' => 'Gelöschte Diskussionen einbeziehen',
            'types' => 'Nachrichtentyp',
            'username' => 'Benutzername',

            'user' => [
                'label' => 'Benutzer',
                'overview' => 'Aktivitätsübersicht',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Beitragsdatum',
        'deleted_at' => 'Löschdatum',
        'message_type' => 'Typ',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Keiner dieser Beiträge behandelt mein Anliegen.',
        'notice' => 'Es gibt bereits Beiträge in der Nähe von :timestamp (:existing_timestamps). Bitte überprüfe sie, bevor du diesen absendest.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Zum Antworten einloggen',
            'user' => 'Antworten',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Von :user als gelöst erklärt',
            'false' => 'Von :user wiedereröffnet',
        ],
    ],

    'user' => [
        'admin' => 'admin',
        'bng' => 'nominator',
        'owner' => 'mapper',
        'qat' => 'qat',
    ],

    'user_filter' => [
        'everyone' => 'Jeder',
        'label' => 'Nach Benutzer filtern',
    ],
];
