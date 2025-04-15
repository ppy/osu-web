<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'А може, пограємо трішки в osu! натомість?',
    'require_login' => 'Увійдіть до акаунту, щоб продовжити.',
    'require_verification' => 'Будь ласка, пройдіть перевірку для продовження.',
    'restricted' => "Не можна це робити поки ваші права обмежені.",
    'silenced' => "Не можна робити це поки ви заглушені.",
    'unauthorized' => 'В доступі відмовлено.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Не можна відмінити хайп.',
            'has_reply' => 'Не можна видалити дискусію з відповідями',
        ],
        'nominate' => [
            'exhausted' => 'Ви досягли ліміту номінацій за день, спробуйте завтра.',
            'incorrect_state' => 'Помилка під час виконання цієї дії, спробуйте оновити сторінку.',
            'owner' => "Неможливо номінувати власну ж карту.",
            'set_metadata' => 'Ви повинні вказати жанр та мову перед номінацією.',
        ],
        'resolve' => [
            'not_owner' => 'Лише автор теми та власник мапи може позначити обговорення як "Вирішено".',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Лише власник мапи або номінатор/член групи NAT може залишати замітки для маперів.',
        ],

        'vote' => [
            'bot' => "Неможливо проголосувати \"за\" в обговоренні, яке створене ботом",
            'limit_exceeded' => 'Будь ласка, зачекайте перед повторним голосуванням',
            'owner' => "Не можна проголосувати \"за\" у власному обговоренні.",
            'wrong_beatmapset_state' => 'Проголосувати "за" можна лише в обговореннях мап, які знаходяться "На розгляді".',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Ви можете видаляти лише свої пости.',
            'resolved' => 'Ви не можете видалити пост вирішеного обговорення.',
            'system_generated' => 'Автоматично згенерований пост не може бути видаленим.',
        ],

        'edit' => [
            'not_owner' => 'Лише автор поста може редагувати його.',
            'resolved' => 'Ви не можете редагувати пост у вирішеному обговоренні.',
            'system_generated' => 'Автоматично згенерований пост не може бути відредагованим.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Ця мапа закрита для обговорень.',

        'metadata' => [
            'nominated' => 'Ви не можете змінювати метадані номінованої мапи. Зв\'яжіться з BN\'ом або членом NAT, якщо ви думаєте, що вони вказані невірно.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => 'Зіграйте цю мапу перед тим як додавати теги.',
        ],
    ],

    'chat' => [
        'blocked' => 'Неможливо надіслати повідомлення користувачу, який заблокував вас, або якого, заблокували ви.',
        'friends_only' => 'Користувач заблокував повідомлення від користувачів не зі списку друзів.',
        'moderated' => 'Наразі канал модерується.',
        'no_access' => 'У вас немає доступу до цього каналу.',
        'no_announce' => 'У вас немає прав на відправлення повідомлень-оголошень.',
        'receive_friends_only' => 'Цей користувач не зможе відповісти, оскільки ви приймаєте повідомлення лише від людей з вашого списку друзів.',
        'restricted' => 'Ви не можете надсилати повідомлення коли вас заглушено, обмежено або заблоковано.',
        'silenced' => 'Ви не можете надсилати повідомлення коли вас заглушено, обмежено або заблоковано.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Коментарі відключені',
        ],
        'update' => [
            'deleted' => "Неможливо редагувати видалений пост.",
        ],
    ],

    'contest' => [
        'judging_not_active' => 'Суддівство для цього конкурсу не активно.',
        'voting_over' => 'Ви не можете змінити свій вибір після завершення періоду голосування.',

        'entry' => [
            'limit_reached' => 'Ви вичерпали кількість заявок для цього конкурсу',
            'over' => 'Дякуємо за ваші заявки на участь в цьому конкурсі! Подання заявок завершене і голосування розпочнеться найближчим часом.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Недостатньо прав для модерації цього форуму.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Лише останній пост може бути видалений.',
                'locked' => 'Неможливо видалити пост в закритій темі.',
                'no_forum_access' => 'Потрібний доступ до запитаного форуму.',
                'not_owner' => 'Лише автор поста може його видалити.',
            ],

            'edit' => [
                'deleted' => 'Неможливо редагувати видалену публікацію.',
                'locked' => 'Пост заблоковано для редагування.',
                'no_forum_access' => 'Необхідно мати доступ до запитуваного форуму.',
                'not_owner' => 'Лише автор поста може його редагувати.',
                'topic_locked' => 'Неможливо редагувати публікацію в заблокованій темі.',
            ],

            'store' => [
                'play_more' => 'Пограйте в гру, перш ніж писати що-небудь на форумі. Якщо у вас проблеми з грою, спробуйте написати про це на форумі «Допомоги і підтримки».',
                'too_many_help_posts' => "Перш ніж ви зможете створювати додаткові пости, ви повинні пограти в гру довше. Якщо у вас все ще проблеми з грою, напишіть нам на support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Будь ласка, відредагуйте ваш останній пост замість повторної публікації.',
                'locked' => 'Неможливо відповісти в закритій темі.',
                'no_forum_access' => 'Потрібен доступ до запитаного форуму.',
                'no_permission' => 'Недостатньо прав, щоб відповісти.',

                'user' => [
                    'require_login' => 'Будь ласка, ввійдіть до акаунту, щоб відповісти.',
                    'restricted' => "Не можна відповісти поки акаунт обмежений.",
                    'silenced' => "Не можна відповісти поки ви заглушені.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Потрібний доступ до запитаного форуму.',
                'no_permission' => 'Недостатньо прав на створення нової теми.',
                'forum_closed' => 'Форум закритий і на ньому не можна розміщувати нові пости.',
            ],

            'vote' => [
                'no_forum_access' => 'Потрібний доступ до запитаного форуму.',
                'over' => 'Опитування завершено, і голосувати в ньому більше не можна.',
                'play_more' => 'Вам потрібно пограти більше, щоб голосувати на форумі.',
                'voted' => 'Міняти свій вибір не дозволено.',

                'user' => [
                    'require_login' => 'Увійдіть до акаунту, щоб проголосувати.',
                    'restricted' => "Не можна голосувати поки акаунт обмежений.",
                    'silenced' => "Не можна голосувати поки ви заглушені.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Необхідний доступ до запитуваного форуму.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Обрана некоректна обкладинка.',
                'not_owner' => 'Лише власник теми може змінювати обкладинку.',
            ],
            'store' => [
                'forum_not_allowed' => 'Цей форум не підтримує обкладинки тем.',
            ],
        ],

        'view' => [
            'admin_only' => 'Тільки адміністратор може переглядати цей форум.',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => 'Тільки власник кімнати може закрити її.',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "Неможливо закріпити цей тип рекорду",
            'failed' => "Не можна закріпити цей результат.",
            'not_owner' => 'Лише власник результату може його закріпити.',
            'too_many' => 'Закріплено надто багато результатів.',
        ],
    ],

    'team' => [
        'application' => [
            'store' => [
                'already_member' => "Ви вже стали частиною команди.",
                'already_other_member' => "Ви вже в іншій команди.",
                'currently_applying' => 'Ваш запит на вступ до команди очікує на розгляд.',
                'team_closed' => 'Наразі команда більше не приймає жодних заявок на вступ.',
                'team_full' => "Команда переповнена і не може прийняти більше учасників.",
            ],
        ],
        'part' => [
            'is_leader' => "Лідер команди не може покинути команду.",
            'not_member' => 'Не є членом команди.',
        ],
        'store' => [
            'require_supporter_tag' => 'для створення команди потрібен тег osu!supporter.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Сторінку користувача заблоковано.',
                'not_owner' => 'Можна редагувати лише власну сторінку.',
                'require_supporter_tag' => 'необхідний тег osu!supporter.',
            ],
        ],
        'update_email' => [
            'locked' => 'адресу електронної пошти заблоковано',
        ],
    ],
];
