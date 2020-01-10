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
    'box' => [
        'sent' => 'Эл. ліст з кодам пацверджання быў адпраўлены на :mail. Увядзіце код пацверджання.',
        'title' => 'Пацверджанне ўліковага запісу',
        'verifying' => 'Ідзе пацверджанне...',
        'issuing' => 'Адпраўка новага коду...',

        'info' => [
            'check_spam' => "Калі не можаце знайсці эл. ліст, праверце папку са спамам.",
            'recover' => "Калі вы згубілі доступ да сваёй эл. пошты або забылі яе, перайдзіце :link.",
            'recover_link' => 'працэс аднаўлення эл. пошты тут',
            'reissue' => 'Вы таксама можаце :reissue_link або :logout_link.',
            'reissue_link' => 'запытаць іншы код',
            'logout_link' => 'выйсці',
        ],
    ],

    'errors' => [
        'expired' => 'Тэрмін коду пацверджання скончыўся, новы код быў адпраўлены на эл. пошту.',
        'incorrect_key' => 'Няправільны код пацверджання.',
        'retries_exceeded' => 'Няправільны код пацверджання. Ліміт спроб перавышаны, новы код быў адпраўлены на эл. пошту.',
        'reissued' => 'Адпраўлены эл. ліст з іншым кодам.',
        'unknown' => 'Узнікла невядомая памылка, новы код пацверджання быў адпраўлены на эл. пошту.',
    ],
];
