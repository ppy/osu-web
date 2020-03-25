<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
