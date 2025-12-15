<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'E-pasts ir aizsūtīts uz :mail ar verifikācijas kodu. Ieraksti kodu.',
        'title' => 'Konta Verifikācija',
        'verifying' => 'Pārbauda...',
        'issuing' => 'Sūta jaunu kode...',

        'info' => [
            'check_spam' => "Pārliecinies ka esi arī pārbaudījis nevēlamajā sadaļā, ja tu nevari to atrast.",
            'recover' => "Ja tu nevari piekļūt savam e-pastam vai esi aizmirsis ko esi izmantojis, lūdzu seko saitei :link.",
            'recover_link' => 'e-pasta atgūšanas process šeit',
            'reissue' => 'Tu arī vari :reissue_link vai :logout_link.',
            'reissue_link' => 'pieprasīt vēl vienu kodu',
            'logout_link' => 'izrakstīties',
        ],
    ],

    'box_totp' => [
        'heading' => 'Lūdzu, ievadi kodu no savas autentifikatora lietotnes.',

        'info' => [
            'logout' => [
                '_' => 'Tu vari arī :link.',
                'link' => 'izrakstīties',
            ],
            'mail_fallback' => [
                '_' => 'Ja nevari piekļūt savai lietotnei, :link.',
                'link' => 'tu vari verificēt, izmantojot e-pastu',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'Verifikācijas kodam beidzies termiņš, aizsūtīts jauns verifikācijas e-pasts.',
        'incorrect_key' => 'Nepareizs verifikācijas kods.',
        'retries_exceeded' => 'Nepareizs verifikācijas kods. Mēģinājumu limits pārsniegts, aizsūtīts jauns verifikācijas e-pasts.',
        'reissued' => 'Verifikācijas kods atkārtoti izsniegts, aizstūtīts jauns verifikācijas e-pasts.',
        'totp_used_key' => 'Verifikācijas kods jau ir izmantots. Lūdzu, uzgaidi un izmanto jaunu.',
        'totp_gone' => 'Autentifikācijas marķieris ir noņemts, pārslēdzamies uz e-pasta verifikāciju. Verifikācijas e-pasts ir nosūtīts.',
        'unknown' => 'Uzradās nepazīstama problēma, aizsūtīts jauns verifikācijas e-pasts.',
    ],
];
