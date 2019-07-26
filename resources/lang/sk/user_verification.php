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

    'email' => [
        'subject' => 'overenie osu! účtu',
    ],

    'errors' => [
        'expired' => 'Overovací kód vypršal, bol zaslaný nový overovací email.',
        'incorrect_key' => 'Nesprávny overovací kód.',
        'retries_exceeded' => 'Nesprávny overovací kód. Limit pokusov bol dosiahnutý, bol zaslaný nový overovací e-mail.',
        'reissued' => 'Overovací kôd bol znovú vygenerovaný, bol zaslaný nový overovací email.',
        'unknown' => 'Naskytol sa neznámý problém, bol zaslaný nový overovací email.',
    ],
];
