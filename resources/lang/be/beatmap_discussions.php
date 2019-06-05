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
    'authorizations' => [
        'update' => [
            'null_user' => 'Вы мусіце ўвайсці для рэдагавання.',
            'system_generated' => 'Сістэмныя допісы немагчыма адрэдагаваць.',
            'wrong_user' => 'Вы павінны быць уладальнікам допісу для рэдагавання.',
        ],
    ],

    'events' => [
        'empty' => 'Нічога не адбылося... яшчэ.',
    ],

    'index' => [
        'deleted_beatmap' => 'выдалена',
        'title' => 'Абмеркаванне бітмап',

        'form' => [
            '_' => 'Пошук',
            'deleted' => 'Уключаючы выдаленыя абмеркаванні',
            'types' => 'Тыпы памедамленняў',
            'username' => 'Імя карыстальніка',

            'user' => [
                'label' => 'Карыстальнік',
                'overview' => 'Агляд актыўнасці',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Дата размяшчэння',
        'deleted_at' => 'Дата выдалення',
        'message_type' => 'Тып',
        'permalink' => 'Пастаянная спасылка',
    ],

    'nearby_posts' => [
        'confirm' => 'Ні адзін з допісаў не вырашае маю праблему',
        'notice' => 'Існуюць допісы між :timestamp (:existing_timestamps). Праверце іх перш, чым размяшчаць.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Каб адказаць, увайдзіце',
            'user' => 'Адправіць',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Пазначана як рашэнне карыстальнікам :user',
            'false' => 'Адкрыта нанова карыстальнікам :user',
        ],
    ],

    'user' => [
        'admin' => 'кіраўнік',
        'bng' => 'намінатар',
        'owner' => 'мапер',
        'nat' => 'nat',
    ],

    'user_filter' => [
        'everyone' => 'Усе',
        'label' => 'Фільтр па карыстальнікам',
    ],
];
