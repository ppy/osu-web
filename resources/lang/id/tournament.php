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
    'index' => [
        'none_running' => 'Tidak ada turnamen yang berlangsung saat ini, silakan periksa lagi nanti!',
        'registration_period' => 'Pendaftaran: :start sampai :end',

        'header' => [
            'subtitle' => 'Daftar turnamen resmi yang sedang berlangsung',
            'title' => 'Turnamen Komunitas',
        ],

        'item' => [
            'registered' => 'Pemain yang terdaftar',
        ],

        'state' => [
            'current' => 'Turnamen yang sedang berlangsung',
            'previous' => 'Turnamen Sebelumnya',
        ],
    ],

    'show' => [
        'banner' => 'Dukung Tim Anda',
        'entered' => 'Anda telah berhasil mendaftarkan diri Anda pada turnamen ini. <br><br>Mohon diperhatikan bahwa hal ini bukan berarti Anda telah secara otomatis telah diikutsertakan ke dalam salah satu tim yang bertanding. <br><br>Instruksi lebih lanjut akan dikirimkan melalui email saat turnamen akan dimulai, jadi mohon pastikan alamat email akun osu! Anda valid!',
        'info_page' => 'Laman Informasi',
        'login_to_register' => 'Harap :login untuk melihat rincian pendaftaran!',
        'not_yet_entered' => 'Anda tidak terdaftar pada turnamen ini.',
        'rank_too_low' => 'Maaf, Anda tidak memenuhi persyaratan peringkat untuk mengikuti turnamen ini!',
        'registration_ends' => 'Pendaftaran ditutup pada tanggal :date',

        'button' => [
            'cancel' => 'Batalkan Pendaftaran',
            'register' => 'Daftarkan saya!',
        ],

        'state' => [
            'before_registration' => 'Pendaftaran untuk turnamen ini masih belum dibuka.',
            'ended' => 'Turnamen ini telah berakhir. Silakan periksa laman informasi untuk hasil turnamen.',
            'registration_closed' => 'Pendaftaran untuk turnamen ini telah ditutup. Mohon periksa laman informasi untuk informasi lebih lanjut.',
            'running' => 'Turnamen ini sedang berlangsung. Mohon periksa laman informasi untuk informasi lebih lanjut.',
        ],
    ],
    'tournament_period' => ':start sampai :end',
];
