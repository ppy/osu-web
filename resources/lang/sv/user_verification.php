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
    'box' => [
        'sent' => 'Ett email att skickats till :mail med en verifikations kod. Skriv in koden.',
        'title' => 'Konto Verifiering',
        'verifying' => 'Verifieras...',
        'issuing' => 'Utfärdar ny kod...',

        'info' => [
            'check_spam' => 'Dubbelkolla din skräpkorg ifall du inte kan hitta emailet.',
            'recover' => 'Om du inte har åtkomst till din email eller har glömt vad du använde, var vänlig att följa :link.',
            'recover_link' => 'email återställning processen här',
            'reissue' => 'Du kan också :reissue_link eller :logout_link.',
            'reissue_link' => 'begära annan kod',
            'logout_link' => 'logga ut',
        ],
    ],

    'email' => [
        'subject' => 'osu! konto verifiering',
    ],

    'errors' => [
        'expired' => 'Verifierings kod är utgången, ny verifierings email skickad.',
        'incorrect_key' => 'Felaktig verifierings kod.',
        'retries_exceeded' => 'Felaktig verifierings kod. Försöks gräns uppnådd, ny verifierings email skickad.',
        'reissued' => 'Verifierings kod återutfärdat, ny verifierings email skickad.',
        'unknown' => 'Okänt problem uppstod, ny verifierings email skickad.',
    ],
];
