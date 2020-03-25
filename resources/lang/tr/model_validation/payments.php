<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'İmzalar eşleşmiyor',
    ],
    'notification_type' => 'notification_type geçerli değil :type',
    'order' => [
        'invalid' => 'Sipariş geçerli değil',
        'items' => [
            'virtual_only' => '`:provider` ödeme, fiziksel öğeler için geçerli değil.',
        ],
        'status' => [
            'not_checkout' => 'Yanlış durumdaki bir siparişin ödemesi kabul edilmeye çalışılıyor \':state\'.',
            'not_paid' => 'Yanlış durumdaki bir siparişin geri ödemesi gerçekleştirilmeye çalışılıyor \':state\'.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` parametresi eşleşmiyor',
    ],
    'paypal' => [
        'not_echeck' => 'Beklenen ödeme eCheck değil. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Ödeme miktarı eşleşmiyor: :actual != :expected',
            'currency' => 'Ödeme ABD Doları tipinden değil. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Alınan sipariş onay numarası bozulmuş',
        'user_id_mismatch' => 'external_id yanlış kullanıcı kimliğini içeriyor',
    ],
];
