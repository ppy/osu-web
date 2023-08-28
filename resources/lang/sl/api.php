<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Praznega sporočila ni možno poslati.',
            'limit_exceeded' => 'Sporočila pošiljate prehitro. Prosimo, malo počakajte, preden zopet poskusite.',
            'too_long' => 'Sporočilo je predolgo.',
        ],
    ],

    'scopes' => [
        'bot' => 'Delovanje kot klepetalni robot.',
        'identify' => 'Identifikacija in branje tvojega javnega profila.',

        'chat' => [
            'write' => 'Pošlji sporočila v tvojem imenu.',
        ],

        'forum' => [
            'write' => 'Ustvari in uredi teme in objave na forumu v tvojem imenu.',
        ],

        'friends' => [
            'read' => 'Prikaži komu slediš.',
        ],

        'public' => 'Branje javnih podatkov v tvojem imenu.',
    ],
];
