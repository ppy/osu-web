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
            'only_unresolved' => 'Alleen niet-afgehandelde discussies weergeven',
            'types' => 'Berichttypen',
            'username' => 'Gebruikersnaam',

            'beatmapset_status' => [
                '_' => 'Beatmap status',
                'all' => 'Alle',
                'disqualified' => 'Gediskwalificeerd',
                'never_qualified' => 'Nooit gekwalificeerd',
                'qualified' => 'Gekwalificeerd',
                'ranked' => 'Ranked',
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

    'review' => [
        'go_to_parent' => 'Bekijk Review Post',
        'go_to_child' => 'Bekijk discussie',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Gemarkeerd als opgelost door :user',
            'false' => 'Heropend door :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'algemeen',
        'general_all' => 'algemeen (alles)',
    ],

    'user_filter' => [
        'everyone' => 'Iedereen',
        'label' => 'Filter op gebruiker',
    ],
];
