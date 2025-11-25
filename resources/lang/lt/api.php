<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Negalima išsiųsti tuščios žinutės.',
            'limit_exceeded' => 'Jūs per greitai siunčiate žinutes, prašome palaukti prieš bandant iš naujo.',
            'too_long' => 'Žinutė kurią jūs norite išsiųsti yra per ilga.',
        ],
    ],

    'scopes' => [
        'bot' => 'Veikti kaip pokalbio botas.',
        'identify' => 'Nustatyti jūsų tapatybę ir skaityti jūsų viešąjį profilį.',

        'chat' => [
            'read' => 'Skaitykite žinutes jūsų vardu.',
            'write' => 'Siųsti žinutes jūsų vardu.',
            'write_manage' => 'Pridėti ir palikti kanalus jūsų vardu.',
        ],

        'forum' => [
            'write' => 'Kurti ir redaguoti forumo temas ir įrašus jūsų vardu.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Pažiūrėti ką jūs sekate.',
        ],

        'public' => 'Skaityti viešus duomenis jūsų valioje.',
    ],
];
