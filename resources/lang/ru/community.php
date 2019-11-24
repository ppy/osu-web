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
    'support' => [
        'convinced' => [
            'title' => 'Убедил! :D',
            'support' => 'поддержать osu!',
            'gift' => 'или подарить osu!supporter другому игроку',
            'instructions' => 'нажмите на сердечко для перехода в osu!store',
        ],
        'why-support' => [
            'title' => 'Зачем мне поддерживать osu!? Куда идут деньги?',

            'team' => [
                'title' => 'Поддержите разработчиков',
                'description' => 'osu! разрабатывается небольшой командой людей. Ваша поддержка поможет им, ну, вы знаете... жить.',
            ],
            'infra' => [
                'title' => 'Инфраструктура сервера',
                'description' => 'Пожертвования уходят на серверы для сайта, мультиплеера, таблиц рекордов и т.д.',
            ],
            'featured-artists' => [
                'title' => 'Featured Artists',
                'description' => 'С вашей поддержкой мы можем сотрудничать с многими крутыми исполнителями и лицензировать ещё больше замечательной музыки для osu!',
                'link_text' => 'Посмотрите, кто уже есть &raquo;',
            ],
            'ads' => [
                'title' => 'Обеспечьте независимость osu!',
                'description' => 'Ваш вклад поможет игре остаться независимой и полностью свободной от рекламы и внешних спонсоров.',
            ],
            'tournaments' => [
                'title' => 'Официальные турниры',
                'description' => 'Помогите финансировать официальные турниры osu! World Cup (а также призы для них).',
                'link_text' => 'Посмотрите турниры &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Поощрение вклада в открытое ПО',
                'description' => 'Поддержите участников сообщества, которые потратили время и силы для того, чтобы сделать osu! лучше.',
                'link_text' => 'Узнайте больше &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Интересно, а что же я получу?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'быстрый и лёгкий доступ к поиску и загрузку карт, не сворачивая игру.',
            ],

            'friend_ranking' => [
                'title' => 'Рейтинг среди друзей',
                'description' => "Узнайте, насколько вы лучше ваших друзей, по отдельным таблицам рекордов для карт. Доступно как в игре, так и на сайте.",
            ],

            'country_ranking' => [
                'title' => 'Рейтинг в стране',
                'description' => 'Завоюйте свою страну, прежде чем завоёвывать мир.',
            ],

            'mod_filtering' => [
                'title' => 'Фильтр по модам',
                'description' => 'Интересуетесь только теми, кто играет с HDHR? Нет проблем!',
            ],

            'auto_downloads' => [
                'title' => 'Автоматические загрузки',
                'description' => 'Мгновенная загрузка карт при игре в мультиплеере, наблюдении за другими игроками или при клике по ссылкам в чате!',
            ],

            'upload_more' => [
                'title' => 'Загружай больше',
                'description' => 'Дополнительные слоты для ожидающих ранкинга карт (до 10).',
            ],

            'early_access' => [
                'title' => 'Ранний доступ',
                'description' => 'Доступ к ранним версиям игры, где вы можете попробовать новые функции, прежде чем они получат огласку!',
            ],

            'customisation' => [
                'title' => 'Индивидуальность',
                'description' => "Настройте свой профиль, добавив полностью настраиваемую страницу пользователя \"обо мне!\".",
            ],

            'beatmap_filters' => [
                'title' => 'Фильтры карт',
                'description' => 'Фильтр для поиска карт, в которые вы играли или не играли. А так же по полученным на них рейтингами.',
            ],

            'yellow_fellow' => [
                'title' => 'Золотой ник',
                'description' => 'Будьте узнаваемым в игре с ярко-жёлтым цветом ника.',
            ],

            'speedy_downloads' => [
                'title' => 'Быстрые загрузки',
                'description' => 'Меньше ограничений по загрузке карт, особенно через osu!direct.',
            ],

            'change_username' => [
                'title' => 'Смена никнейма',
                'description' => 'Возможность изменить свой никнейм без дополнительных затрат (только один раз).',
            ],

            'skinnables' => [
                'title' => 'Кастомизация',
                'description' => 'Дополнительные параметры в скине позволят тебе, к примеру, установить свой фон в меню.',
            ],

            'feature_votes' => [
                'title' => 'Голосование за новые фичи',
                'description' => 'Вы можете голосовать за добавление новых фич в osu! (2 голоса в месяц).',
            ],

            'sort_options' => [
                'title' => 'Параметры сортировки',
                'description' => 'Возможность просмотра рейтинга карты между странами / друзьями / модами в игре.',
            ],

            'more_favourites' => [
                'title' => 'Больше избранных карт',
                'description' => 'Максимальное число карт, которые вы можете добавить в избранные, увеличится с :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Больше друзей',
                'description' => 'Число друзей, которых вы можете добавить, увеличится с :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Загрузите больше карт',
                'description' => 'Максимальное количество нерейтинговых карт, которое Вы можете добавить, начинается с одного значения и увеличивается по мере того, как Ваши карты становятся рейтинговыми (до определённого ограничения).<br/><br/>Обычно это 4 карты изначально, плюс одна за каждую рейтинговую (до двух). С osu!supporter: 8 карт изначально, плюс одна за каждую рейтинговую (до 12).',
            ],
            'friend_filtering' => [
                'title' => 'Глобальные таблицы среди друзей',
                'description' => 'Посоревнуйтесь с вашими друзьями и узнайте, кто круче!*<br/><br/><small>* пока недоступно на новом сайте, скоробудет(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Большое спасибо за вашу поддержку! Всего вы пожертвовали :dollars за :tags покупок!',
            'gifted' => "Из них, вы подарили :giftedTags тегов (в итоге подарено :giftedDollars), как щедро!",
            'not_yet' => "У вас нет и ещё не было osu!supporter :(",
            'valid_until' => 'Ваш osu!supporter активен до :date!',
            'was_valid_until' => 'Ваш osu!supporter истекает :date.',
        ],
    ],
];
