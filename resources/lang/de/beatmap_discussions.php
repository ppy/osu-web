<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
            'only_unresolved' => '',
            'types' => 'Nachrichtentyp',
            'username' => 'Benutzername',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

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

    'user_filter' => [
        'everyone' => 'Jeder',
        'label' => 'Nach Benutzer filtern',
    ],
];
