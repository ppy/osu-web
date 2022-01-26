<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Предварительно упакованные коллекции карт, основанные на общих темах.',
        'nav_title' => 'список',
        'title' => 'Сборки карт',

        'blurb' => [
            'important' => 'ПРОЧИТАЙТЕ ЭТО ПЕРЕД ЗАГРУЗКОЙ',
            'install_instruction' => 'Установка: как только Вы скачали сборку, распакуйте её содержимое в папку Songs директории osu!, всё остальное сделает игра.',
            'note' => [
                '_' => 'Также строго советуем вам :scary, так как старые карты куда менее качественны, чем созданные совсем недавно.',
                'scary' => 'загружать карты, начиная со свежих',
            ],
        ],
    ],

    'show' => [
        'download' => 'Скачать',
        'item' => [
            'cleared' => 'пройдено',
            'not_cleared' => 'не пройдено',
        ],
        'no_diff_reduction' => [
            '_' => ':link не должны быть использованы при прохождении этой сборки.',
            'link' => 'Упрощающие игру моды',
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
