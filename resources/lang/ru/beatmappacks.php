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
    'index' => [
        'blurb' => [
            'important' => 'ПРОЧИТАЙТЕ ПЕРЕД ЗАГРУЗКОЙ',
            'instruction' => [
                '_' => 'Установка: после того как сборка будет загружена, распакуйте содержимое архива в папке osu! > Songs.
                    Все песни внутри сборки заранее заархивированы в формате .zip или .osz. osu! сама распакует эти файлы в следующий раз, когда Вы запустите игру.
                    :scary распаковывать эти файлы вручную,
                    иначе они могут работать в osu! некорректно.',
                'scary' => 'НЕ СТОИТ',
            ],
            'note' => [
                '_' => 'К тому же советуем :scary, так как старые сборки имеют качество хуже по сравнению с новыми.', // help
                'scary' => 'загружать преимущественно новые сборки',
            ],
        ],
        'title' => 'Сборки карт',
        'description' => 'Pre-packaged collections of beatmaps based around a common theme.', // idk where it's used
    ],

    'show' => [
        'download' => 'Скачать',
        'item' => [
            'cleared' => 'очищено',
            'not_cleared' => 'не очищено',
        ],
    ],

    'mode' => [
        'artist' => 'Исполнитель/Альбом',
        'chart' => 'Чарты', // help
        'standard' => 'Стандартные', // help
        'theme' => 'Тематические',
    ],

    'require_login' => [
        '_' => 'Вы должны :link для загрузки',
        'link_text' => 'войти',
    ],
];
