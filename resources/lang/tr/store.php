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
    'admin' => [
        'warehouse' => 'Depo',
    ],

    'cart' => [
        'checkout' => '',
        'more_goodies' => '',
        'shipping_fees' => '',
        'title' => '',
        'total' => '',

        'errors_no_checkout' => [
            'line_1' => '',
            'line_2' => '',
        ],

        'empty' => [
            'text' => '',
            'return_link' => [
                '_' => '',
                'link_text' => '',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Eyvah, sepetinizde problemler var!',
        'cart_problems_edit' => 'Düzenlemek için buraya tıklayın.',
        'declined' => 'Ödeme iptal edildi.',
        'old_cart' => 'Sepetiniz güncel görünmediği için tekrar yüklendi, lütfen tekrar deneyin.',
        'pay' => 'Paypal ile Ödeme Yap',
        'pending_checkout' => [
            'line_1' => 'Bir önceki ödeme başladı fakat bitmedi.',
            'line_2' => 'Ödemenize devam etmek için ödeme şekli seçin, veya iptal için :link.',
            'link_text' => 'buraya tıkla',
        ],
        'delayed_shipping' => 'Şu an siparişlere boğulmuş durumdayız! Siparişinizi vermekte özgürsünüz ancak biz mevcut siparişleri yetiştirmekle uğraşırken **ek olarak 1-2 hafta gecikme** bekleyebilirsiniz.',
    ],

    'discount' => '%:percent kazanın',

    'mail' => [
        'payment_completed' => [
            'subject' => 'osu!store siparişinizi aldık!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':username için :name (:duration)',
            ],
            'quantity' => 'Adet',
        ],

        'not_modifiable_exception' => [
            'cancelled' => '',
            'checkout' => '', // checkout and processing should have the same message.
            'default' => '',
            'delivered' => '',
            'paid' => '',
            'processing' => '',
            'shipped' => '',
        ],
    ],

    'product' => [
        'name' => 'İsim',

        'stock' => [
            'out' => 'Bu ürün şu anda tükendi. Daha sonra tekrar deneyin!',
            'out_with_alternative' => 'Ne yazık ki bu ürün tükendi. Alttaki listeden farklı bir tür seçebilir veya daha sonra tekrar deneyebilirsiniz!',
        ],

        'add_to_cart' => 'Sepete Ekle',
        'notify' => 'Mevcut olduğundan bana bildir!',

        'notification_success' => 'yeni ürün geldiğinde size haber vereceğiz. iptal etmek için :link tıklayın',
        'notification_remove_text' => 'buraya',

        'notification_in_stock' => 'Bu ürün zaten stokta var!',
    ],

    'supporter_tag' => [
        'gift' => 'oyuncuya hediye',
        'require_login' => [
            '_' => 'Supporter almak için :link olmalısınız!',
            'link_text' => 'giriş yapmış',
        ],
    ],

    'username_change' => [
        'check' => 'Geçerliliğini kontrol etmek için bir kullanıcı adı girin!',
        'checking' => ':username geçerliliği kontrol ediliyor...',
        'require_login' => [
            '_' => 'İsmini değiştirmek için :link olman gerekiyor!',
            'link_text' => 'giriş yapmış',
        ],
    ],
];
