<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    'errors' => [
        'expired' => 'Doğrulama kodunun süresi doldu, yeni doğrulama e-postası yollandı.',
        'incorrect_key' => 'Hatalı doğrulama kodu.',
        'retries_exceeded' => 'Hatalı doğrulama kodu. Tekrar deneme sınırı aşıldı, yeni doğrulama e-postası gönderildi.',
        'reissued' => 'Doğrulama kodu yeniden verildi, yeni e-posta gönderildi.',
        'unknown' => 'Bilinmeyen hata oluştu, yeni doğrulama e-postası gönderildi.',
    ],
];
