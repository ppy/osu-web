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
            'important' => 'ПРОЧИТАЙТЕ ЭТО ПЕРЕД ЗАГРУЗКОЙ',
            'instruction' => [
                '_' => "Установка: Когда пак с картами загрузится, разархивируйте .rar файл в вашу osu! директорию с битмапами.
                    Все песни будут в .zip или .osz внутри пака, поэтому osu! потребуется экспортировать все карты самостоятельно как только вы войдете в игровой режим.
                    :scary экспортируйте .zip/.osz вручную,
                    или карты будут показываться не правильно в osu! и не будут работать как полагается.",
                'scary' => 'НЕ',
            ],
            'note' => [
                '_' => 'Также, обратите внимание что мы очень рекомендуем :scary, так как самые старые карты имеют значительно низкое качество чем новые.',
                'scary' => 'скачивать новые паки больше, чем старые',
            ],
        ],
        'title' => 'Паки карт',
        'description' => 'Запакованные колекции карт основанные на одной теме.',
    ],
    'show' => [
        'download' => 'Скачать',
        'item' => [
            'cleared' => 'Пройденно',
            'not_cleared' => 'Не пройденно',
        ],
    ],
    'mode' => [
        'artist' => 'Артист/Альбом',
        'chart' => 'Чарт',
        'standard' => 'Стандарт',
        'theme' => 'Тема',
    ],
    'require_login' => [
        '_' => 'Вам необходимо :link что бы скачивать',
        'link_text' => 'войти в аккаунт',
    ],
];
