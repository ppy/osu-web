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
            'null_user' => 'Du må være logget inn for å redigere.',
            'system_generated' => 'Systemgenererte innlegg kan ikke redigeres.',
            'wrong_user' => 'Du må være eier av innlegget for å redigere.',
        ],
    ],

    'events' => [
        'empty' => 'Ingenting har skjedd... enda.',
    ],

    'index' => [
        'deleted_beatmap' => 'slettet',
        'title' => 'Beatmapdiskusjoner',

        'form' => [
            '_' => 'Søk',
            'deleted' => 'Inkluder slettede diskusjoner',
            'only_unresolved' => '',
            'types' => 'Meldingstyper',
            'username' => 'Brukernavn',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Bruker',
                'overview' => 'Aktivitetsoversikt',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Publiseringsdato',
        'deleted_at' => 'Slettingsdato',
        'message_type' => 'Type',
        'permalink' => 'Permalenke',
    ],

    'nearby_posts' => [
        'confirm' => 'Ingen av innleggene gjelder mine bekymringer',
        'notice' => 'Det er innlegg rundt :timestamp (:existing_timestamps). Vennligst gjennomgå dem før publisering.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Logg inn for å svare',
            'user' => 'Svar',
        ],
    ],

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => '',
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
            'true' => 'Merket som løst av :user',
            'false' => 'Gjenåpnet av :user',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Alle',
        'label' => 'Filtrer etter bruker',
    ],
];
