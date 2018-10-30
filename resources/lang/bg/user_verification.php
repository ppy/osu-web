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
    'box' => [
        'sent' => 'Електронно писмо бе изпратено до :mail с кот за потвърждение. Въведете кода.',
        'title' => 'Потвърждение на акаунта',
        'verifying' => 'Потвърждаване...',
        'issuing' => 'Издаване на нов код...',

        'info' => [
            'check_spam' => "Моля проверете папката спам ако не можете да откриете електронното писмо.",
            'recover' => "Ако нямате достъп до вашият имейл или сте забравили какво сте използвали, моля следвайте :link.",
            'recover_link' => 'процедура за възстановяване на имейл тук',
            'reissue' => 'Можете също така :reissue_link или :logout_link.',
            'reissue_link' => 'поискайте друг код',
            'logout_link' => 'изход',
        ],
    ],

    'email' => [
        'subject' => 'потвърждение на osu! акаунт',
    ],

    'errors' => [
        'expired' => 'Кодът за потвърждение е с изтекъл срок, ново електронно писмо бе пратено на пощата ви.',
        'incorrect_key' => 'Грешен код за потвърждение.',
        'retries_exceeded' => 'Грешен код за потвърждение. Лимитът за повторни опити е превишен, ново електронно писмо бе пратено на пощата ви.',
        'reissued' => 'Нов код за потвърждение бе създаден, ново електронно писмо бе пратено на пощата ви.',
        'unknown' => 'Изникна необичаен проблем, ново електронно писмо бе пратено на пощата ви.',
    ],
];
