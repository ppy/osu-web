<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Ödeme',
        'empty_cart' => 'Sepetteki tüm ürünleri kaldır',
        'info' => ':count_delimited ürün sepette ($:subtotal)|:count_delimited ürün sepette ($:subtotal)',
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
        'hide_from_activity' => 'Bu siparişteki tüm osu!supporter etiketlerini etkinliğimden gizle',
        'old_cart' => 'Sepetiniz güncel görünmediği için tekrar yüklendi, lütfen tekrar deneyin.',
        'pay' => 'Paypal ile Ödeme Yap',
        'title_compact' => 'kasaya git',

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
    'free' => 'ücretsiz!',

    'invoice' => [
        'contact' => 'İletişim:',
        'date' => 'Tarih:',
        'echeck_delay' => 'Ödemenizin bir eCheck olması nedeniyle, ödemenizin PayPal\'dan temizlenmesi için 10 ekstra günü göz önüne alın!',
        'echeck_denied' => '',
        'hide_from_activity' => 'Bu siparişteki osu!supporter etiketleri yakın zamandaki etkinliklerinizde gösterilmez.',
        'sent_via' => 'Kargo şirketi:',
        'shipping_to' => 'Gönderim adresi:',
        'title' => 'Fatura',
        'title_compact' => 'fatura',

        'status' => [
            'cancelled' => [
                'title' => 'Siparişiniz iptal edildi',
                'line_1' => [
                    '_' => "Eğer iptal edilmesini talep etmediyseniz lütfen :link yoluyla sipariş numaranızı bahsederek ulaşınız. (#:order_number).",
                    'link_text' => 'osu!store destek',
                ],
            ],
            'delivered' => [
                'title' => 'Siparişiniz teslim edildi! İyi günlerde kullanmanız dileğiyle!',
                'line_1' => [
                    '_' => 'Satın alımınızla ilgili bir problem yaşıyorsanız,lütfen :link ile görüşün.',
                    'link_text' => 'osu!store destek',
                ],
            ],
            'prepared' => [
                'title' => 'Siparişiniz hazılrlanıyor!',
                'line_1' => 'Lütfen kargolanması için az daha bekleyiniz. Takip bilgisi, siparişiniz işlenip gönderildiğinde burada belirecektir. Meşgullük durumumuza göre 5 güne kadar sürebilir (ama genellikle daha az!).',
                'line_2' => 'Siparişleri, ağırlığı ve değerine bağlı olarak çeşitli kargo şirketleri kullanarak gönderiyoruz. Bu alan, siparişi gönderdiğimizde detaylarla güncellenecektir.',
            ],
            'processing' => [
                'title' => 'Ödemeniz henüz onaylanmadı!',
                'line_1' => 'Eğer çoktan ödemeyi yaptıysanız, biz hala ödemenizin doğrulamasını bekliyor olabiliriz. Lütfen bu sayfayı bir ya da iki dakika sonra yenileyin!',
                'line_2' => [
                    '_' => 'Eğer ödeme sırasında bir sorun ile karşılaştıysanız, :link',
                    'link_text' => 'ödeme özetini görmek için buraya tıklayın',
                ],
            ],
            'shipped' => [
                'title' => 'Siparişiniz kargoya verildi!',
                'tracking_details' => 'Kargo takip detayları aşağıdadır:',
                'no_tracking_details' => [
                    '_' => "Paketinizi uçak kargosu yoluyla gönderdiğimiz için takip ayrıntılarına sahip değiliz, ancak paketinizi 1-3 hafta içinde almayı bekleyebilirsiniz. Avrupa'da bazen gümrükler bizim kontrolümüz dışında siparişi geciktirebilir. Herhangi bir endişeniz varsa lütfen sana gelen sipariş onay e-postasını yanıtlayınız (ya da :link).",
                    'link_text' => 'bize bir e-mail yollayın',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Siparişi iptal et',
        'cancel_confirm' => 'Bu sipariş iptal edilecek ve bunun için ödeme kabul edilmeyecektir. Ödeme sağlayıcı ayrılan ödenekleri hemen ödeyemez. Emin misiniz?',
        'cancel_not_allowed' => 'Sipariş bu zamanda iptal edilemez.',
        'invoice' => 'Faturayı Görüntüle',
        'no_orders' => 'Görüntülenecek sipariş yok.',
        'paid_on' => 'Sipariş verme tarihi :date',
        'resume' => 'Sepete Dön',
        'shipping_and_handling' => 'Kargo & Taşıma',
        'shopify_expired' => 'Bu sipariş için ödeme bağlantısının süresi doldu.',
        'subtotal' => 'Ara toplam',
        'total' => 'Toplam',

        'details' => [
            'order_number' => 'Sipariş No.',
            'payment_terms' => 'Ödeme Koşulları',
            'salesperson' => 'Satış Temsilcisi',
            'shipping_method' => 'Gönderim Yolu',
            'shipping_terms' => 'Teslimat Koşulları',
            'title' => 'Sipariş Detayları',
        ],

        'item' => [
            'quantity' => 'Adet',

            'display_name' => [
                'supporter_tag' => ':username için :name (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Mesaj: :message',
            ],
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
            'title' => 'Sipariş Durumu',
        ],

        'thanks' => [
            'title' => 'Siparişiniz için teşekkür ederiz!',
            'line_1' => [
                '_' => 'Yakında bir onay e-postası alacaksınız. Sorunuz varsa, lütfen :link!',
                'link_text' => 'bizimle iletişime geçin',
            ],
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
        'gift_message' => 'isterseniz hediyenize bir mesaj ekleyin! (en fazla :length karakter)',

        'require_login' => [
            '_' => 'osu!supporter etiketi almak için :link !',
            'link_text' => 'giriş yapmış',
        ],
    ],

    'username_change' => [
        'check' => 'Geçerliliğini kontrol etmek için bir kullanıcı adı girin!',
        'checking' => ':username geçerliliği kontrol ediliyor...',
        'placeholder' => 'İstenilen Kullanıcı Adı',
        'label' => 'Yeni kullanıcı adı',
        'current' => 'Şu anki kullanıcı adınız ":username".',

        'require_login' => [
            '_' => 'İsmini değiştirmek için :link olman gerekiyor!',
            'link_text' => 'giriş yapmış',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
