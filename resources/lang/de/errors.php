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
    'codes' => [
        'http-401' => 'Zum Fortfahren bitte einloggen.',
        'http-403' => 'Zugriff verweigert.',
        'http-404' => 'Nicht gefunden.',
        'http-429' => 'Zu viele Anfragen. Versuche es später noch mal.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Ein Fehler ist aufgetreten. Bitte Seite neu laden',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Ungültiger Modus gewählt.',
        'standard_converts_only' => 'Es gibt keine Ranglisten für den angeforderten Modus auf dieser Schwierigkeitsstufe',
    ],
    'checkout' => [
        'generic' => 'Bei der Vorbereitung Ihrer Bestellung ist ein Fehler aufgetreten.',
    ],
    'search' => [
        'default' => 'Keine Ergebnisse gefunden, versuche es später erneut.',
        'operation_timeout_exception' => 'Die Suche ist derzeit höher ausgelastet als normal, versuche es später erneut.',
    ],

    'logged_out' => 'Du wurdest ausgeloggt. Einloggen und erneut versuchen.',
    'supporter_only' => 'Für dieses Feature muss man Supporter sein.',
    'no_restricted_access' => 'Diese Aktion steht nicht zur Verfügung, während der Account eingeschränkt ist.',
    'unknown' => 'Unbekannter Fehler aufgetreten.',
];
