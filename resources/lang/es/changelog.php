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
    'feed_title' => 'lista',
    'generic' => 'Corrección de errores y mejoras menores.',

    'build' => [
        'title' => 'cambios en :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited usuario en línea|:count_delimited usuarios en línea',
    ],

    'entry' => [
        'by' => 'por :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'lista de cambios',
            '_from' => 'cambios desde :from',
            '_from_to' => 'cambios entre :from y :to',
            '_stream' => 'cambios en :stream',
            '_stream_from' => 'cambios en :stream desde :from',
            '_stream_from_to' => 'cambios en :stream entre :from y :to',
            '_stream_to' => 'cambios en :stream hasta :to',
            '_to' => 'cambios hasta :to',
        ],

        'title' => [
            '_' => 'Lista de cambios :info',
            'info' => 'Listando',
        ],
    ],

    'support' => [
        'heading' => '¿Amas esta actualización?',
        'text_1' => '¡Apoyar a un mayor desarrollo de osu! y: :link hoy!',
        'text_1_link' => 'vuélvete un supporter',
        'text_2' => 'No solo ayudará a acelerar el desarrollo,!también obtendrás algunas características adicionales y personalizaciones!',
    ],
];
