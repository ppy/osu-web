<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'подешавања налога',
        'username' => 'корисничко име',

        'avatar' => [
            'title' => 'Аватар',
            'reset' => 'ресетуј',
            'rules' => 'Молимо Вас да ваш аватар поштује :link. <br/> То значи да мора бити <strong>сутабилан за људе свих узраста</strong>. Аватари не смеју садржати голотињу, псовке и сугестиван садржај.',
            'rules_link' => 'правила заједнице',
        ],

        'email' => [
            'new' => 'нови имејл',
            'new_confirmation' => 'потврда имејл адресе',
            'title' => 'Имејл',
            'locked' => [
                '_' => 'Molimo kontaktirajte :accounts ukoliko treba da ažurirate Vašu imejl adresu.',
                'accounts' => 'тим за подршку налога',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Застарели API',
        ],

        'password' => [
            'current' => 'тренутна лозинка',
            'new' => 'нова лозинка',
            'new_confirmation' => 'потврда лозинке',
            'title' => 'Лозинка',
        ],

        'profile' => [
            'country' => 'држава',
            'title' => 'Профил',

            'country_change' => [
                '_' => "Изгледа да земља вашег налога не одговара вашој земљи пребивалишта. :update_link.",
                'update_link' => 'Промените у :country',
            ],

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

    'github_user' => [
        'info' => "",
        'link' => 'Повежи GitHub Налог',
        'title' => 'GitHub',
        'unlink' => 'Отклони везу GitHub Налога',

        'error' => [
            'already_linked' => 'Овај GitHub налог је већ тренутно повезан са другим налогом.',
            'no_contribution' => '',
            'unverified_email' => '',
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
            'beatmap_owner_change' => 'гостојућа тежина',
            'beatmapset:modding' => 'модовање мапа',
            'channel_message' => 'приватне чет поруке',
            'comment_new' => 'нови коментари',
            'forum_topic_reply' => 'одговор на тему',
            'mail' => 'пошта',
            'mapping' => 'креатор мапе',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'ауторизовани клијенти',
        'own_clients' => 'сопствени клијенти',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'сакриј упозорења за експлицитан садржај у мапама',
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
        'hide_online' => 'сакријте свој онлајн статус',
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
        'title' => 'Верификација је успешна',
    ],

    'verification_invalid' => [
        'title' => 'Неважећи или истекнут линк за верификацију',
    ],
];
