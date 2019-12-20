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
        'sent' => 'Un e-mail a fost trimis la :mail cu un cod de verificare. Introdu codul.',
        'title' => 'Verificarea contului',
        'verifying' => 'Se verifică...',
        'issuing' => 'Se trimite un cod nou...',

        'info' => [
            'check_spam' => "Verifică-ți folderul spam dacă nu poți găsi e-mailul.",
            'recover' => "Dacă nu-ți poți accesa e-mailul sau ai uitat ce adresă ai folosit, te rugăm să urmezi :link.",
            'recover_link' => 'procesul de recuperare al e-mailului aici',
            'reissue' => 'Poți, de asemenea, :reissue_link sau să :logout_link.',
            'reissue_link' => 'să soliciți un alt cod',
            'logout_link' => 'te deconectezi',
        ],
    ],

    'errors' => [
        'expired' => 'Codul de verificare a expirat, a fost trimis un nou e-mail de verificare.',
        'incorrect_key' => 'Cod de verificare incorect.',
        'retries_exceeded' => 'Cod de verificare incorect. Limita de reîncercări a fost depășită, a fost trimis un nou e-mail de verificare.',
        'reissued' => 'Un nou cod de verificare a fost generat și trimis, te rugăm să-ți verifici e-mailul.',
        'unknown' => 'A apărut o problemă necunoscută, a fost trimis un e-mail de verificare nou.',
    ],
];
