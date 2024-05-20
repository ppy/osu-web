<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'batch_disable' => 'Poista valitut käytöstä',
        'batch_enable' => 'Ota valitut käyttöön',

        'batch_confirm' => [
            '_' => ':action :items?',
            'disable' => 'Poista käytöstä',
            'enable' => 'Ota käyttöön',
            'items' => ':count_delimited kansikuva|:count_delimited kansikuvaa',
        ],

        'create_form' => [
            'files' => 'Tiedostot',
            'submit' => 'Tallenna',
            'title' => 'Lisää uusi',
        ],

        'item' => [
            'click_to_disable' => 'Poista käytöstä napsauttamalla',
            'click_to_enable' => 'Ota käyttöön napsauttamalla',
            'enabled' => 'Käytössä',
            'disabled' => 'Poissa käytöstä',
            'image_store' => 'Aseta kuva',
            'image_update' => 'Korvaa kuva',
        ],
    ],
    'store' => [
        'failed' => 'Kansikuvan luomisessa tapahtui virhe: :error',
        'ok' => 'Kansikuvat luotu',
    ],
];
