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
    'limitation_notice' => 'CATATAN: Pesan Anda hanya dapat diterima oleh para pengguna yang terhubung melalui <a href=":lazer_link">osu!lazer</a>.<br/>Apabila Anda tidak yakin, harap kirimkan pesan Anda melalui <a href=":oldpm_link">halaman forum PM lama</a>.',
    'talking_in' => 'berbicara pada :channel',
    'talking_with' => 'berbicara dengan :name',
    'title_compact' => 'percakapan',

    'cannot_send' => [
        'channel' => 'Saat ini Anda tidak dapat mengirimkan pesan pada kanal percakapan ini. Hal ini dapat disebabkan oleh beberapa alasan berikut:',
        'user' => 'Saat ini Anda tidak dapat mengirimkan pesan pada pada pengguna yang Anda tuju. Hal ini dapat disebabkan oleh beberapa alasan berikut:',
        'reasons' => [
            'blocked' => 'Anda sedang diblokir oleh penerima pesan yang Anda tuju',
            'channel_moderated' => 'Kanal percakapan ini sedang berada dalam status termoderasi',
            'friends_only' => 'Penerima pesan yang Anda tuju hanya menerima pesan-pesan masuk dari para pengguna yang ditambahkan sebagai teman',
            'restricted' => 'Anda saat ini berada dalam kondisi Restricted',
            'target_restricted' => 'Penerima pesan yang Anda tuju saat ini sedang berada dalam kondisi Restricted',
        ],
    ],
    'input' => [
        'disabled' => 'gagal mengirim pesan...',
        'placeholder' => 'ketikkan pesan...',
        'send' => 'Kirim',
    ],
    'no-conversations' => [
        'howto' => "Mulailah suatu percakapan dengan meng-klik tombol yang tersedia pada halaman profil atau kartu pop-up pengguna.",
        'lazer' => 'Kanal-kanal percakapan yang Anda buka melalui <a href=":link">osu!lazer</a> juga akan terlihat di sini.',
        'pm_limitations' => 'Pesan Anda hanya dapat diterima oleh para pengguna yang menggunakan <a href=":link">osu!lazer</a> atau website baru.',
        'title' => 'belum ada percakapan',
    ],
];
