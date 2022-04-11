<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'подешавања налога',
        'username' => 'корисничко име',

        'avatar' => [
            'title' => 'Аватар',
            'rules' => 'Молимо вас да ваш аватар поштује :link. <br/> То значи да мора бити <strong>сутабилан за људе свих узраста</strong>. Аватари не смеју садржати голотињу, псовке и сугестиван садржај.',
            'rules_link' => 'правила заједнице',
        ],

        'email' => [
            'current' => 'тренутни имејл',
            'new' => 'нови имејл',
            'new_confirmation' => 'потврда имејл адресе',
            'title' => 'Имејл',
        ],

        'password' => [
            'current' => 'тренутна лозинка',
            'new' => 'нова лозинка',
            'new_confirmation' => 'потврда лозинке',
            'title' => 'Лозинка',
        ],

        'profile' => [
            'title' => 'Профил',

            'user' => [
                'user_discord' => '',
                'user_from' => 'тренутна локација',
                'user_interests' => 'интереси',
                'user_occ' => 'занимање',
                'user_twitter' => '',
                'user_website' => 'вебсајт',
            ],
        ],

        'signature' => [
            'title' => 'Потпис',
            'update' => 'ажурирај',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'примајте обавештења за нове проблеме на квалификованим мапама следећих модова',
        'beatmapset_disqualify' => 'примајте обавештења када мапе од следећих модова су дисквалификоване',
        'comment_reply' => 'примајте обавештења за одговоре на ваше коментаре',
        'title' => 'Обавештења',
        'topic_auto_subscribe' => 'аутоматски укључите обавештења за теме које сте направили на форуму',

        'options' => [
            '_' => 'метода слања',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'модовање мапа',
            'channel_message' => 'приватне чет поруке',
            'comment_new' => 'нови коментари',
            'forum_topic_reply' => 'одговор на тему',
            'mail' => 'пошта',
            'mapping' => '',
            'push' => 'push',
            'user_achievement_unlock' => 'корисничка медаља откључана',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'ауторизовани клијенти',
        'own_clients' => 'сопствени клијенти',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => '',
        'beatmapset_title_show_original' => 'покажи метаподатке ове мапе на оригиналном језику',
        'title' => 'Опције',

        'beatmapset_download' => [
            '_' => 'преферирани начин за скидање мапа',
            'all' => 'са видео клипом ако је доступан',
            'direct' => 'отвори у osu!direct',
            'no_video' => 'без видео клипа',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'тастатура',
        'mouse' => 'миш',
        'tablet' => 'таблет',
        'title' => 'Начин игре',
        'touch' => 'екран на додир',
    ],

    'privacy' => [
        'friends_only' => 'блокирајте приватне поруке од корисника који нису на вашој листи пријатеља',
        'hide_online' => 'сакријте свој статус',
        'title' => 'Приватност',
    ],

    'security' => [
        'current_session' => 'актуелна',
        'end_session' => 'Заврши сесију',
        'end_session_confirmation' => 'Ово ће завршити вашу сесију на изабраном уређају. Да ли сте сигурни?',
        'last_active' => 'Последњи пут активан/на:',
        'title' => 'Безбедност',
        'web_sessions' => 'интернет сесија',
    ],

    'update_email' => [
        'update' => 'ажурирај',
    ],

    'update_password' => [
        'update' => 'ажурирај',
    ],

    'verification_completed' => [
        'text' => 'Сада можете затворити овај прозор',
        'title' => 'Верификација  је успешна',
    ],

    'verification_invalid' => [
        'title' => 'Не важећи или истекнут линк за верификацију',
    ],
];
