<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Doğrulama kodunu içeren bir e-posta :mail adresine gönderilmiştir. Kodu giriniz.',
        'title' => 'Hesap Doğrulama',
        'verifying' => 'Doğrulanıyor...',
        'issuing' => 'Yeni kod veriliyor...',

        'info' => [
            'check_spam' => "E-postayı bulamıyorsanız hesabınızın \"spam\" klasörüne baktığınızdan emin olun.",
            'recover' => "E-postanıza ulaşamıyorsanız veya hangisini kullandığınızı unuttuysanız, lütfen :link takip ediniz.",
            'recover_link' => 'e-posta kurtarma işlemini',
            'reissue' => 'Aynı zamanda :reissue_link veya :logout_link.',
            'reissue_link' => 'yeni kod isteyebilir',
            'logout_link' => 'çıkış yapabilirsiniz',
        ],
    ],

    'box_totp' => [
        'heading' => 'Doğrulama uygulamanızdaki kodu girin.',

        'info' => [
            'logout' => [
                '_' => 'Aynı zamanda :link.',
                'link' => 'çıkış yap',
            ],
            'mail_fallback' => [
                '_' => 'Uygulamana erişemiyorsan, :link',
                'link' => 'bunun yerine e-posta ile doğrula',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'Doğrulama kodunun süresi doldu, yeni doğrulama e-postası yollandı.',
        'incorrect_key' => 'Hatalı doğrulama kodu.',
        'retries_exceeded' => 'Hatalı doğrulama kodu. Tekrar deneme sınırı aşıldı, yeni doğrulama e-postası gönderildi.',
        'reissued' => 'Doğrulama kodu yeniden verildi, yeni e-posta gönderildi.',
        'totp_used_key' => 'Doğrulama kodu zaten kullanıldı. Lütfen bekleyin ve yeni bir tane kullanın.',
        'totp_gone' => '',
        'unknown' => 'Bilinmeyen hata oluştu, yeni doğrulama e-postası gönderildi.',
    ],
];
