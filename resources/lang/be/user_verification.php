<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Эл. ліст з кодам пацверджання быў адпраўлены на :mail. Увядзіце код пацверджання.',
        'title' => 'Верыфікацыя Акаўнту',
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
