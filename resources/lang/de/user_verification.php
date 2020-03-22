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
        'sent' => 'Eine E-Mail mit einem Bestätigungscode wurde an :mail gesendet. Bitte gib diesen Code ein.',
        'title' => 'Accountverifizierung',
        'verifying' => 'Wird überprüft...',
        'issuing' => 'Erstelle einen neuen Code...',

        'info' => [
            'check_spam' => "Überprüfe auch deinen Spam-Ordner, wenn du die E-Mail nicht finden kannst.",
            'recover' => "Wenn du keinen Zugriff auf deine E-Mail hast oder nicht mehr weißt, welche du verwendest, dann gehe :link.",
            'recover_link' => 'hier zur E-Mail-Wiederherstellung',
            'reissue' => 'Du kannst auch einen :reissue_link oder dich :logout_link.',
            'reissue_link' => 'neuen Code anfordern',
            'logout_link' => 'ausloggen',
        ],
    ],

    'errors' => [
        'expired' => 'Der Bestätigungscode ist abgelaufen, eine neue E-Mail wurde gesendet.',
        'incorrect_key' => 'Inkorrekter Bestätigungscode.',
        'retries_exceeded' => 'Inkorrekter Bestätigungscode. Wiederholungslimit wurde überschritten, eine neue E-Mail wurde gesendet.',
        'reissued' => 'Neuer Bestätigungscode wurde angefordert, eine neue E-Mail wurde gesendet.',
        'unknown' => 'Ein unbekannter Fehler ist aufgetreten, eine neue E-Mail wurde gesendet.',
    ],
];
