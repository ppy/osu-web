<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Pranešimas buvo išsiųstas į :mail su atpažinimo kodu. Įrašyk kodą.',
        'title' => 'Paskyros patvirtinimas',
        'verifying' => 'Patvirtinama...',
        'issuing' => 'Sukuriamas naujas kodas...',

        'info' => [
            'check_spam' => "Patikrinkite savo šlamšto aplanką jei nerandate el. laiško.",
            'recover' => "Jei negalite pasiekti savo el. pašto ar pamiršote koki naudojote, naudokite :link.",
            'recover_link' => 'el. pašto atstatymo procesą',
            'reissue' => 'Taip pat galite :reissue_link arba :logout_link.',
            'reissue_link' => 'prašyti kito kodo',
            'logout_link' => 'atsijungti',
        ],
    ],

    'errors' => [
        'expired' => 'Atpažinimo kodas pasibaigė. Naujas patvirtinimo pranešimas išsiųstas.',
        'incorrect_key' => 'Neteisingas patvirtinimo kodas.',
        'retries_exceeded' => 'Neteisingas atpažinimo kodas. Bandymų limitas pasiektas, išsiųstas naujas patvitinimo pranešimas.',
        'reissued' => 'Naujas atpažinimo kodas sukurtas, išsiųstas patvirtinimo pranešimas.',
        'unknown' => 'Iškilo nežinoma problema, naujas patvirtinimo pranešimas išsiųstas.',
    ],
];
