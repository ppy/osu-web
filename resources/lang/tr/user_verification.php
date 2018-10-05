<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'sent' => 'Doğrulama kodunu içeren bir e-posta :mail hesabınıza gönderilmiştir. Kodu giriniz.',
        'title' => 'Hesap Doğrulama',
        'verifying' => 'Doğrulanıyor...',
        'issuing' => 'Yeni kod veriliyor...',

        'info' => [
            'check_spam' => "E-postayı bulamıyorsanız hesabınızın \"spam\" klasörüne baktığınızdan emin olun.",
            'recover' => "E-mailinize ulaşamıyorsanız veya hangisini kullandığınızı unuttuysanız, lütfen şurayı takip ediniz :link.",
            'recover_link' => 'email kurtarma işlemi buradan',
            'reissue' => 'Şunları da yapabilirsiniz: :reissue_link veya :logout_link.',
            'reissue_link' => 'yeni kod isteyebilir',
            'logout_link' => 'çıkış yapabilirsiniz',
        ],
    ],

    'email' => [
        'subject' => 'osu! hesap doğrulama',
    ],

    'errors' => [
        'expired' => 'Doğrulama kodunun süresi doldu, yeni doğrulama e-postası yollandı.',
        'incorrect_key' => 'Hatalı doğrulama kodu.',
        'retries_exceeded' => 'Hatalı doğrulama kodu. Tekrar deneme sınırı aşıldı, yeni doğrulama e-postası gönderildi.',
        'reissued' => 'Doğrulama kodu yeniden verildi, yeni e-posta gönderildi.',
        'unknown' => 'Bilinmeyen hata oluştu, yeni doğrulama e-postası gönderildi.',
    ],
];
