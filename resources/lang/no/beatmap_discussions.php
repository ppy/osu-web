<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'Det er ingen tråd som sammensvarer dine søke kriterier.',
        'title' => 'Beatmapdiskusjoner',

        'form' => [
            '_' => 'Søk',
            'deleted' => 'Inkluder slettede diskusjoner',
            'mode' => '',
            'only_unresolved' => 'Vis bare uløste tråder',
            'types' => 'Meldingstyper',
            'username' => 'Brukernavn',

            'beatmapset_status' => [
                '_' => 'Beatmap Status',
                'all' => 'Alt',
                'disqualified' => 'Diskvalifisert',
                'never_qualified' => 'Aldri Kvalifisert',
                'qualified' => 'Kvalifisert',
                'ranked' => 'Rangert',
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
        'unsaved' => '',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Logg inn for å svare',
            'user' => 'Svar',
        ],
    ],

    'review' => [
        'block_count' => '',
        'go_to_parent' => 'Vis Tilbakemeldingsinnlegg',
        'go_to_child' => 'Vis diskusjon',
        'validation' => [
            'block_too_large' => 'hver blokk kan bare inneholde opptil :limit tegn',
            'external_references' => 'gjennomgangen inneholder referanser til saker som ikke tilhører denne gjennomgangen',
            'invalid_block_type' => 'ugyldig blokktype',
            'invalid_document' => 'ugyldig anmeldelse',
            'invalid_discussion_type' => '',
            'minimum_issues' => 'anmeldelsen må minst inneholde et minimum av :count saker|anmeldelsen må minst inneholde et minimum av :count saker',
            'missing_text' => 'blokken mangler tekst',
            'too_many_blocks' => 'anmeldelser kan bare inneholde :count paragrafer/saker|anmeldelser kan bare inneholde opptill :count paragrafer/saker',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Merket som løst av :user',
            'false' => 'Gjenåpnet av :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'generelt',
        'general_all' => 'generelt (alt)',
    ],

    'user_filter' => [
        'everyone' => 'Alle',
        'label' => 'Filtrer etter bruker',
    ],
];
