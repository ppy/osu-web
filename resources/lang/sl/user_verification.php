<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'E-poštno sporočilo je bilo poslano na :mail z verifikacijsko kodo. Vpiši zahtevano kodo.',
        'title' => 'Verifikacija računa',
        'verifying' => 'Verificiranje...',
        'issuing' => 'Pridobivanje nove kode...',

        'info' => [
            'check_spam' => "V primeru, da ne najdeš e-poštnega sporočila, poskrbi tudi, da pogledaš svojo vsijleno pošto.",
            'recover' => "V primeru, da ne moreš dostopati do svoje e-pošte ali pa si pozabil kateri e-poštni naslov si uporabil, prosimo sledi :link.",
            'recover_link' => 'postopku obnovitve e-pošte tukaj',
            'reissue' => 'Lahko tudi :reissue_link ali :logout_link.',
            'reissue_link' => 'prosiš za drugo kodo',
            'logout_link' => 'se izpišeš',
        ],
    ],

    'errors' => [
        'expired' => 'Verifikacijska koda je potekla, poslano je bilo novo e-poštno sporočilo z verifikacijsko kodo.',
        'incorrect_key' => 'Napačna verifikacijska koda.',
        'retries_exceeded' => 'Napačna verifikacijska koda. Omejitev ponovnih poskusov je bila presežena, poslano je bilo novo e-poštno sporočilo z verifikacijsko kodo.',
        'reissued' => 'Verifikacijska koda je bila ponovno izdana, poslano je bilo novo e-poštno sporočilo z verifikacijsko kodo.',
        'unknown' => 'Zgodila se je neznana napaka, poslano je bilo novo e-poštno sporočilo z verifikacijsko kodo.',
    ],
];
