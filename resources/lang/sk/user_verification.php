<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Na e-mail sme ti poslali overovací kód :mail. Prosím zadaj ho.',
        'title' => 'Overenie Účtu',
        'verifying' => 'Overovanie...',
        'issuing' => 'Vydávanie nového kódu...',

        'info' => [
            'check_spam' => "Pokiaľ nemôžeš nájsť e-mail skús sa pozrieť do zložky so spamom.",
            'recover' => "Pokiaľ nemáš prístup k svojmu e-mailu alebo si zabudol aký si použil, prosím postupuj podľa :link.",
            'recover_link' => 'proces pre obnovu e-mailu tu',
            'reissue' => 'Taktiež môžeš :reissue_link alebo :logout_link.',
            'reissue_link' => 'vyžiadať ďalší kód',
            'logout_link' => 'odhlásiť sa',
        ],
    ],

    'errors' => [
        'expired' => 'Overovací kód vypršal, bol zaslaný nový overovací email.',
        'incorrect_key' => 'Nesprávny overovací kód.',
        'retries_exceeded' => 'Nesprávny overovací kód. Limit pokusov bol dosiahnutý, bol zaslaný nový overovací e-mail.',
        'reissued' => 'Overovací kôd bol znovú vygenerovaný, bol zaslaný nový overovací email.',
        'unknown' => 'Naskytol sa neznámý problém, bol zaslaný nový overovací email.',
    ],
];
