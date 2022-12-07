<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => '',
    'not_negative' => '',
    'required' => '',
    'too_long' => '',
    'wrong_confirmation' => '',

    'beatmapset_discussion' => [
        'beatmap_missing' => '',
        'beatmapset_no_hype' => "",
        'hype_requires_null_beatmap' => 'El hype s\'ha de fer a la secció General (totes les dificultats).',
        'invalid_beatmap_id' => '',
        'invalid_beatmapset_id' => '',
        'locked' => '',

        'attributes' => [
            'message_type' => '',
            'timestamp' => '',
        ],

        'hype' => [
            'discussion_locked' => "",
            'guest' => '',
            'hyped' => '',
            'limit_exceeded' => 'Ja has fet servir tots els teus hype.',
            'not_hypeable' => '',
            'owner' => '',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '',
            'negative' => "",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => '',
        'first_post' => 'No es pot eliminar la publicació inicial.',

        'attributes' => [
            'message' => 'El missatge',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Respondre a un comentari suprimit no està permès.',
        'top_only' => 'Ancorar la resposta d\'un comentari no és permès.',

        'attributes' => [
            'message' => '',
        ],
    ],

    'follow' => [
        'invalid' => '',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '',
            'not_enough_feature_votes' => '',
        ],

        'poll_vote' => [
            'invalid' => '',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Eliminar la publicació de les metadades del beatmap no està permès.',
            'beatmapset_post_no_edit' => 'Editar la publicación de los metadatos del beatmap no está permitido.',
            'first_post_no_delete' => 'No es pot eliminar la publicació inicial',
            'missing_topic' => '',
            'only_quote' => '',

            'attributes' => [
                'post_text' => '',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => '',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opcions duplicades no permeses.',
            'grace_period_expired' => '',
            'hiding_results_forever' => 'No es poden amagar els resultats d\'una enquesta que mai no finalitza.',
            'invalid_max_options' => '',
            'minimum_one_selection' => '',
            'minimum_two_options' => '',
            'too_many_options' => 'Nombre d\'opcions permeses excedides.',

            'attributes' => [
                'title' => '',
            ],
        ],

        'topic_vote' => [
            'required' => '',
            'too_many' => 'Seleccionades més opcions de les permeses.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Va excedir el nombre màxim d\'aplicacions OAuth permeses.',
            'url' => '',

            'attributes' => [
                'name' => '',
                'redirect' => 'URL de trucada d\'Aplicació',
            ],
        ],
    ],

    'user' => [
        'contains_username' => '',
        'email_already_used' => '',
        'email_not_allowed' => 'Adreça de correu no permesa.',
        'invalid_country' => '',
        'invalid_discord' => '',
        'invalid_email' => "",
        'invalid_twitter' => '',
        'too_short' => '',
        'unknown_duplicate' => '',
        'username_available_in' => '',
        'username_available_soon' => '',
        'username_invalid_characters' => '',
        'username_in_use' => '',
        'username_locked' => '', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => '',
        'username_no_spaces' => "",
        'username_not_allowed' => 'Aquesta elecció de nom dusuari no està permesa.',
        'username_too_short' => '',
        'username_too_long' => '',
        'weak' => '',
        'wrong_current_password' => '',
        'wrong_email_confirmation' => '',
        'wrong_password_confirmation' => '',
        'too_long' => '',

        'attributes' => [
            'username' => 'Nom d\'usuari',
            'user_email' => 'Correu electrònic',
            'password' => 'Contrasenya',
        ],

        'change_username' => [
            'restricted' => '',
            'supporter_required' => [
                '_' => '',
                'link_text' => '',
            ],
            'username_is_same' => '',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => '',
        'self' => "",
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
