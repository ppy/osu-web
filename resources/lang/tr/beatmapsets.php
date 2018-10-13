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
    'availability' => [
        'disabled' => 'Bu beatmap henüz indirilmeye açık değil.',
        'parts-removed' => 'Bu beatmapin bazı bölümleri içerik oluşturucunun ya da üçüncü parti hak sahibinin isteği üzerine kaldırılmıştır.',
        'more-info' => 'Daha fazla bilgi için buraya göz atın.',
    ],

    'index' => [
        'title' => 'Beatmap Listesi',
        'guest_title' => 'Beatmapler',
    ],

    'show' => [
        'discussion' => 'Tartışma',

        'details' => [
            'mapped_by' => ':mapper tarafından yapıldı',
            'submitted' => 'gönderilme tarihi: ',
            'updated' => 'son güncelleme ',
            'updated_timeago' => 'son güncelleme :timeago',
            'ranked' => 'dereceli olma tarihi: ',
            'approved' => 'tarihinde onaylandı ',
            'qualified' => 'aday olma tarihi ',
            'loved' => 'sevilme tarihi: ',
            'logged-out' => 'Herhangi bir beatmapi indirmeden önce giriş yapmalısınız!',
            'download' => [
                '_' => 'İndir',
                'video' => 'Video ile',
                'no-video' => 'Video olmadan',
                'direct' => '',
            ],
            'favourite' => 'Haritayı favorilere ekle',
            'unfavourite' => 'Haritayı favorilerden çıkar',
            'favourited_count' => '+ 1 kişi tarafından!|+ :count kişi tarafından!',
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
        'info' => [
            'description' => 'Açıklama',
            'genre' => 'Tür',
            'language' => 'Dil',
            'no_scores' => 'Veriler hala hesaplanıyor...',
            'points-of-failure' => 'Başarısız Olunan Kısımlar',
            'source' => 'Kaynak',
            'success-rate' => 'Başarı Oranı',
            'tags' => 'Etiketler',
            'unranked' => 'Derecelendirilmemiş beatmap',
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
    ],
];
