<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'header' => [
            // size in font-size
            'big_description' => 'Нравится osu!?<br/>                                Поддержите разработку osu! :D',
            'small_description' => '',
            'support_button' => 'Поддержать osu!',
        ],

        'dev_quote' => 'osu! - полностью бесплатная игра, но держать её на плаву - совсем не бесплатно.
        Не ограничиваясь стоимостью аренды серверов и качественным соединением с ними из любой точки мира, временем, потраченным на систему и сообщество,
        предоставлением призов для конкурсов, ответами на вопросы в техподдержке и просто осчастливливанием людей, osu! поглощает немалую сумму денег!
        И да, не стоит забывать тот факт, что мы ничего не рекламируем и не продвигаем ненужных тулбаров и им подобных!
            <br/><br/>В конечном счёте, курирование osu! в большей части лежит на мне, более известном вам всем как "peppy".
            Мне пришлось уволиться со своей основной работы, чтобы поддерживать osu!,
            и, временами, из кожи вон лезть, поддерживая желаемые стандарты.
            Я хотел бы выразить личную благодарность всем тем, кто поддерживает osu! по сей день,
            а так же всем тем, кто будет поддерживать эту замечательную игру и её сообщество в будущем :).',

        'supporter_status' => [
            'contribution' => 'Большое спасибо за вашу поддержку! Всего вы пожертвовали :dollars за :tags покупок!',
            'gifted' => 'Из них, вы подарили :giftedTags тегов (в итоге подарено :giftedDollars), как щедро!',
            'not_yet' => "У вас нет osu!supporter :(",
            'title' => 'Текущий статус osu!supporter',
            'valid_until' => 'Ваш osu!supporter активен до :date!',
            'was_valid_until' => 'Ваш osu!supporter истекает :date.',
        ],

        'why_support' => [
            'title' => 'Зачем мне поддерживать osu!?',
            'blocks' => [
                'dev' => 'Разрабатывается и поддерживается преимущественно одним парнем из Австралии',
                'time' => 'Занимает так много времени, что это уже нельзя называть просто "хобби".',
                'ads' => 'Никакой рекламы, совершенно. <br/><br/>
                        В отличие от 99.95% сайтов, мы не получаем прибыль от показа всякой всячины перед твоим лицом.',
                'goodies' => 'Вы получите некоторые плюшки!',
            ],
        ],

        'perks' => [
            'title' => 'Интересно, а что же я получу?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'быстрый и лёгкий доступ к поиску и загрузку карт, не сворачивая игру.',
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
                'description' => 'Настройте свой профиль, добавив полностью настраиваемую страницу пользователя "обо мне!".',
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
                'title' => 'Смените никнейм',
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

            'feel_special' => [
                'title' => 'Особые чувства',
                'description' => 'Тёплое чувство того, что вы помогли поддержать работу osu!',
            ],

            'more_to_come' => [
                'title' => 'И многое другое',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Прекрасно! :D',
            'support' => 'поддержать osu!',
            'gift' => 'или подарить osu!supporter другому игроку',
            'instructions' => 'нажмите на сердечко для перехода в osu!store',
        ],
    ],
];
