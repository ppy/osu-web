<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Sıradaki parçayı otomatik oynat',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ritim sadece bir *tık* uzakta! Ouendan/EBA, Taiko ve orijinal oyun modlarıyla, hem de tamamiyle işlevsel seviye editörüyle beraber.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmap seti',
            'beatmapset_covers' => 'beatmap seti kapakları',
            'contest' => 'yarışma',
            'contests' => 'yarışmalar',
            'root' => 'konsol',
            'store_orders' => 'mağaza yöneticisi',
        ],

        'artists' => [
            'index' => 'katalog',
        ],

        'changelog' => [
            'index' => 'katalog',
        ],

        'help' => [
            'index' => 'dizin',
            'sitemap' => 'Site haritası',
        ],

        'store' => [
            'cart' => 'sepet',
            'orders' => 'sipariş geçmişi',
            'products' => 'ürünler',
        ],

        'tournaments' => [
            'index' => 'katalog',
        ],

        'users' => [
            'modding' => 'modlama',
            'multiplayer' => '',
            'show' => 'bilgi',
        ],
    ],

    'gallery' => [
        'close' => 'Kapat (Esc)',
        'fullscreen' => 'Tam ekrana geç',
        'zoom' => 'Yakınlaştır/Uzaklaştır',
        'previous' => 'Bir önceki (sol ok)',
        'next' => 'Bir sonraki (sağ ok)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmapler',
            'artists' => 'featured artist\'ler',
            'index' => 'katalog',
            'packs' => 'paketler',
        ],
        'community' => [
            '_' => 'topluluk',
            'chat' => 'sohbet',
            'contests' => 'yarışmalar',
            'dev' => 'geliştirme',
            'forum-forums-index' => 'forumlar',
            'getLive' => 'canlı',
            'tournaments' => 'turnuvalar',
        ],
        'help' => [
            '_' => 'yardım',
            'getAbuse' => 'kötüye kullanımı bildir',
            'getFaq' => 'sss',
            'getRules' => 'kurallar',
            'getSupport' => 'hayır, gerçekten, yardıma ihtiyacım var!',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'anasayfa',
            'changelog-index' => 'değişiklikler',
            'getDownload' => 'indir',
            'news-index' => 'haberler',
            'search' => 'arama',
            'team' => 'ekip',
        ],
        'rankings' => [
            '_' => 'sıralama',
            'charts' => 'öne çıkanlar',
            'country' => 'ülke',
            'index' => 'performans',
            'kudosu' => 'kudosu',
            'multiplayer' => 'çok oyunculu',
            'score' => 'skor',
        ],
        'store' => [
            '_' => 'mağaza',
            'cart-show' => 'sepet',
            'getListing' => 'katalog',
            'orders-index' => 'sipariş geçmişi',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Genel',
            'home' => 'Anasayfa',
            'changelog-index' => 'Değişiklikler',
            'beatmaps' => 'Beatmap Kataloğu',
            'download' => 'osu!\'yu indir!',
        ],
        'help' => [
            '_' => 'Yardım & Topluluk',
            'faq' => 'Sıkça Sorulan Sorular',
            'forum' => 'Topluluk Forumları',
            'livestreams' => 'Canlı Yayınlar',
            'report' => 'Bir Sorun Bildir',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Yasal & Durum',
            'copyright' => 'Telif Hakkı (DMCA)',
            'privacy' => 'Gizlilik',
            'server_status' => 'Sunucu Durumu',
            'source_code' => 'Kaynak Kodu',
            'terms' => 'Koşullar',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Geçersiz istek parametreleri',
            'description' => '',
        ],
        '404' => [
            'error' => 'Sayfa Bulunamıyor',
            'description' => "Üzgünüz, ama ulaşmaya çalıştığınız sayfa burada değil!",
        ],
        '403' => [
            'error' => "Burada olmamalısın.",
            'description' => 'Geri dönmeyi deneyebilirsin.',
        ],
        '401' => [
            'error' => "Burada olmamalısınız.",
            'description' => 'Geri dönmeyi deneyebilirsiniz. Ya da giriş yapmayı.',
        ],
        '405' => [
            'error' => 'Sayfa Kayıp',
            'description' => "Üzgünüz, ama ulaşmaya çalıştığınız sayfa burada değil!",
        ],
        '422' => [
            'error' => 'Geçersiz istek parametreleri',
            'description' => '',
        ],
        '429' => [
            'error' => 'Kullanım limiti aşıldı',
            'description' => '',
        ],
        '500' => [
            'error' => 'Hay aksi! Bir şeyler bozuldu! ;_;',
            'description' => "Her bir hata bize otomatik olarak bildirilir.",
        ],
        'fatal' => [
            'error' => 'Hay aksi! Bir şeyler (fena) bozuldu ;_;',
            'description' => "Her bir hata bize otomatik olarak bildirilir.",
        ],
        '503' => [
            'error' => 'Bakım için kapalıyız!',
            'description' => "Bakım genellikle 5 saniye ile 10 dakika arasında sürer. Eğer daha uzun süredir kapalıysak, :link adresinden daha fazla bilgi edinebilirsiniz.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Gerektiği durumda, destek ekibe ulaştırabileceğin kod burada!",
    ],

    'popup_login' => [
        'button' => 'giriş yap / kayıt ol',

        'login' => [
            'forgot' => "Bilgilerimi unuttum",
            'password' => 'şifre',
            'title' => 'Devam etmek için Giriş Yap',
            'username' => 'kullanıcı adı',

            'error' => [
                'email' => "Kullanıcı adı veya e-posta adresi mevcut değil.",
                'password' => 'Hatalı şifre',
            ],
        ],

        'register' => [
            'download' => 'İndir',
            'info' => 'Hesabınızı oluşturmak için osu!\'yu indirin!',
            'title' => "Hesabın yok mu?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Ayarlar',
            'follows' => 'İzleme listeleri',
            'friends' => 'Arkadaşlar',
            'logout' => 'Çıkış Yap',
            'profile' => 'Profilim',
        ],
    ],

    'popup_search' => [
        'initial' => 'Aramak için yaz!',
        'retry' => 'Arama başarısız. Tekrar denemek için tıkla.',
    ],
];
