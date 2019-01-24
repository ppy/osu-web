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
