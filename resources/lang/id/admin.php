<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'Perbarui',
            'regenerating' => 'Memperbarui...',
            'remove' => 'Hapus',
            'removing' => 'Menghapus...',
        ],
        'show' => [
            'covers' => 'Kelola Sampul Beatmapset',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'aktifkan',
                'activate_confirm' => 'aktifkan modding v2 untuk beatmap ini?',
                'active' => 'aktif',
                'inactive' => 'nonaktif',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Hapus',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'Sampul belum diatur',

                'submit' => [
                    'save' => 'Simpan',
                    'update' => 'Perbarui',
                ],

                'title' => 'Daftar Sampul Forum',

                'type-title' => [
                    'default-topic' => 'Sampul Forum Standar',
                    'main' => 'Sampul Forum',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Pemantau Log',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Konsol Admin',

            'sections' => [
                'forum' => 'Forum',
                'general' => 'Umum',
                'store' => 'Toko',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Daftar Pesanan',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Pengguna ini sedang dalam status dibatasi.',
            'message' => '(hanya admin yang dapat melihat pesan ini)',
        ],
    ],

];
