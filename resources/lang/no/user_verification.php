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
        'sent' => 'En e-post har blitt sendt til :mail med en bekreftelseskode. Skriv inn koden.',
        'title' => 'Kontobekreftelse',
        'verifying' => 'Verifiserer...',
        'issuing' => 'Sender ny kode...',

        'info' => [
            'check_spam' => "Husk å sjekke spam-mappen din hvis du ikke finner e-posten.",
            'recover' => "Hvis du ikke får tilgang til e-post kontoen din eller har glemt hva du brukte, vennligst følg denne :link.",
            'recover_link' => 'e-post gjenopprettingsprosess her',
            'reissue' => 'Du kan også :reissue_link eller :logout_link.',
            'reissue_link' => 'be om en annen kode',
            'logout_link' => 'logg ut',
        ],
    ],

    'errors' => [
        'expired' => 'Bekreftelseskoden har utløpt, ny bekreftelsesmail sendt.',
        'incorrect_key' => 'Ugyldig bekreftelseskode.',
        'retries_exceeded' => 'Ugyldig bekreftelseskode. Antall tillatte forsøk overskredet, ny bekreftelsesmail sendt.',
        'reissued' => 'Bekreftelseskoden har blitt gjenutgitt, ny bekreftelsesmail sendt.',
        'unknown' => 'Et ukjent problem har forekommet, ny bekreftelsesmail sendt.',
    ],
];
