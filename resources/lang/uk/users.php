<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'deleted' => '[видалений користувач]',

    'beatmapset_activities' => [
        'title' => "Історія редагування карт користувача :user",
        'title_compact' => 'Редагування',

        'discussions' => [
            'title_recent' => 'Нещодавно розпочаті дискусії',
        ],

        'events' => [
            'title_recent' => 'Недавні події',
        ],

        'posts' => [
            'title_recent' => 'Недавні публікації',
        ],

        'votes_received' => [
            'title_most' => 'Найпопулярніші (за 3 місяці)',
        ],

        'votes_made' => [
            'title_most' => 'Найпопулярніші (за 3 місяці)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Ви заблокували цього користувача.',
        'blocked_count' => 'заблоковати користувача (:count)',
        'hide_profile' => 'Приховати профіль',
        'not_blocked' => 'Користувач не заблокований.',
        'show_profile' => 'Показати профіль',
        'too_many' => 'Досягнуто ліміт блокування.',
        'button' => [
            'block' => 'Заблокувати',
            'unblock' => 'Розблокувати',
        ],
    ],

    'card' => [
        'loading' => 'Завантаження...',
        'send_message' => 'Надіслати повідомлення',
    ],

    'disabled' => [
        'title' => '',
        'warning' => "",

        'if_mistake' => [
            '_' => '',
            'email' => '',
        ],

        'reasons' => [
            'compromised' => '',
            'opening' => '',

            'tos' => [
                '_' => '',
                'community_rules' => '',
                'tos' => '',
            ],
        ],
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "",
        ],
    ],

    'login' => [
        '_' => 'Вхід',
        'button' => 'Вхід',
        'button_posting' => 'Входимо...',
        'email_login_disabled' => '',
        'failed' => 'Помилка авторизації',
        'forgot' => 'Забули пароль?',
        'info' => '',
        'locked_ip' => 'ваша IP адреса заблокована. Будь ласка спробуйте пізніше.',
        'password' => 'Пароль',
        'register' => "У вас все ще немає аккаунта osu!? Створіть новий",
        'remember' => 'Запам\'ятати цей браузер',
        'title' => 'Увійдіть, щоб продовжити',
        'username' => 'Ім\'я користувача',

        'beta' => [
            'main' => 'Доступ до бета-версії обмежений.',
            'small' => '(osu!supporters отримають доступ пізніше)',
        ],
    ],

    'posts' => [
        'title' => 'Публікації :username',
    ],

    'anonymous' => [
        'login_link' => 'натисніть тут, щоб увійти',
        'login_text' => 'увійти',
        'username' => 'Гість',
        'error' => 'Спершу ввійдіть до облікового запису.',
    ],
    'logout_confirm' => 'Ви справді бажаєте вийти? :(',
    'report' => [
        'button_text' => 'Поскаржитися',
        'comments' => 'Додаткові коментарі',
        'placeholder' => 'Будь ласка, надайте будь-яку інформацію, яка, на вашу думку, може бути корисною.',
        'reason' => 'Причина',
        'thanks' => 'Дякуємо за повідомлення!',
        'title' => 'Поскаржитись на :username?',

        'actions' => [
            'send' => 'Надіслати скаргу',
            'cancel' => 'Відмінити',
        ],

        'options' => [
            'cheating' => 'Нечесна гра / чіти',
            'insults' => 'Образа мене / інших',
            'spam' => 'Спам',
            'unwanted_content' => 'Повідомити про неприйнятний вміст',
            'nonsense' => 'Нісенітниця',
            'other' => 'Інше (вкажіть нижче)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Ваш обліковий запис обмежено!',
        'message' => 'Поки права вашого облікового запису обмежені, ви не зможете взаємодіяти з іншими гравцями і ваші результати будуть видні тільки вам. Зазвичай це результат автоматизованого процесу і, як правило, обмеження знімається на протязі доби. Якщо ви хочете оскаржити ваше обмеження, будь ласка <a href="mailto:accounts@ppy.sh"> зв\'яжіться з підтримкою </a>.',
    ],
    'show' => [
        'age' => ':age років',
        'change_avatar' => 'змінити аватар!',
        'first_members' => 'Тут з самого початку',
        'is_developer' => 'osu!розробник',
        'is_supporter' => 'osu!прихильник',
        'joined_at' => 'Дата реєстрації: :date',
        'lastvisit' => 'Останній раз бачили :date',
        'lastvisit_online' => 'Зараз в мережі',
        'missingtext' => 'Можливо, ви зробили помилку! (Або гравець заблокований)',
        'origin_country' => 'Проживає в :country',
        'page_description' => 'osu! - Все, що ви хотіли знати про :username!',
        'previous_usernames' => 'також відомий як',
        'plays_with' => 'Грає з :devices',
        'title' => "профіль :username",

        'edit' => [
            'cover' => [
                'button' => 'Змінити обкладинку профілю',
                'defaults_info' => 'Більше варіантів буде доступно найближчим часом',
                'upload' => [
                    'broken_file' => 'Не вдалося обробити зображення. Спробуйте ще раз.',
                    'button' => 'Завантажити зображення',
                    'dropzone' => 'Для завантаження файлу перетягніть його сюди',
                    'dropzone_info' => 'Ви також можете перетягнути зображення сюди для завантаження',
                    'size_info' => 'Розмір обкладинки повинен бути 2800x620',
                    'too_large' => 'Завантажене зображення занадто велике.',
                    'unsupported_format' => 'Формат не підтримується.',

                    'restriction_info' => [
                        '_' => '',
                        'link' => '',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'режим гри за замовчуванням',
                'set' => 'вибрати :mode як режим гри за замовчуванням',
            ],
        ],

        'extra' => [
            'none' => '',
            'unranked' => 'Немає недавніх ігор',

            'achievements' => [
                'achieved-on' => 'Отримано :date',
                'locked' => 'Не отримано',
                'title' => 'Досягнення',
            ],
            'beatmaps' => [
                'by_artist' => 'від :artist',
                'none' => 'Нічого... поки що.',
                'title' => 'Карти',

                'favourite' => [
                    'title' => 'Улюблені карти',
                ],
                'graveyard' => [
                    'title' => 'Закинуті карти',
                ],
                'loved' => [
                    'title' => 'Улюблені карти',
                ],
                'ranked_and_approved' => [
                    'title' => 'Рейтингові і схвалені карти',
                ],
                'unranked' => [
                    'title' => 'На розгляді',
                ],
            ],
            'discussions' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'events' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'historical' => [
                'empty' => 'Поки записів немає :(',
                'title' => 'Активність',

                'monthly_playcounts' => [
                    'title' => 'Активність по місяцях',
                    'count_label' => 'Ігор',
                ],
                'most_played' => [
                    'count' => 'разів зіграно',
                    'title' => 'Найбільше зіграні карти',
                ],
                'recent_plays' => [
                    'accuracy' => 'точність: :percentage',
                    'title' => 'Останні ігри (24г)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Історія перегляду повторів',
                    'count_label' => 'Переглянуті повтори',
                ],
            ],
            'kudosu' => [
                'available' => 'Кудосу доступно',
                'available_info' => "Кудосу можуть бути використані для обміну між іншими авторами карт, які в свою чергу допоможуть залучити до вашої карті більше уваги. Це кількість кудосу, які ви не використали.",
                'recent_entries' => 'Останні обміни',
                'title' => 'Кудосу!',
                'total' => 'Кудосу накопичено',

                'entry' => [
                    'amount' => ':amount кудосу',
                    'empty' => "Цей користувач не обмінювався Кудосу!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Отримано :amount за відповідь в :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Відібрано :amount за відповідь в :post',
                        ],

                        'delete' => [
                            'reset' => 'Втрачено :amount за видалення відповіді в :post',
                        ],

                        'restore' => [
                            'give' => 'Отримано :amount за відновлення відповіді в :post',
                        ],

                        'vote' => [
                            'give' => 'Отримано :amount за отримання голосів в :post',
                            'reset' => 'Втрачено :amount за втрату голосів у :post',
                        ],

                        'recalculate' => [
                            'give' => 'Отримано :amount за перерахунок голосів в :post',
                            'reset' => 'Втрачено :amount за перерахунок голосів в :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':giver дав :amount за відповідь в :post',
                        'reset' => ':giver забрав кудосу за відповідь в :post',
                        'revoke' => ':giver забрав кудосу за відповідь в :post',
                    ],
                ],

                'total_info' => [
                    '_' => '',
                    'link' => '',
                ],
            ],
            'me' => [
                'title' => 'про мене!',
            ],
            'medals' => [
                'empty' => "Цей користувач поки що нічого не отримав. ; _;",
                'recent' => 'Останні досягнення',
                'title' => 'Досягнення',
            ],
            'posts' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'recent_activity' => [
                'title' => 'Недавня активність',
            ],
            'top_ranks' => [
                'download_replay' => 'Завантажити повтор',
                'empty' => 'Поки рекордів немає :(',
                'not_ranked' => 'Очки продуктивності видаються тільки за рейтингові або одобрені карти.',
                'pp_weight' => 'зважено: :percentage',
                'title' => 'Рейтинги',

                'best' => [
                    'title' => 'Кращі результати',
                ],
                'first' => [
                    'title' => 'Рекорди',
                ],
            ],
            'votes' => [
                'given' => '',
                'received' => '',
                'title' => '',
                'title_longer' => '',
                'vote_count' => '',
            ],
            'account_standing' => [
                'title' => 'Статус аккаунту',
                'bad_standing' => "аккаунт <strong>:username </strong> не в хорошому стані :(",
                'remaining_silence' => 'користувачу <strong>:username </strong> можна буде говорити через :duration.',

                'recent_infringements' => [
                    'title' => 'Недавні порушення',
                    'date' => 'дата',
                    'action' => 'покарання',
                    'length' => 'тривалість',
                    'length_permanent' => 'Назавжди',
                    'description' => 'опис',
                    'actor' => 'від :username',

                    'actions' => [
                        'restriction' => 'Заблокувати',
                        'silence' => 'Заглушений',
                        'note' => 'Замітка',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Вподобання',
            'lastfm' => 'Last.fm',
            'location' => 'Поточне місцезнаходження',
            'occupation' => 'Рід занять',
            'skype' => '',
            'twitter' => '',
            'website' => 'Сайт',
        ],
        'not_found' => [
            'reason_1' => 'Вони могли змінити свої псевдоніми.',
            'reason_2' => 'Обліковий запис може бути тимчасово недоступним через скарги або проблеми з безпекою.',
            'reason_3' => 'Можливо, ви зробили помилку!',
            'reason_header' => 'Є кілька можливих причин:',
            'title' => 'Користувач не знайдений або не існує ;_;',
        ],
        'page' => [
            'button' => 'Редагувати профіль',
            'description' => '<strong>про мене!</strong> є настроюваною областю профілю.',
            'edit_big' => 'Редагуйте мене!',
            'placeholder' => 'Введіть вміст сторінки',

            'restriction_info' => [
                '_' => '',
                'link' => '',
            ],
        ],
        'post_count' => [
            '_' => 'Написав :link',
            'count' => ':count пост|:count пости|:count постів',
        ],
        'rank' => [
            'country' => 'Рейтинг країни для :mode',
            'country_simple' => 'Рейтинг країни',
            'global' => 'Глобальний рейтинг для :mode',
            'global_simple' => 'Рейтинг в світі',
        ],
        'stats' => [
            'hit_accuracy' => 'Точність попадань',
            'level' => 'Рівень :level',
            'level_progress' => 'Прогрес до наступного рівня',
            'maximum_combo' => 'Максимальне комбо',
            'medals' => 'Досягнення',
            'play_count' => 'Кількість ігор',
            'play_time' => 'Загальний час у грі',
            'ranked_score' => 'Рейтингові очки',
            'replays_watched_by_others' => 'Повтори переглянуті іншими',
            'score_ranks' => 'Рейтинг по очках',
            'total_hits' => 'Всього попадань',
            'total_score' => 'Всього очків',
            // modding stats
            'ranked_and_approved_beatmapset_count' => '',
            'loved_beatmapset_count' => '',
            'unranked_beatmapset_count' => '',
            'graveyard_beatmapset_count' => '',
        ],
    ],

    'status' => [
        'all' => 'Всі',
        'online' => 'В мережі',
        'offline' => 'Не в мережі',
    ],
    'store' => [
        'saved' => 'Користувач створений',
    ],
    'verify' => [
        'title' => 'Підтвердження аккаунта',
    ],

    'view_mode' => [
        'card' => '',
        'list' => '',
    ],
];
