<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Batal',

    'authorise' => [
        'request' => 'meminta izin untuk dapat mengakses akun Anda.',
        'scopes_title' => 'Ke depannya, aplikasi ini akan mampu untuk:',
        'title' => 'Permohonan Otorisasi',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Apakah anda yakin untuk mencabut izin akses klien ini?',
        'scopes_title' => 'Aplikasi ini dapat:',
        'owned_by' => 'Dimiliki oleh :user',
        'none' => 'Tidak Ada Klien',

        'revoked' => [
            'false' => 'Cabut Akses',
            'true' => 'Akses Telah Dicabut',
        ],
    ],

    'client' => [
        'id' => 'ID Klien',
        'name' => 'Nama Aplikasi',
        'redirect' => 'Application Callback URL',
        'reset' => 'Atur ulang client secret',
        'reset_failed' => 'Pengaturan ulang client secret gagal',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Tampilkan client secret',
            'true' => 'Sembunyikan client secret',
        ],
    ],

    'new_client' => [
        'header' => 'Daftarkan aplikasi OAuth baru',
        'register' => 'Daftarkan aplikasi',
        'terms_of_use' => [
            '_' => 'Dengan menggunakan API kami, Anda menyetujui :link berikut.',
            'link' => 'Ketentuan Penggunaan',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Apakah Anda yakin untuk menghapus klien ini?',
        'confirm_reset' => 'Apakah Anda yakin untuk mengatur ulang client secret? Tindakan ini akan menganulir izin akses token-token yang telah diotorisir sebelumnya.',
        'new' => 'Buat Aplikasi OAuth Baru',
        'none' => 'Tidak Ada Klien',

        'revoked' => [
            'false' => 'Hapus',
            'true' => 'Telah dihapus',
        ],
    ],
];
