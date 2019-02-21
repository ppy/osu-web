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
    'availability' => [
        'disabled' => 'Гэтая бітмапа зараз недаступна для спампоўвання.',
        'parts-removed' => 'Некаторыя часткі гэтай бітмапы былі выдалены па запыту стваральніка або праваўладальніка.',
        'more-info' => 'Для падрабязнасцей націсніце тут.',
    ],

    'index' => [
        'title' => 'Спіс бітмап',
        'guest_title' => 'Бітмапы',
    ],

    'show' => [
        'discussion' => 'Абмеркаванне',

        'details' => [
            'approved' => 'ухваліны ',
            'favourite' => 'Дадаць да абраных',
            'favourited_count' => '+ 1 іншы!|+ :count іншых!',
            'logged-out' => 'Каб спампаваць нейкую бітмапу, вам трэба ўвайсці!',
            'loved' => 'абраны ',
            'mapped_by' => 'створана :mapper',
            'qualified' => 'кваліфікаваны ',
            'ranked' => 'ранкаваны ',
            'submitted' => 'апублікаваны ',
            'unfavourite' => 'Выдаліць з абраных',
            'updated' => 'абноўлены ',
            'updated_timeago' => 'абноўлены :timeago',

            'download' => [
                '_' => 'Спампаваць',
                'direct' => '',
                'no-video' => 'без відэа',
                'video' => 'з відэа',
            ],

            'login_required' => [
                'bottom' => '',
                'top' => '',
            ],
        ],

        'favourites' => [
            'limit_reached' => '',
        ],

        'hype' => [
            'action' => 'Надайце хайп гэтай мапе, калі вам спадабалася гуляць у яе, і каб павялічыць ейны стан <strong>Рэйтынгу</strong>.',

            'current' => [
                '_' => 'Зараз гэтыя мапа :status.',

                'status' => [
                    'pending' => 'чакае',
                    'qualified' => 'кваліфікаваны',
                    'wip' => 'праца ў працэсе',
                ],
            ],
        ],

        'info' => [
            'description' => 'Апісанне',
            'genre' => 'Жанр',
            'language' => 'Мова',
            'no_scores' => 'Усё яшчэ ідзе падлік даных...',
            'points-of-failure' => 'Колькасць правалаў',
            'source' => 'Крыніца',
            'success-rate' => 'Шанц поспеху',
            'tags' => 'Тэгі',
            'unranked' => 'Unranked бітмапа',
        ],

        'scoreboard' => [
            'achieved' => 'дасягнуты :when',
            'country' => 'Рэйтынг краін',
            'friend' => 'Рэйтынг сяброў',
            'global' => 'Глабальны рэйтынг',
            'supporter-link' => 'Націсніце <a href=":link">тут</a>, каб праглядзець усе магчымасці, якія вы атрымліваеце!',
            'supporter-only' => 'Каб мець доступ да рэйтынгу краін і сяброў вам трэба быць osu!supporter',
            'title' => 'Табло',

            'headers' => [
                'accuracy' => 'Дакладнасць',
                'combo' => 'Макс. комба',
                'miss' => 'Промах',
                'mods' => 'Моды',
                'player' => 'Гулец',
                'pp' => '',
                'rank' => 'Ранг',
                'score_total' => 'Усяго ачкоў',
                'score' => 'Ачкі',
            ],

            'no_scores' => [
                'country' => 'Ніхто з вашай краіны яшчэ не гуляў на гэтай мапе!',
                'friend' => 'Ніхто з вашых сяброў ячшэ не гуляў на гэтай мапе!',
                'global' => 'Ніхто яшчэ не гуляў на гэтай мапе. Можа вы паспрабуеце?',
                'loading' => 'Загрузка вынікаў...',
                'unranked' => 'Unranked бітмапа.',
            ],
            'score' => [
                'first' => 'Лідуе',
                'own' => 'Ваш рэкорд',
            ],
        ],

        'stats' => [
            'cs' => 'Памер круга',
            'cs-mania' => 'Колькасць клавіш',
            'drain' => 'Страта HP',
            'accuracy' => 'Дакладнасць',
            'ar' => 'Хуткасць набліжэння',
            'stars' => 'Складанасць',
            'total_length' => 'Працягласць',
            'bpm' => 'BPM',
            'count_circles' => 'Колькасць кругоў',
            'count_sliders' => 'Колькасць слайдараў',
            'user-rating' => 'Рэйтынг карыстальнікаў',
            'rating-spread' => 'Шкала рэйтынгу',
            'nominations' => 'Намінацыі',
            'playcount' => 'Колькасць гульняў',
        ],
    ],
];
