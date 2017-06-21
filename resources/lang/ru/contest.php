<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'header' => [
        'small' => 'Соревнуйся в чём-то помимо клика по кружочкам.',
        'large' => 'osu! конкурсы сообщества',
    ],
    'voting' => [
        'over' => 'Голосование окончено',
        'login_required' => 'Войди для голосования.',
        'best_of' => [
            'none_played' => 'Не похоже что ты играл в те карты, которые претендуют в этом конкурсе.',
        ],
    ],
    'entry' => [
        '_' => 'заявка',
        'login_required' => 'Войди, чтобы участвовать в этом конкурсе.',
        'silenced_or_restricted' => 'Ты не можешь участвовать в конкурсе пока твои права ограничены.',
        'preparation' => 'В настоящее время мы готовим этот конкурс! Пожалуйста, потерпи немного.',
        'over' => 'Благодарим за ваши заявки на участие в этом конкурсе! Голосование начнется в ближайшее время.',
        'limit_reached' => 'Ты исчерпал количество заявок для этого конкурса.',
        'drop_here' => 'Брось свою заявку сюда',
        'wrong_type' => [
            'art' => 'Только файлы формата .jpg и .png разрешены для этого конкурса.',
            'beatmap' => 'Только файлы формата .osu разрешены для этого конкурса.',
            'music' => 'Только файлы формата .mp3 разрешены для этого конкурса.',
        ],
        'too_big' => 'Размеры файлов для этого конкурса не могут превышать :limit.',
    ],
    'beatmaps' => [
        'download' => 'Скачать файлы',
    ],
    'vote' => [
        'list' => 'голосов',
        'count' => '1 голос|:count голосов',
    ],
    'dates' => [
        'ended' => 'Окончено :date',

        'starts' => [
            '_' => 'Начнётся :date',
            'soon' => 'скоро™',
        ],
    ],
    'states' => [
        'entry' => 'Заявки открыты',
        'voting' => 'Голосование началось',
        'results' => 'Результаты опубликованы',
    ],
];
