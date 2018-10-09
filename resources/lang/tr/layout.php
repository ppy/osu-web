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
    'defaults' => [
        'page_description' => 'osu! - Ritim sadece bir *tık* uzakta! Ouendan/EBA, Taiko ve orijinal oyun modlarıyla, hem de tamamiyle işlevsel seviye editörüyle beraber.',
    ],

    'menu' => [
        'home' => [
            '_' => 'anasayfa',
            'account-edit' => 'ayarlar',
            'friends-index' => 'arkadaşlar',
            'changelog-index' => 'değişiklikler',
            'changelog-build' => 'sürüm',
            'getDownload' => 'indir',
            'getIcons' => 'simgeler',
            'groups-show' => 'gruplar',
            'index' => 'kontrol paneli',
            'legal-show' => 'bilgi',
            'news-index' => 'haberler',
            'news-show' => 'haberler',
            'password-reset-index' => 'şifreni sıfırla',
            'search' => 'ara',
            'supportTheGame' => 'oyunu destekle',
            'team' => 'takım',
        ],
        'help' => [
            '_' => 'yardım',
            'getFaq' => 'sss',
            'getRules' => 'kurallar',
            'getSupport' => 'hayır, gerçekten, yardıma ihtiyacım var!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmapler',
            'artists' => 'seçkin sanatçılar',
            'beatmap_discussion_posts-index' => 'beatmap tartışma başlıkları',
            'beatmap_discussions-index' => 'beatmap tartışmaları',
            'beatmapset-watches-index' => 'modlama izleme listesi',
            'beatmapset_discussion_votes-index' => 'beatmap tartışma oyları',
            'beatmapset_events-index' => 'beatmapset olayları',
            'index' => 'listeleme',
            'packs' => 'paketler',
            'show' => 'bilgi',
        ],
        'beatmapsets' => [
            '_' => 'beatmapler',
            'discussion' => 'modlama',
        ],
        'rankings' => [
            '_' => 'sıralama',
            'index' => 'performans',
            'performance' => 'performans',
            'charts' => 'öne çıkanlar',
            'score' => 'skor',
            'country' => 'ülke',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'topluluk',
            'dev' => 'geliştirme',
            'getForum' => 'forumlar',
            'getChat' => 'sohbet',
            'getLive' => 'canlı',
            'contests' => 'yarışmalar',
            'profile' => 'profil',
            'tournaments' => 'turnuvalar',
            'tournaments-index' => 'turnuvalar',
            'tournaments-show' => 'turnuva bilgisi',
            'forum-topic-watches-index' => 'abonelikler',
            'forum-topics-create' => 'forumlar',
            'forum-topics-show' => 'forumlar',
            'forum-forums-index' => 'forumlar',
            'forum-forums-show' => 'forumlar',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'maç',
        ],
        'error' => [
            '_' => 'hata',
            '404' => 'eksik',
            '403' => 'yasaklı',
            '401' => 'izinsiz',
            '405' => 'eksik',
            '500' => 'bir şeyler yanlış',
            '503' => 'bakım',
        ],
        'user' => [
            '_' => 'kullanıcı',
            'getLogin' => 'giriş yap',
            'disabled' => 'devre dışı',

            'register' => 'kaydol',
            'reset' => 'kurtar',
            'new' => 'yeni',

            'messages' => 'Mesajlar',
            'settings' => 'Ayarlar',
            'logout' => 'Çıkış Yap',
            'help' => 'Yardım',
            'modding-history-discussions' => 'kullanıcı modlama tartışmaları',
            'modding-history-events' => 'kullanıcı modlama etkinlikleri',
            'modding-history-index' => 'kullanıcı modlama geçmişi',
            'modding-history-posts' => 'kullanıcı modlama gönderileri',
            'modding-history-votesGiven' => 'kullanıcı verilen modlama oyları',
            'modding-history-votesReceived' => 'kullanıcı alınan modlama oyları',
        ],
        'store' => [
            '_' => 'mağaza',
            'checkout-show' => 'ödeme',
            'getListing' => 'liste',
            'cart-show' => 'sepet',

            'getCheckout' => 'ödeme',
            'getInvoice' => 'fatura',
            'products-show' => 'ürün',

            'new' => 'yeni',
            'home' => 'anasayfa',
            'index' => 'anasayfa',
            'thanks' => 'teşekkürler',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => '',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => '',
            'orders-show' => '',
        ],
        'admin' => [
            '_' => '',
            'beatmapsets-covers' => '',
            'logs-index' => '',
            'root' => '',

            'beatmapsets' => [
                '_' => '',
                'show' => '',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Genel',
            'home' => 'Anasayfa',
            'changelog-index' => 'Sürüm notları',
            'beatmaps' => 'Beatmap Listesi',
            'download' => 'osu!\'yu indir!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Yardım & Topluluk',
            'faq' => 'Sıkça Sorulan Sorular',
            'forum' => 'Topluluk Forumları',
            'livestreams' => 'Canlı Yayınlar',
            'report' => 'Bir Sorun Bildir',
        ],
        'legal' => [
            '_' => 'Yasal & Durum',
            'copyright' => 'Telif Hakkı (DMCA)',
            'privacy' => 'Gizlilik',
            'server_status' => 'Sunucu Durumu',
            'source_code' => 'Kaynak Kodu',
            'terms' => 'Hizmet Kullanım Şartları',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Sayfa Kayıp',
            'description' => "Üzgünüm, istediğiniz sayfa burada değil!",
        ],
        '403' => [
            'error' => "Burada olmamalısın.",
            'description' => 'Geri dönmeyi deneyebilirsin.',
        ],
        '401' => [
            'error' => "Burada olmamalısın.",
            'description' => 'Geri dönmeyi deneyebilirsiniz. Ya da giriş yapmayı.',
        ],
        '405' => [
            'error' => 'Sayfa Kayıp',
            'description' => "Üzgünüz, ama ulaşmaya çalıştığınız sayfa burada değil!",
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
        'login' => [
            'email' => 'e-posta adresi',
            'forgot' => "Bilgilerimi unuttum",
            'password' => 'şifre',
            'title' => 'Devam etmek için Giriş Yap',

            'error' => [
                'email' => "Kullanıcı adı veya e-posta adresi mevcut değil.",
                'password' => 'Hatalı şifre',
            ],
        ],

        'register' => [
            'info' => "Bir hesaba ihtiyacınız var, efendim. Neden hemen bir tane oluşturmuyorsunuz?",
            'title' => "Hesabın yok mu?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Ayarlar',
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
