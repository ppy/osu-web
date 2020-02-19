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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'Perbarui',
            'regenerating' => 'Memperbarui...',
            'remove' => 'Hapus',
            'removing' => 'Menghapus...',
            'title' => 'Sampul beatmap',
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
            'sections' => [
                'beatmapsets' => 'Set beatmap',
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
