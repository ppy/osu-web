<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Je moet ingelogd zijn om te bewerken.',
            'system_generated' => 'Systeemgegenereerde posts kunnen niet worden bewerkt.',
            'wrong_user' => 'Je moet de eigenaar zijn om te kunnen bewerken.',
        ],
    ],

    'events' => [
        'empty' => 'Er is nog niets gebeurt... nog niet.',
    ],

    'index' => [
        'deleted_beatmap' => 'verwijderd',
        'title' => 'Beatmap Discussies',

        'form' => [
            '_' => 'Zoeken',
            'deleted' => 'Verwijderde discussies toevoegen',
            'only_unresolved' => '',
            'types' => 'Berichttypen',
            'username' => 'Gebruikersnaam',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Gebruiker',
                'overview' => 'Activiteitenoverzicht',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Postdatum',
        'deleted_at' => 'Verwijderdatum',
        'message_type' => 'Type',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Geen van deze posts pakken mijn punten van zorg aan',
        'notice' => 'Dit zijn de posts rond :timestamp (:existing_timestamp). Controleer ze voor te posten.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Log in om te Antwoorden',
            'user' => 'Beantwoord',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Gemarkeerd als opgelost door :user',
            'false' => 'Heropend door :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Iedereen',
        'label' => 'Filter op gebruiker',
    ],
];
