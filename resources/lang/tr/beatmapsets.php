<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Bu beatmap henüz indirilmeye açık değil.',
        'parts-removed' => 'Bu beatmapin bazı bölümleri içerik oluşturucunun ya da üçüncü parti hak sahibinin isteği üzerine kaldırılmıştır.',
        'more-info' => 'Daha fazla bilgi için buraya göz atın.',
        'rule_violation' => 'Bu beatmap üzerinde yer alan bazı varlıklar osu!\'da kullanıma uygun olmadığına karar verildikten sonra kaldırıldı.',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'index' => [
        'title' => 'Beatmap Listesi',
        'guest_title' => 'Beatmapler',
    ],

    'panel' => [
        'empty' => 'beatmap yok',

        'download' => [
            'all' => 'indir',
            'video' => 'video ile indir',
            'no_video' => 'videosuz indir',
            'direct' => 'osu!direct\'de aç',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Karma bir beatmap seti, adaylık için en az bir oyun modu seçmenizi gerektirir.',
        'incorrect_mode' => ':mode modunu aday göstermek için izniniz yok.',
        'full_bn_required' => 'Bu niteliklendirme aday gösterimini gerçekleştirebilmeniz için tam aday gösterici olmanız gerekmektedir.',
        'too_many' => 'Adaylık şartı zaten yerine getirildi.',

        'dialog' => [
            'confirmation' => 'Bu Beatmap\'i aday göstermek istediğinize emin misiniz?',
            'header' => 'Beatmap aday gösterin',
            'hybrid_warning' => 'not: sadece bir kez aday gösterebilirsiniz, bu yüzden lütfen istediğiniz tüm oyun modlarını aday gösterdiğinizden emin olun',
            'which_modes' => 'Hangi modlar için aday gösterilsin?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Müstehcen',
    ],

    'show' => [
        'discussion' => 'Tartışma',

        'details' => [
            'favourite' => 'Beatmap setini favorilere ekle',
            'logged-out' => 'Herhangi bir beatmapi indirmeden önce giriş yapmalısınız!',
            'mapped_by' => ':mapper tarafından yapıldı',
            'unfavourite' => 'Beatmap setini favorilerden çıkar',
            'updated_timeago' => 'son güncelleme: :timeago',

            'download' => [
                '_' => 'İndir',
                'direct' => '',
                'no-video' => 'Video olmadan',
                'video' => 'Video ile',
            ],

            'login_required' => [
                'bottom' => 'daha fazla özelliğe erişmek için',
                'top' => 'Giriş Yap',
            ],
        ],

        'details_date' => [
            'approved' => 'onaylandı: :timeago',
            'loved' => 'sevilenlere eklendi: :timeago',
            'qualified' => 'nitelikli oldu: :timeago',
            'ranked' => 'dereceli oldu: :timeago',
            'submitted' => 'gönderildi: :timeago',
            'updated' => 'son güncelleme: :timeago',
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
            'nsfw' => 'Müstehcen içerik',
            'points-of-failure' => 'Başarısız Olunan Kısımlar',
            'source' => 'Kaynak',
            'success-rate' => 'Başarı Oranı',
            'tags' => 'Etiketler',
        ],

        'nsfw_warning' => [
            'details' => 'Bu beatmap müstehcen, ofansif, veya rahatsız edici içerik içermektedir. Yine de görüntülemek istiyor musunuz?',
            'title' => 'Müstehcen İçerik',

            'buttons' => [
                'disable' => 'Uyarıyı devre dışı bırak',
                'listing' => 'Beatmap listesi',
                'show' => 'Göster',
            ],
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
                'accuracy' => 'İSABETLİLİK',
                'combo' => 'Maks Kombo',
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
