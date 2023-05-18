<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Heu d\'iniciar sessió per editar.',
            'system_generated' => 'No es pot editar una publicació generada pel sistema.',
            'wrong_user' => 'Has de ser el propietari de la publicació per editar-la.',
        ],
    ],

    'events' => [
        'empty' => 'No ha passat res... encara.',
    ],

    'index' => [
        'deleted_beatmap' => 'eliminat',
        'none_found' => 'No s\'ha trobat cap discussió que coincideixi amb aquests criteris de cerca.',
        'title' => 'Discussions del beatmap',

        'form' => [
            '_' => 'Cerca',
            'deleted' => 'Inclou discussions eliminades',
            'mode' => 'Mode del beatmap',
            'only_unresolved' => 'Mostra només discussions no resoltes',
            'types' => 'Tipus de missatges',
            'username' => 'Nom d\'usuari',

            'beatmapset_status' => [
                '_' => 'Estat del beatmap',
                'all' => 'Tots',
                'disqualified' => 'Desqualificat',
                'never_qualified' => 'Mai qualificat',
                'qualified' => 'Qualificat',
                'ranked' => 'Classificat',
            ],

            'user' => [
                'label' => 'Usuari',
                'overview' => 'Resum d\'activitats',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data de publicació',
        'deleted_at' => 'Data d\'eliminació',
        'message_type' => 'Tipus',
        'permalink' => 'Enllaç permanent',
    ],

    'nearby_posts' => [
        'confirm' => 'Cap de les publicacions aborda el meu assumpte',
        'notice' => 'Ja hi ha publicacions a prop de :timestamp (:existing_timestamps). Si us plau reviseu-les abans de publicar.',
        'unsaved' => ':count en aquesta revisió',
    ],

    'owner_editor' => [
        'button' => 'Propietari de la dificultat',
        'reset_confirm' => 'Restablir propietari per a aquesta dificultat?',
        'user' => 'Propietari',
        'version' => 'Dificultat',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Inicia sessió per respondre',
            'user' => 'Respondre',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blocs utilitzats',
        'go_to_parent' => 'Veure publicació de revisió',
        'go_to_child' => 'Veure discussió',
        'validation' => [
            'block_too_large' => 'cada bloc només pot contenir fins a :limit caràcters',
            'external_references' => 'la revisió conté referències a problemes que no pertanyen a aquesta revisió',
            'invalid_block_type' => 'tipus de bloc no vàlid',
            'invalid_document' => 'revisió no vàlida',
            'invalid_discussion_type' => 'tipus de discussió no vàlida',
            'minimum_issues' => 'la revisió ha de contenir un mínim de :count problema|la revisió ha de contenir un mínim de :count problemes',
            'missing_text' => 'falta text al bloc',
            'too_many_blocks' => 'les revisions només poden contenir :count paràgraf/problema|les revisions només poden contenir fins a :count paràgrafs/problemes',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marcat com a resolt per :user',
            'false' => 'Reobert per :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'general',
        'general_all' => 'general (tot)',
    ],

    'user_filter' => [
        'everyone' => 'Tothom',
        'label' => 'Filtra per usuari',
    ],
];
