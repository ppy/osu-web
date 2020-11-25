<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Папярэднія запакаваныя калекцыі бітмап, створаныя на агульных тэмах.',
        'nav_title' => 'спіс',
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
        'no_diff_reduction' => [
            '_' => '',
            'link' => '',
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
