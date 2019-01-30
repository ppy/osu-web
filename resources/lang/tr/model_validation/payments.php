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
