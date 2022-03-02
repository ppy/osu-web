<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'настройки',
        'username' => 'потребителско име',

        'avatar' => [
            'title' => 'Аватар',
            'rules' => 'Моля уверете се, че вашият аватар се придържда към :link.<br/>Това означава, че задължително трябва да бъде <strong>подходящ за всички възрасти</strong>. т.е. няма голота, ругатни или внушаващо съдържание.',
            'rules_link' => 'обществените правила',
        ],

        'email' => [
            'current' => 'текущ имейл',
            'new' => 'нов имейл',
            'new_confirmation' => 'потвърди нов имейл',
            'title' => 'Имейл',
        ],

        'password' => [
            'current' => 'текуща парола',
            'new' => 'нова парола',
            'new_confirmation' => 'потвърди нова парола',
            'title' => 'Парола',
        ],

        'profile' => [
            'title' => 'Профил',

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

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'показване на известие при нов проблем с квалифициран бийтмап от следните видове игра:',
        'beatmapset_disqualify' => 'показване на известие, когато бийтмап от следните видове игра е дисквалифициран:',
        'comment_reply' => 'показване на известие при отговор към мой коментар',
        'title' => 'Известия',
        'topic_auto_subscribe' => 'автоматично активиране на известията за всяка новосъздадена от мен форумна тема',

        'options' => [
            '_' => 'опции за доставка',
            'beatmap_owner_change' => 'бийтмап трудност',
            'beatmapset:modding' => 'бийтмап редактор',
            'channel_message' => 'лично съобщение',
            'comment_new' => 'нов коментар',
            'forum_topic_reply' => 'отговор на тема',
            'mail' => 'поща',
            'mapping' => 'бийтмап създател',
            'push' => 'сайт',
            'user_achievement_unlock' => 'нов отключен медал',
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

    'verification_completed' => [
        'text' => 'Може вече да затворите този раздел',
        'title' => 'Проверката на потребителя е завършена',
    ],

    'verification_invalid' => [
        'title' => 'Невалидна или изтекла връзка за потвърждение',
    ],
];
