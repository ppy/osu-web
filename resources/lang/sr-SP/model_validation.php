<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Неважећи :attribute наведено.',
    'not_negative' => ':attribute не може бити негативан.',
    'required' => ':attribute је обавезан.',
    'too_long' => ':attribute је премашио максималну дужину - може имати највише :limit знакова.',
    'wrong_confirmation' => 'Потврда се не подудара.
',

    'beatmapset_discussion' => [
        'beatmap_missing' => '',
        'beatmapset_no_hype' => "",
        'hype_requires_null_beatmap' => '',
        'invalid_beatmap_id' => '',
        'invalid_beatmapset_id' => '',
        'locked' => 'Дискусија је закључана.',

        'attributes' => [
            'message_type' => '',
            'timestamp' => 'Временска ознака',
        ],

        'hype' => [
            'discussion_locked' => "Ова мапа је тренутно закључана за дискусију и не може бити хајпована",
            'guest' => 'Морате бити пријављени да би сте могли да хајпујете.',
            'hyped' => '',
            'limit_exceeded' => '',
            'not_hypeable' => '',
            'owner' => '',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '',
            'negative' => "",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Дискусија је закључана.',
        'first_post' => '',

        'attributes' => [
            'message' => '',
        ],
    ],

    'comment' => [
        'deleted_parent' => '',
        'top_only' => '',

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
            'beatmapset_post_no_delete' => '',
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
                'topic_title' => 'Наслов теме',
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
            'url' => 'Молимо да унесете важећи URL.',

            'attributes' => [
                'name' => '',
                'redirect' => '',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Лозинка не сме да садржи корисничко име.',
        'email_already_used' => 'Адреса е-поште је већ коришћена.',
        'email_not_allowed' => 'Адреса е-поште није дозвољена.',
        'invalid_country' => 'Држава није у бази података.',
        'invalid_discord' => 'Discord корисничко име је неважеће.',
        'invalid_email' => "Изгледа да није важећа адреса е-поште.",
        'invalid_twitter' => 'Twitter корисничко име је неважеће.',
        'too_short' => 'Нова лозинка је превише кратка.',
        'unknown_duplicate' => 'Корисничко име или адреса е-поште су већ коришћени.',
        'username_available_in' => 'Ово корисничко име ће бити доступно за употребу за :duration.',
        'username_available_soon' => 'Ово корисничко име ће бити доступно за коришћење сваког тренутка!',
        'username_invalid_characters' => 'Захтевано корисничко име садржи неважеће знакове.',
        'username_in_use' => 'Корисничко име је већ у употреби!',
        'username_locked' => 'Корисничко име је већ у употреби!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Молимо користите доње црте или размаке, а не обоје!',
        'username_no_spaces' => "Корисничко име не може да почиње нити да се завршава размацима!",
        'username_not_allowed' => 'Овај избор корисничког имена није дозвољен.',
        'username_too_short' => 'Тражено корисничко име је прекратко.',
        'username_too_long' => 'Захтевано корисничко име је предугачко.',
        'weak' => 'Лозинка на црној листи.',
        'wrong_current_password' => 'Тренутна лозинка је нетачна.',
        'wrong_email_confirmation' => 'Потврда е-поште се не подудара.',
        'wrong_password_confirmation' => 'Потврда лозинке се не подудара.',
        'too_long' => 'Прекорачена максимална дужина - може да садржи највише :limit знакова.',

        'attributes' => [
            'username' => 'Корисничко име',
            'user_email' => 'Адреса е-поште',
            'password' => 'Лозинка',
        ],

        'change_username' => [
            'restricted' => 'Не можете променити своје корисничко име док сте ограничени.
',
            'supporter_required' => [
                '_' => 'Морате имати :link да бисте променили име!',
                'link_text' => 'подржан osu!',
            ],
            'username_is_same' => 'Ово је већ твоје корисничко име, будало!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Није могуће пријавити рангиране мапе',
        'reason_not_valid' => ':reason није важећи за овај тип извештаја.',
        'self' => "Не можете сами да се пријавите!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Количина',
                'cost' => 'Цена',
            ],
        ],
    ],
];
