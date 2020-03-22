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
    'index' => [
        'description' => 'Папярэднія запакаваныя калекцыі бітмап, створаныя на агульных тэмах.',
        'nav_title' => '',
        'title' => 'Пакет бітмап',

        'blurb' => [
            'important' => 'ПЕРАД СПАМПАВАННЕМ ПРАЧЫТАЙЦЕ ГЭТА',
            'instruction' => [
                '_' => "Усталёўка: як толькі пакет будзе спампаваны, выняць файлы з .rar у вашу папку з песнямі osu!
                    Усе песні ўнутры пакета фармату .zip або .osz, таму osu! патрабуе выняць адтуль бітмапы падчас наступнай гульні.
                    :scary вымайце zip/osz самі,
                    а інакш бітмапы ў osu! будуць адлюстроўвацца і працаваць няправільна.",
                'scary' => 'НЕ',
            ],
            'note' => [
                '_' => 'Таксама, раім вам :scary, бо старыя мапы моцна саступаюць па якасці ў адрозненне ад новых.',
                'scary' => 'спампоўваць пакеты з найнавешых да найстарэйшых',
            ],
        ],
    ],

    'show' => [
        'download' => 'Спампаваць',
        'item' => [
            'cleared' => 'пройдзена',
            'not_cleared' => 'не пройдзена',
        ],
    ],

    'mode' => [
        'artist' => 'Выканавец/Альбом',
        'chart' => 'Чарты',
        'standard' => 'Стандартная',
        'theme' => 'Тэма',
    ],

    'require_login' => [
        '_' => 'Вы мусіць :link для спампавання',
        'link_text' => 'увайсці',
    ],
];
