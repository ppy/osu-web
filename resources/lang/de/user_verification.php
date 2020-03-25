<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
