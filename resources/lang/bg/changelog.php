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
    'feed_title' => 'емисия',
    'generic' => 'Почистване на бъгове и малки подобрения',

    'build' => [
        'title' => 'промени в :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited потребител онлайн|:count_delimited потребители онлайн',
    ],

    'entry' => [
        'by' => 'от :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'списък на промените',
            '_from' => 'промени от :from',
            '_from_to' => 'промени между :from и :to',
            '_stream' => 'промени в :stream',
            '_stream_from' => 'промени в :stream от :from',
            '_stream_from_to' => 'промени в :stream между :from и :to',
            '_stream_to' => 'промени в :stream до :to',
            '_to' => 'промени до :to',
        ],

        'title' => [
            '_' => 'Промени :info',
            'info' => 'Списък',
        ],
    ],

    'support' => [
        'heading' => 'Харесвате ли тази актуализация?',
        'text_1' => 'Подкрепи по-нататъшно развитие на osu! и :link днес!',
        'text_1_link' => 'станете osu!supporter',
        'text_2' => 'Вие не само ще подкрепите разработката на играта, но и също ще получите допълнителни функции и опции за персонализация!',
    ],
];
