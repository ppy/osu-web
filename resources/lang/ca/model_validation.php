<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute no vàlid/a.',
    'not_negative' => ':attribute no pot ser negatiu.',
    'required' => ':attribute és requerit.',
    'too_long' => ':attribute ha excedit el límit de caràcters (màxim :limit).',
    'url' => '',
    'wrong_confirmation' => 'La confirmació no coincideix.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'La marca de temps s\'ha especificat però falta la dificultat del beatmap. ',
        'beatmapset_no_hype' => "El beatmap no pot ser hypejat.",
        'hype_requires_null_beatmap' => 'El hype s\'ha de fer a la secció General (totes les dificultats).',
        'invalid_beatmap_id' => 'Dificultat no vàlida.',
        'invalid_beatmapset_id' => 'Beatmap no vàlid.',
        'locked' => 'La discussió està tancada.',

        'attributes' => [
            'message_type' => 'Tipus de missatge',
            'timestamp' => 'Marca de temps',
        ],

        'hype' => [
            'discussion_locked' => "Aquest beatmap està tancat per discussió i no es pot hypejar",
            'guest' => 'Has d\'haver iniciat la sessió per hypejar.',
            'hyped' => 'Ja has hypejat aquest beatmap.',
            'limit_exceeded' => 'Ja has fet servir tots els teus hype.',
            'not_hypeable' => 'No es pot hypejar aquest beatmap',
            'owner' => 'No pots hypejar el teu propi beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'La marca de temps està fora de la llargada del beatmap.',
            'negative' => "La marca de temps no pot ser negativa.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'La discussió està tancada.',
        'first_post' => 'No es pot eliminar la publicació inicial.',

        'attributes' => [
            'message' => 'El missatge',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Respondre a un comentari suprimit no està permès.',
        'top_only' => 'Ancorar la resposta d\'un comentari no és permès.',

        'attributes' => [
            'message' => 'El missatge',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute no vàlid/a.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Només pots votar una sola sol·licitud de funcionalitats.',
            'not_enough_feature_votes' => 'No hi ha vots suficients.',
        ],

        'poll_vote' => [
            'invalid' => 'Opció no vàlida.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Eliminar la publicació de les metadades del beatmap no està permès.',
            'beatmapset_post_no_edit' => 'Editar la publicación de los metadatos del beatmap no está permitido.',
            'first_post_no_delete' => 'No es pot eliminar la publicació inicial',
            'missing_topic' => 'A la publicació li falta un tema',
            'only_quote' => 'La teva resposta conté una cita.',

            'attributes' => [
                'post_text' => 'Cos de la publicació',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Títol del tema',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opcions duplicades no permeses.',
            'grace_period_expired' => 'No pots editar una enquesta després de :limit hours.',
            'hiding_results_forever' => 'No es poden amagar els resultats d\'una enquesta que mai no finalitza.',
            'invalid_max_options' => 'Les opcions per usuari no poden excedir el nombre total d\'opcions.',
            'minimum_one_selection' => 'Es requereix un mínim d\'una opció per usuari.',
            'minimum_two_options' => 'Es necessiten dues opcions com a mínim. ',
            'too_many_options' => 'Nombre d\'opcions permeses excedides.',

            'attributes' => [
                'title' => 'Títol de l\'enquesta',
            ],
        ],

        'topic_vote' => [
            'required' => 'Selecciona una opció per votar.',
            'too_many' => 'Seleccionades més opcions de les permeses.',
        ],
    ],

    'legacy_api_key' => [
        'exists' => '',
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Va excedir el nombre màxim d\'aplicacions OAuth permeses.',
            'url' => 'Sisplau, escriu una URL vàlida.',

            'attributes' => [
                'name' => 'Nom de la sol·licitud',
                'redirect' => 'URL de trucada d\'Aplicació',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'La contrasenya no pot contenir el nom d\'usuari.',
        'email_already_used' => 'Ja existeix un compte amb aquesta adreça de correu.',
        'email_not_allowed' => 'Adreça de correu no permesa.',
        'invalid_country' => 'El país no està llistat a la base de dades.',
        'invalid_discord' => 'El nom d\'usuari de Discord no és vàlid.',
        'invalid_email' => "No sembla que sigui una adreça de correu vàlida.",
        'invalid_twitter' => 'El nom d\'usuari de Twitter no és vàlid.',
        'too_short' => 'La nova contrasenya és massa curta.',
        'unknown_duplicate' => 'El nom d\'usuari o adreça ja existeixen.',
        'username_available_in' => 'Aquest nom d\'usuari estarà disponible en :duration.',
        'username_available_soon' => 'Aquest nom d\'usuari estarà disponible en no-res!',
        'username_invalid_characters' => 'El nom d\'usuari conté caràcters no vàlids.',
        'username_in_use' => 'El nom d\'usuari ja està en ús!',
        'username_locked' => 'El nom d\'usuari ja està en ús!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Fes servir espais o barres baixes, però no els dos alhora!',
        'username_no_spaces' => "El nom d'usuari no pot començar o acabar amb espais!",
        'username_not_allowed' => 'Aquesta elecció de nom dusuari no està permesa.',
        'username_too_short' => 'El nom d\'usuari és massa curt.',
        'username_too_long' => 'El nom d\'usuari és massa llarg.',
        'weak' => 'La contrasenya és dèbil.',
        'wrong_current_password' => 'La contrasenya actual és incorrecta.',
        'wrong_email_confirmation' => 'La confirmació del correu no coincideix.',
        'wrong_password_confirmation' => 'La confirmació de contrasenya no coincideix.',
        'too_long' => 'S\'ha excedit el límit de caràcters (màxim :limit).',

        'attributes' => [
            'username' => 'Nom d\'usuari',
            'user_email' => 'Correu electrònic',
            'password' => 'Contrasenya',
        ],

        'change_username' => [
            'restricted' => 'No pots canviar el nom d\'usuari mentre estàs restringit.',
            'supporter_required' => [
                '_' => 'Has de tenir un :link per canviar el teu nom!',
                'link_text' => 'he donat suport a l\'osu!',
            ],
            'username_is_same' => 'Aquest ja és el teu nom d\'usuari, ruc!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Els beatmaps classificatoris no es poden denunciar',
        'reason_not_valid' => ':reason no és vàlida per aquest tipus d\'informe.',
        'self' => "No et pots denunciar a tu mateix!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Quantitat',
                'cost' => 'Preu',
            ],
        ],
    ],
];
