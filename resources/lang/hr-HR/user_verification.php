<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Poslana je e-pošta na :mail sa potvrdim kodom. Unesi kod.',
        'title' => 'Potvrda računa',
        'verifying' => 'Potvrđivanje...',
        'issuing' => 'Izdavanje novog koda...',

        'info' => [
            'check_spam' => "Provjeri svoju mapu neželjene pošte ako ne možeš pronaći e-poštu.",
            'recover' => "Ako ne možeš pristupiti svojoj e-pošti ili si zaboravio što si koristio/la, slijedi :link.",
            'recover_link' => 'proces oporavka e-pošte ovdje',
            'reissue' => 'Također možeš :reissue_link ili :logout_link.',
            'reissue_link' => 'zatražiti novi kȏd',
            'logout_link' => 'odjaviti se',
        ],
    ],

    'box_totp' => [
        'heading' => '',

        'info' => [
            'logout' => [
                '_' => '',
                'link' => '',
            ],
            'mail_fallback' => [
                '_' => '',
                'link' => '',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'Kôd za potvrdu je istekao, poslana je nova e-pošta za potvrdu.',
        'incorrect_key' => 'Netočan kôd za potvrdu.',
        'retries_exceeded' => 'Krivi kôd za potvrdu. Prekoračeno je ograničenje ponovnog pokušavanja, poslana je nova e-poruka za potvrdu.',
        'reissued' => 'Kôd za potvrdu ponovno izdan, poslana je nova e-pošta za potvrdu.',
        'totp_used_key' => '',
        'totp_gone' => '',
        'unknown' => 'Došlo je do nepoznatog problema, poslana je nova e-pošta za potvrdu.',
    ],
];
