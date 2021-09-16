<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'İptal et',

    'authorise' => [
        'request' => 'hesabınıza erişmek için izin istiyor.',
        'scopes_title' => 'Bu uygulama şunları yapabilecek:',
        'title' => 'Doğrulama Talebi',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Bu istemcinin izinlerini iptal etmek istediğinize emin misiniz?',
        'scopes_title' => 'Bu uygulama şunları yapabilir:',
        'owned_by' => ':user kişisine ait',
        'none' => 'İstemci yok',

        'revoked' => [
            'false' => 'Erişimi iptal et',
            'true' => 'Erişim iptal edildi',
        ],
    ],

    'client' => [
        'id' => 'İstemci ID',
        'name' => 'Uygulama Adı',
        'redirect' => 'Uygulama Geri Çağırma URL\'si',
        'reset' => 'İstemci anahtarını sıfırla',
        'reset_failed' => 'İstemci anahtarı sıfırlanamadı',
        'secret' => 'İstemci Anahtarı',

        'secret_visible' => [
            'false' => 'İstemci anahtarını göster',
            'true' => 'İstemci anahtarını gizle',
        ],
    ],

    'new_client' => [
        'header' => 'Yeni bir OAuth uygulaması kaydet',
        'register' => 'Uygulama kaydet',
        'terms_of_use' => [
            '_' => 'API\'yi kullanarak :link\'nı kabul ediyorsunuz.',
            'link' => 'Kullanım Koşulları',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Bu istemciyi silmek istediğinize emin misiniz?',
        'confirm_reset' => 'İstemci anahtarını sıfırlamak istediğinizden emin misiniz? Bu mevcut tüm tokenları kaldıracak.',
        'new' => 'Yeni OAuth Uygulaması',
        'none' => 'İstemci Yok',

        'revoked' => [
            'false' => 'Sil',
            'true' => 'Silindi',
        ],
    ],
];
