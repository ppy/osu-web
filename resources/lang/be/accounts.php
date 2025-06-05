<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'налады',
        'username' => 'імя карыстальніка',

        'avatar' => [
            'title' => 'Аватар',
            'reset' => 'скінуць',
            'rules' => 'Калі ласка, упэўніцеся, што ваш аватар прытрымліваецца :link.<br/>Гэта значыць, што ён павінен<strong>падыходзіць для любога ўзросту</strong>, то-бок: ніякай галізны, лаянкі або задзірлівага змесціва.',
            'rules_link' => 'правіл супольнасці',
        ],

        'email' => [
            'new' => 'новая эл. пошта',
            'new_confirmation' => 'пацвярдзіце эл. пошту',
            'title' => 'Эл. пошта',
            'locked' => [
                '_' => 'Напішыце ў :accounts, калі хочаце змяніць адрас электроннай пошты.',
                'accounts' => '',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Стары API',
        ],

        'password' => [
            'current' => 'бягучы пароль',
            'new' => 'новы пароль',
            'new_confirmation' => 'пацвярдзіце пароль',
            'title' => 'Пароль',
        ],

        'profile' => [
            'country' => 'краіна',
            'title' => 'Профіль',

            'country_change' => [
                '_' => "Падобна на тое, што краіна акаўнту не супадае з вашым месцам пражывання. :update_link.",
                'update_link' => 'Змяніць на :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'бягучае месцазнаходжанне',
                'user_interests' => 'цікаўнасці',
                'user_occ' => 'занятак',
                'user_twitter' => '',
                'user_website' => 'вэб-сайт',
            ],
        ],

        'signature' => [
            'title' => 'Подпіс',
            'update' => 'абнавіць',
        ],
    ],

    'github_user' => [
        'info' => "Калі вы ўносіце ўклад у рэпазітар osu!, падлучэнне акаўнта GitHub дазволіць звязаць ваш нік у спісе змен з профілем osu!. Акаўнт GitHub без укладу ў osu! падлучыць нельга.",
        'link' => 'Падлучыць акаўнт GitHub',
        'title' => 'GitHub',
        'unlink' => 'Адвязаць уліковы запіс GitHub',

        'error' => [
            'already_linked' => 'Гэты ўліковы запіс GitHub ужо звязаны з іншым карыстальнікам.',
            'no_contribution' => 'Немагчыма звязаць уліковы запіс GitHub без гісторыі ўкладаў у рэпазітары osu!.',
            'unverified_email' => 'Калі ласка, пацвердзіце сваю асноўную электронную пошту на GitHub, потым паспрабуйце звязаць свой уліковы запіс яшчэ раз.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'атрымліваць апавяшчэнні аб новых праблемах кваліфікаваных карт наступных рэжымаў',
        'beatmapset_disqualify' => 'атрымліваць апавяшчэння, калі карты для наступных рэжымаў будуць діскваліфікаваны',
        'comment_reply' => 'атрымліваць апавяшчэнні аб адказах на каментарыі',
        'title' => 'Апавяшчэнні',
        'topic_auto_subscribe' => 'аўтаматычна ўключаць апавяшчэнні для вашых тэм з форума',

        'options' => [
            '_' => 'спосабы дастаўкі',
            'beatmap_owner_change' => 'гасцявая складанасць',
            'beatmapset:modding' => 'модынг карт',
            'channel_message' => 'асабістыя паведамленні',
            'channel_team' => '',
            'comment_new' => 'новыя каментарыі',
            'forum_topic_reply' => 'адказы да тэмы',
            'mail' => 'пошта',
            'mapping' => 'стваральнік карты',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'аўтарызаваныя кліенты',
        'own_clients' => 'свае кліенты',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'схаваць папярэджанні аб відавочным змесце ў картах',
        'beatmapset_title_show_original' => 'паказаць метададзеныя карты на мове арыгіналу',
        'title' => 'Налады',

        'beatmapset_download' => [
            '_' => 'тып загрузкі карт па змаўчанні',
            'all' => 'з відэа, калі даступна',
            'direct' => 'адкрыць у osu!direct',
            'no_video' => 'без відэа',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'клавіятура',
        'mouse' => 'мыш',
        'tablet' => 'планшэт',
        'title' => 'Стыль гульні',
        'touch' => 'сэнсарны экран',
    ],

    'privacy' => [
        'friends_only' => 'заблакаваць прыватныя паведамленні ад людзей не з вашага спісу сяброў',
        'hide_online' => 'схаваць анлайн прысутнасць',
        'title' => 'Прыватнасць',
    ],

    'security' => [
        'current_session' => 'бягучы',
        'end_session' => 'Скончыць сеанс',
        'end_session_confirmation' => 'Сеанс на гэтай прыладзе будзе неадкладна завершаны. Вы ўпэўнены?',
        'last_active' => 'Апошняя актыўнасць:',
        'title' => 'Бяспека',
        'web_sessions' => 'вэб-сесіі',
    ],

    'update_email' => [
        'update' => 'абнавіць',
    ],

    'update_password' => [
        'update' => 'абнавіць',
    ],

    'verification_completed' => [
        'text' => 'Цяпер вы можаце закрыць укладку/акно',
        'title' => 'Праверка завершана',
    ],

    'verification_invalid' => [
        'title' => 'Несапраўдная або пратэрмінаваная праверачная спасылка',
    ],
];
