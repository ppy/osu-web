<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'аккаунт параметрлері',
        'username' => 'пайдаланушы аты',

        'avatar' => [
            'title' => 'Аватар',
            'reset' => '',
            'rules' => 'Өтініш, аватарыңыз :link бойынша келуін қадағалаңыз.<br/>Ол <strong>барлық жастарға сай болуы керек</strong>, яғни жалаңаштық, бейпіл сөздер немесе ерсі контент болмауы тиіс.',
            'rules_link' => 'қауымдастық ережелері',
        ],

        'email' => [
            'new' => 'жаңа пошта',
            'new_confirmation' => 'email-ды растаңыз',
            'title' => 'Email',
            'locked' => [
                '_' => 'Поштаны өзгерту үшін :accounts-қа жазыңыз.',
                'accounts' => 'аккаунтты қолдау тобы',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Ескірген API',
        ],

        'password' => [
            'current' => 'қазіргі құпиясөз',
            'new' => 'жаңа құпиясөз',
            'new_confirmation' => 'құпиясөзді растаңыз',
            'title' => 'Құпиясөз',
        ],

        'profile' => [
            'country' => 'ел',
            'title' => 'Профиль',

            'country_change' => [
                '_' => "Сіздің аккаунтыңыздың елі мен сіздің тұрғылықты еліңіз сәйкес келмейтін сияқты. :update_link.",
                'update_link' => ':country еліне жаңарту',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'тұрғылықты жері',
                'user_interests' => 'қызығушылықтары',
                'user_occ' => 'мамандығы',
                'user_twitter' => '',
                'user_website' => 'веб-сайт',
            ],
        ],

        'signature' => [
            'title' => 'Қолы',
            'update' => 'жаңарту',
        ],
    ],

    'github_user' => [
        'info' => "",
        'link' => '',
        'title' => 'GitHub',
        'unlink' => '',

        'error' => [
            'already_linked' => '',
            'no_contribution' => '',
            'unverified_email' => '',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'келесі режимдердің білікті карталарындағы жаңа мәселелерге байланысты хабарландырулар алу',
        'beatmapset_disqualify' => 'келесі режимдердің карталары дисквалификацияланған жағдайда хабарландырулар алу',
        'comment_reply' => 'пікірлеріңіздің жауаптары туралы хабарландырулар алу',
        'news_post' => '',
        'title' => 'Хабарландырулар',
        'topic_auto_subscribe' => 'сіз құрған жаңа форум тақырыптарының хабарландыруларын автоматты түрде қосу',

        'options' => [
            '_' => 'алу әдістері',
            'beatmap_owner_change' => 'қонақтық қиындық',
            'beatmapset:modding' => 'карта модтау',
            'channel_message' => 'жеке хабарламалар',
            'channel_team' => '',
            'comment_new' => 'жаңа пікірлер',
            'forum_topic_reply' => 'тақырып жауабы',
            'mail' => 'email',
            'mapping' => 'карта маппері',
            'news_post' => '',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'авторландырылған клиенттер',
        'own_clients' => 'өз клиенттеріңіз',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_anime_cover' => '',
        'beatmapset_show_nsfw' => 'карталардағы ерсі контент ескертулерін жасыру',
        'beatmapset_title_show_original' => 'карта метадеректерін түпнұсқа тілінде көрсету',
        'title' => 'Баптаулар',

        'beatmapset_download' => [
            '_' => 'әдепкі карта жүктеу типі',
            'all' => 'видеомен, бар болған жағдайда',
            'direct' => 'osu!direct-те ашу',
            'no_video' => 'видеосыз',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'пернетақта',
        'mouse' => 'тышқан',
        'tablet' => 'графикалық планшет',
        'title' => 'Ойнау стильдері',
        'touch' => 'сенсорлы экран',
    ],

    'privacy' => [
        'friends_only' => 'достардан келмеген жеке хабарламаларды бұғаттау',
        'hide_online' => 'желіде екеніңізді жасыру',
        'hide_online_info' => '',
        'title' => 'Құпиялық',
    ],

    'security' => [
        'current_session' => 'қазіргі',
        'end_session' => 'Сессияны аяқтау',
        'end_session_confirmation' => 'Осы құрылғыдағы сеанс бірден аяқталады. Сіз сенімдісіз ме?',
        'last_active' => 'Соңғы белсенділік:',
        'title' => 'Қауіпсіздік',
        'web_sessions' => 'веб-сессиялар',
    ],

    'update_email' => [
        'update' => 'жаңарту',
    ],

    'update_password' => [
        'update' => 'жаңарту',
    ],

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => 'Енді бетбелгіні/терезені жаба аласыз',
        'title' => 'Верификациялау аяқталды',
    ],

    'verification_invalid' => [
        'title' => 'Қате немесе ескірген верификация сілтемесі',
    ],
];
