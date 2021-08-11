<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'Er zijn geen discussies gevonden die overeenkomen met de zoekcriteria.',
        'title' => 'Beatmap Discussies',

        'form' => [
            '_' => 'Zoeken',
            'deleted' => 'Verwijderde discussies toevoegen',
            'mode' => 'Beatmap modus',
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
        'unsaved' => ':count in deze review',
    ],

    'owner_editor' => [
        'button' => 'Moeilijkheidsgraad Eigenaar',
        'reset_confirm' => 'Reset eigenaar voor deze moeilijkheid?',
        'user' => 'Eigenaar',
        'version' => 'Moeilijkheidsgraad',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Log in om te Antwoorden',
            'user' => 'Beantwoord',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blokken gebruikt',
        'go_to_parent' => 'Bekijk Review Post',
        'go_to_child' => 'Bekijk discussie',
        'validation' => [
            'block_too_large' => 'elk blok mag maximaal :limit tekens bevatten',
            'external_references' => 'review bevat verwijzingen naar kwesties die niet tot deze beoordeling behoren',
            'invalid_block_type' => 'ongeldige bloktype',
            'invalid_document' => 'ongeldige beoordeling',
            'invalid_discussion_type' => 'ongeldige discussie type',
            'minimum_issues' => 'beoordeling moet een minimum van :count issue|review moeten een minimum :count issues bevatten',
            'missing_text' => 'blok mist tekst',
            'too_many_blocks' => 'beoordelingen kunnen alleen :count alinea/issuemaybe beoordelingen bevatten max. :count alinea/issues',
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
