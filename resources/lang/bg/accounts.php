<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'настройки',
        'username' => 'потребителско име',

        'avatar' => [
            'title' => 'Аватар',
            'reset' => 'нулиране',
            'rules' => 'Моля, уверете се, че вашият аватар се придържда към :link.<br/>Това означава, че задължително трябва да бъде <strong>подходящ за всички възрасти</strong>. т.е. няма голота, ругатни или внушаващо съдържание.',
            'rules_link' => 'обществените правила',
        ],

        'email' => [
            'new' => 'нов имейл',
            'new_confirmation' => 'потвърди нов имейл',
            'title' => 'Имейл',
            'locked' => [
                '_' => 'Моля, свържете се с :accounts за обновяване не имейл.',
                'accounts' => 'екипа за поддръжка на профили',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Наследен API',
        ],

        'password' => [
            'current' => 'текуща парола',
            'new' => 'нова парола',
            'new_confirmation' => 'потвърди нова парола',
            'title' => 'Парола',
        ],

        'profile' => [
            'country' => 'държава',
            'title' => 'Профил',

            'country_change' => [
                '_' => "Изглежда че държавата на профила не съвпада с текущата ви държава. :update_link.",
                'update_link' => 'Променете на :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'настоящо местонахождение',
                'user_interests' => 'интереси',
                'user_occ' => 'работа/занимание',
                'user_twitter' => '',
                'user_website' => 'уебсайт',
            ],
        ],

        'signature' => [
            'title' => 'Подпис',
            'update' => 'обнови',
        ],
    ],

    'github_user' => [
        'info' => "Ако сте сътрудник в хранилищата с отворен код на osu!, свързването на вашия GitHub профил ще асоцира приносите ви от списъка с промени към вашия osu! профил. GitHub профилите без история за допринасяне към osu! не могат да бъдат свързани.",
        'link' => 'Свържете GitHub профил',
        'title' => 'GitHub',
        'unlink' => 'Премахнете GitHub профил',

        'error' => [
            'already_linked' => 'Този GitHub профил е свързан към друг потребител.',
            'no_contribution' => 'Не може да добавите GitHub профил без никакъв принос в osu! хранилищата.',
            'unverified_email' => 'Потвърдете основния ви имейл в GitHub, след това опитайте да свържете профила отново.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'показване на известие при нов проблем с квалифициран бийтмап от следните видове игра:',
        'beatmapset_disqualify' => 'показване на известие, когато бийтмап от следните видове игра е дисквалифициран:',
        'comment_reply' => 'показване на известие при отговор към мой коментар',
        'news_post' => '',
        'title' => 'Известия',
        'topic_auto_subscribe' => 'автоматично активиране на известията за всяка новосъздадена от мен форумна тема',

        'options' => [
            '_' => 'опции за доставка',
            'beatmap_owner_change' => 'бийтмап трудност',
            'beatmapset:modding' => 'бийтмап редактор',
            'channel_message' => 'лично съобщение',
            'channel_team' => 'отборни съобщения',
            'comment_new' => 'нов коментар',
            'forum_topic_reply' => 'отговор на тема',
            'mail' => 'поща',
            'mapping' => 'бийтмап създател',
            'news_post' => '',
            'push' => 'сайт',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'оторизирани клиенти',
        'own_clients' => 'собствени клиенти',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'скриване на предупрежденията за бийтмапове с Explicit съдържание',
        'beatmapset_title_show_original' => 'показване на бийтмап метаданните с оригиналния им език',
        'title' => 'Hастройки',

        'beatmapset_download' => [
            '_' => 'бийтмаповете да се изтеглят:',
            'all' => 'с видео при наличност',
            'direct' => 'отваряне в osu!direct',
            'no_video' => 'без видео',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'клавиатура',
        'mouse' => 'мишка',
        'tablet' => 'таблет',
        'title' => 'Стил на игра',
        'touch' => 'сензорен екран',
    ],

    'privacy' => [
        'friends_only' => 'блокиране на лични съобщения от хора, които не са ми приятели',
        'hide_online' => 'скриване на моето онлайн присъствие',
        'hide_online_info' => '',
        'title' => 'Поверителност',
    ],

    'security' => [
        'current_session' => 'текуща',
        'end_session' => 'Прекрати сесия',
        'end_session_confirmation' => 'Това незабавно ще прекрати сесията на съответното устройство. Сигурни ли сте?',
        'last_active' => 'Последна активност:',
        'title' => 'Сигурност',
        'web_sessions' => 'уеб сесии',
    ],

    'update_email' => [
        'update' => 'обнови',
    ],

    'update_password' => [
        'update' => 'обнови',
    ],

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => 'Премахни',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => 'Не конфигурирано',
            'set' => 'Конфигурирано',
        ],
    ],

    'verification_completed' => [
        'text' => 'Може вече да затворите този раздел',
        'title' => 'Проверката на потребителя е завършена',
    ],

    'verification_invalid' => [
        'title' => 'Невалидна или изтекла връзка за потвърждение',
    ],
];
