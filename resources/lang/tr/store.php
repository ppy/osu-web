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
    'admin' => [
        'warehouse' => 'Depo',
    ],

    'cart' => [
        'checkout' => 'Ödeme',
        'info' => '',
        'more_goodies' => 'Ödememi yapmadan önce başka eşyalara göz atmak istiyorum',
        'shipping_fees' => 'kargo ücretleri',
        'title' => 'Alışveriş Sepeti',
        'total' => 'toplam',

        'errors_no_checkout' => [
            'line_1' => 'Hay aksi, alışveriş sepetinle ilgili ödemeyi engelleyen sorunlar var!',
            'line_2' => 'Devam etmek için yukarıdaki eşyaları güncelleyin ya da kaldırın.',
        ],

        'empty' => [
            'text' => 'Sepetiniz boş.',
            'return_link' => [
                '_' => 'Başka eşyalar bulmak için :link geri dönün!',
                'link_text' => 'mağaza listesine',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Eyvah, sepetinizde problemler var!',
        'cart_problems_edit' => 'Düzenlemek için buraya tıklayın.',
        'declined' => 'Ödeme iptal edildi.',
        'delayed_shipping' => 'Şu an siparişlere boğulmuş durumdayız! Siparişinizi vermekte özgürsünüz ancak biz mevcut siparişleri yetiştirmekle uğraşırken **ek olarak 1-2 hafta gecikme** bekleyebilirsiniz.',
        'old_cart' => 'Sepetiniz güncel görünmediği için tekrar yüklendi, lütfen tekrar deneyin.',
        'pay' => 'Paypal ile Ödeme Yap',

        'has_pending' => [
            '_' => 'Tamamlanmamış ödemeleriniz var, görmek için :link tıklayın.',
            'link_text' => 'buraya',
        ],

        'pending_checkout' => [
            'line_1' => 'Bir önceki ödeme başladı fakat bitmedi.',
            'line_2' => 'Bir ödeme yöntemi seçerek ödemenize devam edin.',
        ],
    ],

    'discount' => '%:percent kazanın',

    'invoice' => [
        'echeck_delay' => 'Ödemenizin bir eCheck olması nedeniyle, ödemenizin PayPal\'dan temizlenmesi için 10 ekstra günü göz önüne alın!',
        'status' => [
            'processing' => [
                'title' => 'Ödemeniz henüz onaylanmadı!',
                'line_1' => 'Eğer çoktan ödemeyi yaptıysanız, biz hala ödemenizin doğrulamasını bekliyor olabiliriz. Lütfen bu sayfayı bir ya da iki dakika sonra yenileyin!',
                'line_2' => [
                    '_' => 'Eğer ödeme sırasında bir sorun ile karşılaştıysanız, :link',
                    'link_text' => 'ödeme özetini görmek için buraya tıklayın',
                ],
            ],
        ],
    ],

    'order' => [
        'paid_on' => 'Sipariş verme tarihi :date',

        'invoice' => 'Faturayı Görüntüle',
        'no_orders' => 'Görüntülenecek sipariş yok.',
        'resume' => 'Sepete Dön',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':username için :name (:duration)',
            ],
            'quantity' => 'Adet',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Siparişiniz iptal edildiği için değiştiremezsiniz.',
            'checkout' => 'Siparişiniz işlenirken değişiklik yapamazsınız.', // checkout and processing should have the same message.
            'default' => 'Sipariş değiştirilemez',
            'delivered' => 'Siparişiniz teslim edildiği için değiştiremezsiniz.',
            'paid' => 'Siparişiniz ödendiği için değiştiremezsiniz.',
            'processing' => 'Siparişiniz işlenirken değişiklik yapamazsınız.',
            'shipped' => 'Siparişiniz çoktan yollandığı için değişiklik yapamazsınız.',
        ],

        'status' => [
            'cancelled' => 'İptal edildi',
            'checkout' => 'Hazırlanıyor',
            'delivered' => 'Teslim edildi',
            'paid' => 'Ödendi',
            'processing' => 'Onay bekleniyor',
            'shipped' => 'Ulaştırılıyor',
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
        'gift' => 'oyuncuya hediye et',
        'require_login' => [
            '_' => 'osu!supporter etiketi almak için :link !',
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

    'xsolla' => [
        'distributor' => '',
    ],
];
