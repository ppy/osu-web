<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'landing' => [
        'download' => 'Şimdi indir',
        'online' => '<strong>:players</strong> oyuncu şu anda <strong>:games</strong> oyunda çevrimiçi',
        'peak' => 'Zirve, :count çevrimiçi oyuncu',
        'players' => '<strong>:count</strong> kayıtlı oyuncu',
        'title' => 'hoşgeldiniz',
        'see_more_news' => '',

        'slogan' => [
            'main' => 'en en iyi free-to-win ritim oyunu',
            'sub' => 'ritim yalnızca bir tık uzakta',
        ],
    ],

    'search' => [
        'advanced_link' => 'Gelişmiş arama',
        'button' => 'Ara',
        'empty_result' => 'Hiçbir şey bulunamadı!',
        'keyword_required' => 'Bir arama anahtar sözcüğü gerekli',
        'placeholder' => 'aramak için yaz',
        'title' => 'Ara',

        'beatmapset' => [
            'more' => ':count tane daha beatmap arama sonucu',
            'more_simple' => 'Daha fazla beatmap arama sonucu gör',
            'title' => 'Beatmapler',
        ],

        'forum_post' => [
            'all' => 'Tüm forumlar',
            'link' => 'Forumda ara',
            'more_simple' => 'Daha fazla forum arama sonucu görmek için tıklayınız',
            'title' => 'Forum',

            'label' => [
                'forum' => 'forumlarda ara',
                'forum_children' => 'alt forumları dahil et',
                'topic_id' => 'konu #',
                'username' => 'yazar',
            ],
        ],

        'mode' => [
            'all' => 'hepsi',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'oyuncu',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count tane daha oyuncu arama sonucu',
            'more_simple' => 'Daha fazla oyuncu arama sonucu gör',
            'more_hidden' => 'Oyuncu araması :max oyuncuyla sınırlıdır. Arama sorgusunu hassaslaştırmayı deneyin.',
            'title' => 'Oyuncular',
        ],

        'wiki_page' => [
            'link' => 'Wiki\'de ara',
            'more_simple' => 'Daha fazla wiki arama sonucu göster',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "haydi seni<br>oyuna hazırlayalım!",
        'action' => 'osu!\'yu indir',
        'os' => [
            'windows' => 'Windows için',
            'macos' => 'macOS için',
            'linux' => 'Linux için',
        ],
        'mirror' => 'alternatif',
        'macos-fallback' => 'macOS kullanıcıları',
        'steps' => [
            'register' => [
                'title' => 'bir hesap oluştur',
                'description' => 'oyunu başlatırken giriş yapmak ya da yeni bir hesap yaratmak için çıkan yönergeleri takip edin',
            ],
            'download' => [
                'title' => 'oyunu indir',
                'description' => 'yükleyiciyi indirmek için yukarıdaki düğmeye tıklayın, sonra çalıştırın!',
            ],
            'beatmaps' => [
                'title' => 'beatmap edinin',
                'description' => [
                    '_' => 'Kullanıcılar tarafından oluşturulmuş engin beatmap kütüphanesine :browse ve oynamaya başla!',
                    'browse' => 'göz at',
                ],
            ],
        ],
        'video-guide' => 'video kılavuzu',
    ],

    'user' => [
        'title' => 'ön panel',
        'news' => [
            'title' => 'Gelişmeler',
            'error' => 'Haberler yüklenirken hata oluştu, sayfayı yenilemeyi deneseniz?...',
        ],
        'header' => [
            'welcome' => 'Merhaba, <strong>:username</strong>!',
            'messages' => ':count yeni mesajınız var|:count yeni mesajınız var',
            'stats' => [
                'friends' => 'Çevrimiçi Arkadaşlar',
                'games' => 'Oyunlar',
                'online' => 'Çevrimiçi Kullanıcılar',
            ],
        ],
        'beatmaps' => [
            'new' => 'Yeni Dereceli Beatmapler',
            'popular' => 'Popüler Beatmapler',
            'by_user' => '',
        ],
        'buttons' => [
            'download' => 'osu!\'yu indir',
            'support' => 'osu!\'yu destekle',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Vay canına!',
        'subtitle' => 'İyi vakit geçiriyor gibi görünüyorsunuz! :D',
        'body' => [
            'part-1' => 'Osu!\'nun reklamsız çalıştığını, geliştirme ve yürütme masraflarının karşılanmasında ise kendi oyuncularının desteğine güvendiğini biliyor muydun?',
            'part-2' => 'Ayrıca, osu!\'yu destekleyerek, izleme modunda ve çoklu oyunculu oyunlarda otomatik olarak devreye giren <strong>oyun içi indirme</strong> özelliği gibi bir çok yararlı özelliklere sahip olabileceğini de biliyor muydun?',
        ],
        'find-out-more' => 'Daha fazlasını öğrenmek için buraya tıkla!',
        'download-starting' => "Ah, bu arada, endişelenme! - indirme işlemin senin için çoktan başladı bile ;)",
    ],
];
