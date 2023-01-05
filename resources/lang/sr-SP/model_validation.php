<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Неважећи :attribute наведен.',
    'not_negative' => ':attribute не може бити негативан.',
    'required' => ':attribute је обавезан.',
    'too_long' => ':attribute је премашио максималну дужину - може имати највише :limit знакова.',
    'wrong_confirmation' => 'Потврда се не подудара.
',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Временска ознака је присутна али тежина мапе није дефинисана.',
        'beatmapset_no_hype' => "Ова мапа не може бити \"хајпована\".",
        'hype_requires_null_beatmap' => '"Хајповање" мора бити одрађено у Генералној (све тежине) секцији.',
        'invalid_beatmap_id' => 'Неважећа тежина је наведена.',
        'invalid_beatmapset_id' => 'Неисправна мапа је наведена.',
        'locked' => 'Дискусија је закључана.',

        'attributes' => [
            'message_type' => 'Врсте порука',
            'timestamp' => 'Временска ознака',
        ],

        'hype' => [
            'discussion_locked' => "Ова мапа је тренутно закључана за дискусију и не може бити хајпована",
            'guest' => 'Морате бити пријављени да би сте могли да хајпујете.',
            'hyped' => 'Већ сте "хајповали" ову мапу.',
            'limit_exceeded' => 'Искористили сте све Ваше "хајпове".',
            'not_hypeable' => 'Ова мапа не може бити "хајпована"',
            'owner' => 'Не можете "хајповати" Вашу мапу.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Наведена временска ознака је изван дужине мапе.',
            'negative' => "Временска ознака не може бити негативна вредност.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Дискусија је закључана.',
        'first_post' => 'Не можете обрисати почетну објаву.',

        'attributes' => [
            'message' => 'Порука',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Одговарање на обрисан коментар није дозвољено.',
        'top_only' => 'Одговарање на прикачен коментар није дозвољено.',

        'attributes' => [
            'message' => 'Порука',
        ],
    ],

    'follow' => [
        'invalid' => 'Неважећи :attribute наведен.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Можете гласати само за нове додатке.',
            'not_enough_feature_votes' => 'Немате довољно гласова.',
        ],

        'poll_vote' => [
            'invalid' => 'Изабрали сте неисправну опцију.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Брисање објаве која садржи метаподатке мапе није дозвољено.',
            'beatmapset_post_no_edit' => 'Измена објаве која садржи метаподатке мапе није дозвољено.',
            'first_post_no_delete' => 'Не можете обрисати почетну објаву',
            'missing_topic' => 'Објава не садржи тему',
            'only_quote' => 'Ваш одговор садржи само цитат.',

            'attributes' => [
                'post_text' => 'Тело објаве',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Наслов теме',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Опција дуплирања није дозвољена.',
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
