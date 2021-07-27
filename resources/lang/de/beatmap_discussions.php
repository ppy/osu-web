<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'Es wurden keine Diskussionen gefunden, die mit diesen Suchkriterien übereinstimmen.',
        'title' => 'Beatmapdiskussion',

        'form' => [
            '_' => 'Suche',
            'deleted' => 'Gelöschte Diskussionen einbeziehen',
            'mode' => 'Beatmap-Modus',
            'only_unresolved' => 'Nur ungelöste Diskussionen anzeigen',
            'types' => 'Nachrichtentyp',
            'username' => 'Benutzername',

            'beatmapset_status' => [
                '_' => 'Beatmap-Status',
                'all' => 'Alle',
                'disqualified' => 'Disqualifiziert',
                'never_qualified' => 'Nie Qualifiziert',
                'qualified' => 'Qualifiziert',
                'ranked' => 'Ranked',
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
        'unsaved' => ':count in dieser Bewertung',
    ],

    'owner_editor' => [
        'button' => 'Schwierigkeitsstufenbesitzer',
        'reset_confirm' => 'Besitzer für diese Schwierigkeit zurücksetzen?',
        'user' => 'Besitzer',
        'version' => 'Schwierigkeit',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Zum Antworten einloggen',
            'user' => 'Antworten',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max Blöcke verwendet',
        'go_to_parent' => 'Rezensionsbeitrag anzeigen',
        'go_to_child' => 'Diskussion anzeigen',
        'validation' => [
            'block_too_large' => 'jeder block darf höchstens :limit zeichen enthalten',
            'external_references' => 'rezension enthält verweise auf probleme, die nicht zu dieser rezension gehören',
            'invalid_block_type' => 'ungültiger Block-Typ',
            'invalid_document' => 'ungültige Rezension',
            'invalid_discussion_type' => '',
            'minimum_issues' => 'Rezension muss ein Minimum von :count Problem beinhalten|Rezensionen müssen ein Minimum von :count Problemen beinhalten',
            'missing_text' => 'block fehlt Text',
            'too_many_blocks' => 'Rezensionen dürfen nur :count Paragraph/Problem enthalten|Rezensionen dürfen nur bis zu :count Paragraphen/Probleme enthalten',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Von :user als gelöst erklärt',
            'false' => 'Von :user wiedereröffnet',
        ],
    ],

    'timestamp_display' => [
        'general' => 'allgemein',
        'general_all' => 'allgemein (alle)',
    ],

    'user_filter' => [
        'everyone' => 'Jeder',
        'label' => 'Nach Benutzer filtern',
    ],
];
