<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Зададен е невалиден :attribute.',
    'not_negative' => ':attribute не може да бъде отрицателно.',
    'required' => ':attribute е задължително.',
    'too_long' => ':attribute превишена максимална дължина - може да бъде само до :limit символа.',
    'wrong_confirmation' => 'Потвърждението не съвпада.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Времевата отметка е зададена, но бийтмапа липсва.',
        'beatmapset_no_hype' => "Този бийтмап не може да бъде надъхан.",
        'hype_requires_null_beatmap' => 'Надъхването може да бъде извършено в Главната поддискусия(всички трудности).',
        'invalid_beatmap_id' => 'Невалидна трудност зададена.',
        'invalid_beatmapset_id' => 'Невалиден бийтмап зададен.',
        'locked' => 'Дискусията е заключена.',

        'attributes' => [
            'message_type' => 'Вид на съобщението',
            'timestamp' => 'Времева отметка',
        ],

        'hype' => [
            'discussion_locked' => "Този бийтмап е заключен за дискусии и не може да бъде надъхан",
            'guest' => 'Трябва да влезете в профила си за да надъхате.',
            'hyped' => 'Вече сте надъхали този бийтмап.',
            'limit_exceeded' => 'Използвахте си цялото надъхване.',
            'not_hypeable' => 'Този бийтмап не може да бъде надъхан',
            'owner' => 'Не може да надъхате собствения си бийтмап.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Указаната времева отметка е извън дължината на бийтмапа.',
            'negative' => "Времевите отметки не могат да бъдат отрицателни.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Дискусията е заключена.',
        'first_post' => 'Не можете да изтриете началната публикация.',

        'attributes' => [
            'message' => 'Съобщението',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Не е позволено отговарянето на изтрит коментар.',
        'top_only' => 'Закачване на коментиран отговор не е разрешено.',

        'attributes' => [
            'message' => 'Съобщението',
        ],
    ],

    'follow' => [
        'invalid' => 'Зададен е невалиден :attribute.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Може да гласувате само заявки за нови функции.',
            'not_enough_feature_votes' => 'Няма достатъчно гласове.',
        ],

        'poll_vote' => [
            'invalid' => 'Невалидна опция зададена.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Изтриването на метаданните на този бийтмап не е позволено.',
            'beatmapset_post_no_edit' => 'Редактирането на метаданните на този бийтмап не е позволено.',
            'first_post_no_delete' => 'Не можете да изтриете началната публикация',
            'missing_topic' => 'За поста липсва тема',
            'only_quote' => 'Вашият отговор съдържа само цитат.',

            'attributes' => [
                'post_text' => 'Съдържание на публикацията',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Заглавие на темата',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Дублираната опция не е позволена.',
            'grace_period_expired' => 'Не може да редактирате анкета след повече от :limit часа',
            'hiding_results_forever' => 'Скриване на резултата от безкрайна анкета е невъзможно.',
            'invalid_max_options' => 'Броя отговори за потребител не може да надвишава наличните отговори.',
            'minimum_one_selection' => 'Изисква се минимум един отговор от потребител.',
            'minimum_two_options' => 'Необходими са поне два отговора.',
            'too_many_options' => 'Достигнат е максималният брой разрешени отговори.',

            'attributes' => [
                'title' => 'Заглавие на анкета',
            ],
        ],

        'topic_vote' => [
            'required' => 'Изберете отговор, когато гласувате.',
            'too_many' => 'Избрани са повече отговора от разрешените.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Достигнат е максимум брой позволени OAuth приложения.',
            'url' => 'Въведете валиден URL.',

            'attributes' => [
                'name' => 'Име на приложението',
                'redirect' => 'Callback URL на приложението',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Паролата не може да съдържа в себе си потребителското име.',
        'email_already_used' => 'Този имейл адрес вече се използва.',
        'email_not_allowed' => 'Имейл адресът не е разрешен.',
        'invalid_country' => 'Страната не е в базата данни.',
        'invalid_discord' => 'Потребителското име за Discord е невалидно.',
        'invalid_email' => "Това не изглежда да е валиден имейл адрес.",
        'invalid_twitter' => 'Невалидно Twitter потребителско име.',
        'too_short' => 'Новата парола е твърде къса.',
        'unknown_duplicate' => 'Потребителското име или имейл адресът вече се използват.',
        'username_available_in' => 'Това потребителско име ще стане достъпно за употреба след :duration.',
        'username_available_soon' => 'Това потребителско име ще стане достъпно за употреба след няколко момента!',
        'username_invalid_characters' => 'Желаното име съдържа невалидни символи.',
        'username_in_use' => 'Потребителско име е в употреба!',
        'username_locked' => 'Потребителското име е заключено!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Моля използвайте или долна черта или пространства, не и двете!',
        'username_no_spaces' => "Потребителското име не може да започва или завършва с интервал!",
        'username_not_allowed' => 'Този избор на потребителско име не е разрешен.',
        'username_too_short' => 'Исканото потребителско име е твърде късо.',
        'username_too_long' => 'Исканото потребителско име е трърде дълго.',
        'weak' => 'Паролата е слаба.',
        'wrong_current_password' => 'Текущата парола е неправилна.',
        'wrong_email_confirmation' => 'Имейлът за потвърждение не съответства.',
        'wrong_password_confirmation' => 'Потвърждението на паролата не съответства.',
        'too_long' => 'Превишена максимална дължина - може да бъде само до :limit символа.',

        'attributes' => [
            'username' => 'Потребителско име',
            'user_email' => 'Имейл адрес',
            'password' => 'Парола',
        ],

        'change_username' => [
            'restricted' => 'Смяната на потребителско име е невъзможна, докато сте с ограничени.',
            'supporter_required' => [
                '_' => 'Трябва да сте :link , за да промените името си!',
                'link_text' => 'подкрепили osu!',
            ],
            'username_is_same' => 'Вече използвате това име, глупаче!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => ':reason е невалидна причина за този тип доклад.',
        'self' => "Не може да докладвате себе си!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Количество',
                'cost' => 'Цена',
            ],
        ],
    ],
];
