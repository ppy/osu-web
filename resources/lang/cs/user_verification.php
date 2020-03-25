<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Na email :mail jsme poslali ověřovací kód. Zadej ho prosím.',
        'title' => 'Ověření účtu',
        'verifying' => 'Probíhá ověřování...',
        'issuing' => 'Vydávání nového kódu...',

        'info' => [
            'check_spam' => "Pokud email nevidíš, zkus se podívat do složky se spamem.",
            'recover' => "Pokud nemáš přístup ke svému emailu nebo jsi zapomněl jaký jsi použil, prosím postupuj podle :link.",
            'recover_link' => 'proces pro obnovení emailu zde',
            'reissue' => 'Můžeš také :reissue_link nebo :logout_link.',
            'reissue_link' => 'vyžádat další kód',
            'logout_link' => 'odhlásit se',
        ],
    ],

    'errors' => [
        'expired' => 'Ověřovací kód vypršel, byl zaslán nový ověřovací email.',
        'incorrect_key' => 'Nesprávný ověřovací kód.',
        'retries_exceeded' => 'Nesprávný ověřovací kód. Limit pokusů dosažen, byl zaslán nový ověřovací email.',
        'reissued' => 'Ověřovací kód znovu vygenerován, byl zaslán nový ověřovací email.',
        'unknown' => 'Vyskytl se neznámý problém, byl zaslán nový ověřovací email.',
    ],
];
