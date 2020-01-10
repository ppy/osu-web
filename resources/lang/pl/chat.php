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
    'limitation_notice' => 'UWAGA: Tylko użytkownicy, którzy używają <a href=":lazer_link">osu!lazer</a> lub nowej strony osu! otrzymają wiadomości przez ten czat.<br/>Jeżeli nie masz pewności, wyślij wiadomość poprzez <a href=":oldpm_link">stare forum</a>.',
    'talking_in' => 'rozmowa na kanale :channel',
    'talking_with' => 'rozmowa z użytkownikiem :name',
    'title_compact' => 'czat',

    'cannot_send' => [
        'channel' => 'Nie możesz wysłać wiadomości na ten kanał z jednego z następujących powodów:',
        'user' => 'Nie możesz wysłać wiadomości do tego użytkownika z jednego z następujących powodów:',
        'reasons' => [
            'blocked' => 'Ten użytkownik zablokował cię',
            'channel_moderated' => 'Ten kanał jest w trybie tylko dla moderatorów',
            'friends_only' => 'Ten użytkownik nie przyjmuje wiadomości od osób spoza listy znajomych',
            'restricted' => 'Twoje konto zostało zablokowane',
            'target_restricted' => 'Konto tego użytkownika jest obecnie zablokowane',
        ],
    ],
    'input' => [
        'disabled' => 'nie udało się wysłać wiadomości...',
        'placeholder' => 'napisz wiadomość...',
        'send' => 'Wyślij',
    ],
    'no-conversations' => [
        'howto' => "Rozpocznij konwersację poprzez profil lub kartę użytkownika.",
        'lazer' => 'Publiczne kanały, do których dołączysz poprzez <a href=":link">osu!lazer</a>, także będą tutaj widoczne.',
        'pm_limitations' => 'Tylko użytkownicy, którzy używają <a href=":link">osu!lazer</a> lub nowej strony osu! otrzymają wiadomości prywatne.',
        'title' => 'brak konwersacji',
    ],
];
