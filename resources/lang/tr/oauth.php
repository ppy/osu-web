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
    'cancel' => 'İptal et',

    'authorise' => [
        'request' => 'hesabınıza erişmek için izin istiyor.',
        'scopes_title' => 'Bu uygulama şunları yapabilecek:',
        'title' => 'İzin İsteği',
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
        'secret' => 'İstemci Anahtarı',
    ],

    'new_client' => [
        'header' => 'Yeni bir OAuth uygulaması kaydet',
        'register' => 'Uygulama Kaydet',
        'terms_of_use' => [
            '_' => 'API\'yı kullanarak kullanım koşullarını kabul ediyorsunuz: :link.',
            'link' => 'Kullanım Koşulları',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Bu istemciyi silmek istediğinize emin misiniz?',
        'new' => 'Yeni OAuth uygulaması',
        'none' => 'İstemci yok',

        'revoked' => [
            'false' => 'Sil',
            'true' => 'Silindi',
        ],
    ],
];
