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
        'blurb' => [
            'important' => 'ПРОЧИТАЙТЕ ЭТО ПЕРЕД ЗАГРУЗКОЙ',
            'instruction' => [
                '_' => "Установка: как только вы скачали карту, распакуйте содержимое .rar архива в папку osu! > Songs.
                    Все песни внутри сборки будут в формате .zip и/ли .osz, поэтому osu! потребуется их распаковать в следующий раз, когда вы начнёте играть.
                    Просим :scary распаковывать эти файлы самостоятельно,
                    так как карта может отображаться некорректно в osu! и не работать",
                'scary' => 'НЕ',
            ],
            'note' => [
                '_' => 'Также, советуем вам :scary, так как старые карты сильно уступают по качеству в отличие от новых.',
                'scary' => 'загружать карты, начиная с последних до старых',
            ],
        ],
        'title' => 'Сборки карт',
        'description' => 'Предварительно упакованные коллекции карт, основанные на общих темах.',
    ],

    'show' => [
        'download' => 'Скачать',
        'item' => [
            'cleared' => 'пройдено',
            'not_cleared' => 'не пройдено',
        ],
    ],

    'mode' => [
        'artist' => 'Исполнители/Альбомы',
        'chart' => 'Чарты',
        'standard' => 'Стандартные',
        'theme' => 'Темы',
    ],

    'require_login' => [
        '_' => 'Вы должны :link для загрузки',
        'link_text' => 'войти',
    ],
];
