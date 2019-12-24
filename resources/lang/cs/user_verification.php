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
