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
    'cancel' => 'Batal',

    'authorise' => [
        'request' => 'meminta izin untuk mengakses ke dalam akun Anda.',
        'scopes_title' => 'Ke depannya, aplikasi ini akan mampu untuk:',
        'title' => 'Permohonan Otorisasi',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Apakah anda yakin untuk mencabut izin akses klien ini?',
        'scopes_title' => 'Aplikasi ini dapat:',
        'owned_by' => 'Dimiliki oleh :user',
        'none' => 'Tidak ada klien',

        'revoked' => [
            'false' => 'Cabut akses',
            'true' => 'Akses telah dicabut',
        ],
    ],

    'client' => [
        'id' => 'ID Klien',
        'name' => 'Nama Aplikasi',
        'redirect' => 'Application Callback URL',
        'secret' => 'Client Secret',
    ],

    'new_client' => [
        'header' => 'Daftarkan aplikasi OAuth baru',
        'register' => 'Daftarkan aplikasi',
        'terms_of_use' => [
            '_' => 'Dengan menggunakan API kami Anda menyetujui :link berikut.',
            'link' => 'Syarat Penggunaan',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Apakah anda yakin untuk menghapus klien ini?',
        'new' => 'Aplikasi OAuth anyar',
        'none' => 'Tidak ada klien',

        'revoked' => [
            'false' => 'Hapus',
            'true' => 'Telah dihapus',
        ],
    ],
];
