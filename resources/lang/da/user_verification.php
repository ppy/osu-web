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
        'sent' => 'En email er blevet sendt til :mail med en bekræftelseskode. Skriv koden her.',
        'title' => 'Kontobekræftelse',
        'verifying' => 'Bekræfter...',
        'issuing' => 'Laver ny kode...',

        'info' => [
            'check_spam' => 'Husk at tjekke din spammappe, hvis ikke du kan finde emailen.',
            'recover' => 'Hvis ikke du har adgang til din email-adresse eller har glemt hvilken email-adresse, du bruger, følg venligst :link.',
            'recover_link' => 'email-adresse genoprettelsesprocessen her',
            'reissue' => 'Du kan også :reissue_link eller :logout_link.',
            'reissue_link' => 'anmode om en ny kode',
            'logout_link' => 'logge ud',
        ],
    ],

    'email' => [
        'subject' => 'osu! kontobekræftelse',
    ],

    'errors' => [
        'expired' => 'Bekræftelseskoden er udløbet, og en ny email med bekræftelseskode er blevet sendt.',
        'incorrect_key' => 'Ugyldig bekræftelseskode.',
        'retries_exceeded' => 'Ugyldig bekræftelseskode, og du har brugt for mange forsøg. En ny email med bekræftelseskode er blevet sendt.',
        'reissued' => 'En email med en ny bekræftelseskode er blevet sendt.',
        'unknown' => 'Der opstod et ukendt problem. En ny email med bekræftelseskode er blevet sendt.',
    ],
];
