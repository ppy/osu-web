<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => '',
    'not_negative' => ':attribute nevar būt negatīvs.',
    'required' => ':attribute ir nepieciešams.',
    'too_long' => ':attribute pārsniedza maksimālo garumu - drīkts būt tikai līdz :limit zīmēm.',
    'wrong_confirmation' => 'Apstiprinājums nesakrīt.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Laika skala ir norādīta, bet trūkst bītmapes.',
        'beatmapset_no_hype' => "Bītmapi nevar publicizēt.",
        'hype_requires_null_beatmap' => 'Publikācija ir jāuzstāda Galvenajā (visu sarežģītību) sadaļā.',
        'invalid_beatmap_id' => 'Nederīgs sarežģījums norādīts.',
        'invalid_beatmapset_id' => 'Nederīga bītmape norādīta.',
        'locked' => 'Diskusija ir slēgta.',

        'attributes' => [
            'message_type' => 'Ziņojuma tips',
            'timestamp' => 'Laika josla',
        ],

        'hype' => [
            'discussion_locked' => "",
            'guest' => 'Ir jāielogojas, lai publicizētu.',
            'hyped' => 'Tu jau esi publicizējis šo bītmapi.',
            'limit_exceeded' => 'Tu esi izmantojis visus savus publicizējumus.',
            'not_hypeable' => 'Šo bītmapi nevari publicizēt',
            'owner' => 'Nevar publicizēt savu bītmapi.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Norādītā laika josla ir pārsniegusi bītmapes garumu.',
            'negative' => "Laika josla nevar būt negatīva.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => '',
        'first_post' => '',

        'attributes' => [
            'message' => '',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Atbildēšana uz izdzēstu komentāru nav atļauta.',
        'top_only' => '',

        'attributes' => [
            'message' => 'Ziņa',
        ],
    ],

    'follow' => [
        'invalid' => 'Nederīgs:attribute norādīts.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Var tikai balsot iezīmētu pieprasījumu.',
            'not_enough_feature_votes' => 'Nav pietiekami daudz balsu.',
        ],

        'poll_vote' => [
            'invalid' => 'Nederīga opcija norādīta.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Nav atļauts izdzēst bītmapes metadatu rakstu.',
            'beatmapset_post_no_edit' => '',
            'first_post_no_delete' => '',
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
            'duplicate_options' => '',
            'grace_period_expired' => '',
            'hiding_results_forever' => '',
            'invalid_max_options' => '',
            'minimum_one_selection' => '',
            'minimum_two_options' => '',
            'too_many_options' => '',

            'attributes' => [
                'title' => '',
            ],
        ],

        'topic_vote' => [
            'required' => '',
            'too_many' => '',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '',
            'url' => '',

            'attributes' => [
                'name' => '',
                'redirect' => '',
            ],
        ],
    ],

    'user' => [
        'contains_username' => '',
        'email_already_used' => '',
        'email_not_allowed' => '',
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
        'username_not_allowed' => '',
        'username_too_short' => '',
        'username_too_long' => '',
        'weak' => '',
        'wrong_current_password' => '',
        'wrong_email_confirmation' => '',
        'wrong_password_confirmation' => '',
        'too_long' => '',

        'attributes' => [
            'username' => '',
            'user_email' => '',
            'password' => '',
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
                'quantity' => '',
                'cost' => '',
            ],
        ],
    ],
];
