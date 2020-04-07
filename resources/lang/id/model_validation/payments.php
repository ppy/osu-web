<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Tanda tangan tidak cocok',
    ],
    'notification_type' => 'notification_type tidak valid :type',
    'order' => [
        'invalid' => 'Pesanan tidak valid',
        'items' => [
            'virtual_only' => 'Metode pembayaran `:provider` tidak bisa dipakai untuk barang ini.',
        ],
        'status' => [
            'not_checkout' => 'Mencoba menerima pembayaran untuk pesanan yang salah `:state`.',
            'not_paid' => 'Mencoba melakukan pengembalian pembayaran untuk pesanan yang salah `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` parameter tidak cocok',
    ],
    'paypal' => [
        'not_echeck' => 'Pembayaran yang tertunda bukan pembayaran echeck. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Jumlah pembayaran tidak sesuai: :actual != :expected',
            'currency' => 'Pembayaran tidak dalam USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'ID transaksi pesanan yang diterima tidak valid',
        'user_id_mismatch' => 'external_id mengandung id pengguna yang salah',
    ],
];
