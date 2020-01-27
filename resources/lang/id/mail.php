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
    'beatmapset_update_notice' => [
        'new' => 'Pemberitahuan bahwa ada pembaruan dalam beatmap ":title" sejak kunjungan terakhir kamu.',
        'subject' => 'Pembaruan baru untuk beatmap ":title"',
        'unwatch' => 'Jika kamu tidak lagi ingin mengikuti informasi beatmap ini, kamu dapat mengklik tautan "Unwatch" yang dapat ditemukan di atas laman ini, atau dari laman modding daftar pantauan:',
        'visit' => 'Kunjungi laman diskusi di sini:',
    ],

    'common' => [
        'closing' => 'Salam,',
        'hello' => 'Hai :user,',
        'report' => 'Harap balas email ini SEGERA jika kamu tidak tahu mengenai perubahan ini.',
    ],

    'forum_new_reply' => [
        'new' => 'Kami ingin memberitahukan bahwa saat ini terdapat balasan baru pada ":title" sejak kunjungan terakhir Anda.',
        'subject' => '[osu!] Balasan terbaru dari topik ":title"',
        'unwatch' => 'Jika kamu tidak lagi ingin mengikuti informasi seputar thread forum ini, Anda dapat meng-klik link "Unsubscripe Topic" yang dapat ditemukan di atas halaman ini, atau melalui laman Langganan Forum berikut:',
        'visit' => 'Anda dapat segera melihat balasan terbaru melalui link berikut:',
    ],

    'password_reset' => [
        'code' => 'Kode verifikasi kamu adalah:',
        'requested' => 'Baik kamu atau seseorang yang berpura-pura menjadi kamu telah meminta pengaturan ulang kata sandi akun osu! kamu.',
        'subject' => 'Pemulihan akun osu!',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Kami telah menerima pembayaranmu dan sedang mempersiapkan pesananmu untuk dikirim. Mungkin perlu beberapa hari bagi kami untuk mengirimkannya, tergantung pada jumlah pesanan. Kamu dapat mengikuti perkembangan pesanan Anda di sini, termasuk rincian nomor pelacakan yang ada:',
        'processing' => 'Kami telah menerima pembayaranmu dan saat ini sedang diproses. Kamu dapat mengikuti perkembangan pesananmu di sini:',
        'questions' => "Jika kamu memiliki pertanyaan, jangan ragu untuk membalas email ini.",
        'shipping' => 'Pengiriman',
        'subject' => 'Kami menerima pesanan osu!store Anda!',
        'thank_you' => 'Terima kasih atas pemesananmu di osu!store!',
        'total' => 'Total',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'Orang yang memberimu tag ini memilih untuk tetap anonim, sehingga nama mereka tidak akan disebutkan di notifikasi ini.',
        'anonymous_gift_maybe_not' => 'Tapi kamu mungkin sudah tahu siapa itu;).',
        'duration' => 'Berkat mereka, kamu memiliki akses osu!direct dan manfaat eksklusif osu!supporter lainnya selama :duration.',
        'features' => 'Kamu dapat mengetahui rincian lebih lanjut tentang fitur-fitur ini di sini:',
        'gifted' => 'Seseorang baru saja memberimu osu!supporter tag!',
        'subject' => 'Anda telah diberikan osu!supporter tag!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Ini adalah email konfirmasi untuk memberi tahu kamu bahwa alamat email yang digunakan untuk akun osu! kamu telah dirubah menjadi ":email".',
        'check' => 'Harap pastikan bahwa kamu menerima email ini di alamat email barumu untuk mencegah kehilangan akses pada akun osu! kamu di masa yang akan datang.',
        'sent' => 'Demi alasan keamanan, email ini telah dikirim ke alamat email baru dan lama kamu.',
        'subject' => 'Konfirmasi perubahan email osu!',
    ],

    'user_force_reactivation' => [
        'main' => 'Akun kamu diduga dalam bahaya, memiliki aktivitas mencurigakan baru-baru ini atau memiliki kata sandi yang SANGAT lemah. Akibatnya, kami memintamu untuk mengatur kata sandi baru. Pastikan untuk memilih kata sandi yang LEBIH AMAN.',
        'perform_reset' => 'Kamu dapat melakukan pengaturan ulang melewati :url',
        'reason' => 'Alasan:',
        'subject' => 'Pengaktifan Ulang Akun osu! Dibutuhkan',
    ],

    'user_password_updated' => [
        'confirmation' => 'Email ini hanya konfirmasi bahwa kata sandi akun osu! kamu telah diubah.',
        'subject' => 'Konfirmasi perubahan kata sandi osu!',
    ],

    'user_verification' => [
        'code' => 'Kode verifikasi kamu adalah:',
        'code_hint' => 'Kamu dapat memasukkan kodenya dengan atau tanpa spasi.',
        'link' => 'Atau, kamu juga dapat mengunjungi tautan di bawah ini untuk menyelesaikan proses verifikasi:',
        'report' => 'Jika kamu tidak mengetahui aksi ini, harap SEGERA BALAS email ini karena akun kamu mungkin dalam bahaya.',
        'subject' => 'Verifikasi akun osu!',

        'action_from' => [
            '_' => 'Terdapat aktivitas baru yang dilakukan pada akun kamu dari :country dan memerlukan verifikasi.',
            'unknown_country' => 'negara tak diketahui',
        ],
    ],
];
