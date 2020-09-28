<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Bu beatmap henüz indirilmeye açık değil.',
        'parts-removed' => 'Bu beatmapin bazı bölümleri içerik oluşturucunun ya da üçüncü parti hak sahibinin isteği üzerine kaldırılmıştır.',
        'more-info' => 'Daha fazla bilgi için buraya göz atın.',
    ],

    'index' => [
        'title' => 'Beatmap Listesi',
        'guest_title' => 'Beatmapler',
    ],

    'panel' => [
        'download' => [
            'all' => 'indir',
            'video' => 'video ile indir',
            'no_video' => 'videosuz indir',
            'direct' => 'osu!direct\'de aç',
        ],
    ],

    'show' => [
        'discussion' => 'Tartışma',

        'details' => [
            'favourite' => 'Haritayı favorilere ekle',
            'logged-out' => 'Herhangi bir beatmapi indirmeden önce giriş yapmalısınız!',
            'mapped_by' => ':mapper tarafından yapıldı',
            'unfavourite' => 'Haritayı favorilerden çıkar',
            'updated_timeago' => 'son güncelleme :timeago',

            'download' => [
                '_' => 'İndir',
                'direct' => '',
                'no-video' => 'Video olmadan',
                'video' => 'Video ile',
            ],

            'login_required' => [
                'bottom' => 'daha fazla özelliğe erişmek için',
                'top' => 'Oturum Aç',
            ],
        ],

        'details_date' => [
            'approved' => 'onaylandı :timeago',
            'loved' => 'sevildi :timeago',
            'qualified' => ':timeago önce nitelikli oldu',
            'ranked' => ':timeago önce dereceli oldu',
            'submitted' => ':timeago önce gönderildi',
            'updated' => 'en son :timeago önce güncellendi',
        ],

        'favourites' => [
            'limit_reached' => 'Favorilerinizde çok fazla beatmap\'iniz var! Lütfen devam etmeden önce birini çıkartın.',
        ],

        'hype' => [
            'action' => '<strong>Dereceli</strong> statüsüne erişmesi için eğer beğendiyseniz bu haritayı gazlayın.',

            'current' => [
                '_' => 'Bu harita şu an :status.',

                'status' => [
                    'pending' => 'beklemede',
                    'qualified' => 'nitelikli',
                    'wip' => 'yapım aşamasında',
                ],
            ],

            'disqualify' => [
                '_' => 'Eğer bu beatmap\'de bir sorun bulduysanız, lütfen diskalifiye ediniz :link.',
            ],

            'report' => [
                '_' => 'Eğer bu beatmap ile ilgili bir sorun bulursanız, takımı uyarmak için lütfen :link üzerinden raporlayın.',
                'button' => 'Sorun bildir',
                'link' => 'burası',
            ],
        ],

        'info' => [
            'description' => 'Açıklama',
            'genre' => 'Tür',
            'language' => 'Dil',
            'no_scores' => 'Veriler hala hesaplanıyor...',
            'points-of-failure' => 'Başarısız Olunan Kısımlar',
            'source' => 'Kaynak',
            'success-rate' => 'Başarı Oranı',
            'tags' => 'Etiketler',
        ],

        'scoreboard' => [
            'achieved' => ':when oynandı',
            'country' => 'Ülke sıralaması',
            'friend' => 'Arkadaş Sıralaması',
            'global' => 'Dünya Sıralaması',
            'supporter-link' => 'Aldığınız tüm süslü özellikleri görmek için buraya <a href=":link">tıklayın</a>!',
            'supporter-only' => 'Arkadaş ve ülke sıralamasına erişebilmek için osu!supporter olman gerekiyor!',
            'title' => 'Skor tahtası',

            'headers' => [
                'accuracy' => 'İsabetlilik',
                'combo' => 'Maksimum Kombo',
                'miss' => 'Iska',
                'mods' => 'Modlar',
                'player' => 'Oyuncu',
                'pp' => '',
                'rank' => 'Sıralama',
                'score_total' => 'Toplam Skor',
                'score' => 'Skor',
                'time' => 'Zaman',
            ],

            'no_scores' => [
                'country' => 'Ülkenizde hiç kimse henüz bu haritada bir skora sahip değil!',
                'friend' => 'Hiçbir arkadaşın henüz bu haritada bir skora sahip değil!',
                'global' => 'Henüz skor yok. Biraz skor yapmaya ne dersin?',
                'loading' => 'Skorlar yükleniyor...',
                'unranked' => 'Derecelendirilmemiş beatmap.',
            ],
            'score' => [
                'first' => 'Lider',
                'own' => 'En İyi Skorun',
            ],
        ],

        'stats' => [
            'cs' => 'Daire Boyutu',
            'cs-mania' => 'Tuş Sayısı',
            'drain' => 'HP Drain',
            'accuracy' => 'İsabetlilik',
            'ar' => 'Yaklaşım Oranı',
            'stars' => 'Zorluk',
            'total_length' => 'Uzunluk',
            'bpm' => 'BPM',
            'count_circles' => 'Daire Sayısı',
            'count_sliders' => 'Slider Sayısı',
            'user-rating' => 'Kullanıcı Derecelendirmesi',
            'rating-spread' => 'Değerlendirme Puanı',
            'nominations' => 'Adaylıklar',
            'playcount' => 'Oynama sayısı',
        ],

        'status' => [
            'ranked' => 'Dereceli',
            'approved' => 'Onaylı',
            'loved' => 'Sevilen',
            'qualified' => 'Nitelikli',
            'wip' => 'Yapım Aşamasında',
            'pending' => 'Beklemede',
            'graveyard' => 'Mezarlıkta',
        ],
    ],
];
