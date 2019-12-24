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
        'sent' => 'Ett email har skickats till :mail med en verifieringskod. Skriv in koden.',
        'title' => 'Kontobekräftelse',
        'verifying' => 'Verifierar...',
        'issuing' => 'Skickar ny kod...',

        'info' => [
            'check_spam' => "Dubbelkolla skräpposten ifall du inte kan hitta emailet.",
            'recover' => "Om du inte har tillgång till din email eller har glömt vad du använde, var vänlig följ :link.",
            'recover_link' => 'email återställning processen här',
            'reissue' => 'Du kan också :reissue_link eller :logout_link.',
            'reissue_link' => 'begär en ny kod',
            'logout_link' => 'logga ut',
        ],
    ],

    'errors' => [
        'expired' => 'Verifieringskoden har utgått, ett nytt bekräftelsemail har skickats.',
        'incorrect_key' => 'Felaktig verifieringskod.',
        'retries_exceeded' => 'Felaktig verifieringskod. Försöksgräns uppnådd, ett nytt bekräftelsemail har skickats.',
        'reissued' => 'Verifieringskod återutfärdad, ett nytt bekräftelsemail har skickats.',
        'unknown' => 'Ett okänt problem uppstod, ett nytt bekräftelsemail har skickats.',
    ],
];
