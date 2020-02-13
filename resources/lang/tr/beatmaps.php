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
    'discussion-posts' => [
        'store' => [
            'error' => 'Gönderi kaydetme başarısız',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Oy güncelleme başarısız',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosuya izin ver',
        'beatmap_information' => 'Beatmap sayfası',
        'delete' => 'sil',
        'deleted' => ':editor tarafından :delete_time tarihinde silindi.',
        'deny_kudosu' => 'kudosuyu reddet',
        'edit' => 'düzenle',
        'edited' => 'En son :editor tarafından :update_time tarihinde düzenlendi.',
        'kudosu_denied' => 'Kudosu almaktan mahrum bırakıldı.',
        'message_placeholder_deleted_beatmap' => 'Bu zorluk seviyesi silindi o yüzden hakkında daha fazla tartışılamaz.',
        'message_placeholder_locked' => 'Bu beatmap için tartışma devre dışı bırakıldı.',
        'message_type_select' => 'Yorum Türünü Seçin',
        'reply_notice' => 'Cevaplamak için Enter tuşuna basın.',
        'reply_placeholder' => 'Yanıtınızı buraya yazın',
        'require-login' => 'Lütfen yorum yapmak ya da cevaplamak için giriş yapınız',
        'resolved' => 'Çözüldü',
        'restore' => 'restore et',
        'show_deleted' => 'Silineni göster',
        'title' => 'Tartışmalar',

        'collapse' => [
            'all-collapse' => 'Tümünü küçült',
            'all-expand' => 'Tümünü genişlet',
        ],

        'empty' => [
            'empty' => 'Henüz tartışma yok!',
            'hidden' => 'Filtre ile eşleşen tartışma yok.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Tartışmayı kilitle',
                'unlock' => 'Tartışmanın kilidini aç',
            ],

            'prompt' => [
                'lock' => 'Kilitleme sebebi',
                'unlock' => 'Kilidi açmak istediğinizden emin misiniz?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Bu gönderi beatmap setinin genel tartışmasına gidecek. Bu beatmapi modlamak için mesajı bir zaman damgası ile başlatın (ör: 00:12:345).',
            'in_timeline' => 'Birden fazla zaman damgasını modlamak için, birden fazla gönderi yapın (gönderi başına bir zaman damgası).',
        ],

        'message_placeholder' => [
            'general' => 'Genel\'e yazmak için burayı kullanın (:version)',
            'generalAll' => 'Genel\'e yazmak için burayı kullanın (tüm zorluklar)',
            'timeline' => 'Timeline\'a yazmak için burayı kullanın (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskalifiye',
            'hype' => 'Gazla!',
            'mapper_note' => 'Not',
            'nomination_reset' => 'Adaylığı Sıfırla',
            'praise' => 'Övgü',
            'problem' => 'Sorun',
            'review' => 'İnceleme',
            'suggestion' => 'Öneri',
        ],

        'mode' => [
            'events' => 'Geçmiş',
            'general' => 'Genel :scope',
            'reviews' => 'İncelemeler',
            'timeline' => 'Zaman Çizgisi',
            'scopes' => [
                'general' => 'Bu zorluk',
                'generalAll' => 'Tüm zorluklar',
            ],
        ],

        'new' => [
            'pin' => 'Sabitle',
            'timestamp' => 'Zaman damgası',
            'timestamp_missing' => 'bir zaman damgası eklemek için editörde ctrl-c\'ye basıp mesajınıza yapıştırın!',
            'title' => 'Yeni Tartışma',
            'unpin' => 'Sabitlemeyi kaldır',
        ],

        'show' => [
            'title' => ':title :mapper tarafından yapıldı',
        ],

        'sort' => [
            'created_at' => 'Oluşturulma zamanı',
            'timeline' => 'Zaman Çizgisi',
            'updated_at' => 'Son güncelleme',
        ],

        'stats' => [
            'deleted' => 'Silindi',
            'mapper_notes' => 'Notlar',
            'mine' => 'Benim',
            'pending' => 'Beklemede',
            'praises' => 'Övgüler',
            'resolved' => 'Çözüldü',
            'total' => 'Hepsi',
        ],

        'status-messages' => [
            'approved' => 'Bu beatmap :date tarihinde onaylandı!',
            'graveyard' => "Bu beatmap :date tarihinden beri güncellenmedi ve büyük ihtimalle yaratıcısı tarafından terk edildi...",
            'loved' => 'Bu beatmap :date tarihinde sevilenler kategorisine eklendi!',
            'ranked' => 'Bu beatmap :date tarihinde dereceli oldu!',
            'wip' => 'Dikkat: Bu beatmap yaratıcısı tarafından yapım aşamasında olarak işaretlendi.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Henüz negatif oy yok',
                'up' => 'Henüz pozitif oy yok',
            ],
            'latest' => [
                'down' => '',
                'up' => '',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Beatmapi Gazla!',
        'button_done' => 'Çoktan Gazlandı!',
        'confirm' => "Emin misiniz? Bu kalan :n adet gazdan birini kullanacak ve geriye alınamaz.",
        'explanation' => 'Bu beatmapi aday gösterilmesi ve dereceli olması için daha görünür yapmak için gazla!',
        'explanation_guest' => 'Giriş yap ve bu beatmapi gazlayarak, aday gösterilmesi ve dereceli olması için daha görünür yap!',
        'new_time' => "Bir sonraki gaz :new_time tahinde gelecek.",
        'remaining' => ':remaining gazınız kaldı.',
        'required_text' => 'Gaz: :current/:required',
        'section_title' => 'Gaz Treni',
        'title' => 'Gaz',
    ],

    'feedback' => [
        'button' => 'Geri bildirim Bırak',
    ],

    'nominations' => [
        'delete' => 'Sil',
        'delete_own_confirm' => 'Emin misin? Beatmap silinecek ve profiline yönlendirileceksin.',
        'delete_other_confirm' => 'Emin misin? Beatmap silinecek ve kullanıcının profiline yönlendirileceksin.',
        'disqualification_prompt' => 'Diskalifiye sebebi nedir?',
        'disqualified_at' => ':time_ago: diskalifiye edildi (:reason).',
        'disqualified_no_reason' => 'bir sebep belirtilmedi',
        'disqualify' => 'Diskalifiye',
        'incorrect_state' => 'Bu eylemi gerçekleştirirken bir hata oluştu, sayfayı yenilemeyi deneyin.',
        'love' => 'Sevilenlere ekle',
        'love_confirm' => 'Bu beatmapi seviyor musun?',
        'nominate' => 'Aday Göster',
        'nominate_confirm' => 'Beatmap aday gösterilsin mi?',
        'nominated_by' => ':users tarafından aday gösterildi',
        'not_enough_hype' => "Yeterince gaz yok.",
        'qualified' => 'Eğer bir sorun bulunmazsa, :date tarihinde dereceli olacağı tahmin ediliyor.',
        'qualified_soon' => 'Eğer bir sorun bulunmazsa, yakında dereceli olacağı tahmin ediliyor.',
        'required_text' => 'Aday Göstermeler: :current/:required',
        'reset_message_deleted' => 'silindi',
        'title' => 'Adaylık Durumu',
        'unresolved_issues' => 'Halen çözülmesi gereken sorunlar mevcut.',

        'reset_at' => [
            'nomination_reset' => 'Adaylık süreci :time_ago :user tarafından yeni :discussion (:message) sorunu sebebiyle sıfırlandı.',
            'disqualify' => ':time_ago :user tarafından yeni bir sorun üzerine :discussion diskalifiye edildi (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Emin misin? Yeni bir sorun bildirmek aday gösterme sürecini sıfırlayacaktır.',
            'disqualify' => 'Emin misiniz? Bu beatmap\'in niteliğini silecek ve adaylık süresine sıfırlayacak.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'anahtar kelimeler yazın...',
            'login_required' => 'Arama yapmak için giriş yap.',
            'options' => 'Diğer Arama Seçenekleri',
            'supporter_filter' => ':filters ile filtrelemek için aktif bir osu!supporter etiketi gereklidir',
            'not-found' => 'sonuç bulunamadı',
            'not-found-quote' => '... yok, bir şey bulunamadı.',
            'filters' => [
                'general' => 'Genel',
                'mode' => 'Mod',
                'status' => 'Kategoriler',
                'genre' => 'Tür',
                'language' => 'Dil',
                'extra' => 'ekstra',
                'rank' => 'Alınan Derece',
                'played' => 'Oynanmışlık',
            ],
            'sorting' => [
                'title' => 'Başlık',
                'artist' => 'Sanatçı',
                'difficulty' => 'Zorluk',
                'favourites' => 'Favoriler',
                'updated' => 'Güncellendi',
                'ranked' => 'Sırada yer aldı',
                'rating' => 'Derecelendirme',
                'plays' => 'Oynamalar',
                'relevance' => 'Alaka düzeyi',
                'nominations' => 'Adaylıklar',
            ],
            'supporter_filter_quote' => [
                '_' => ':filters ile filtrelemek için aktif bir :link gerekli',
                'link_text' => 'osu!supporter etiketi',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Önerilen zorluk seviyesi',
        'converts' => 'Dönüştürülmüş beatmapleri dahil et',
    ],
    'mode' => [
        'any' => 'Hepsi',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Hepsi',
        'approved' => 'Onaylı',
        'favourites' => 'Favoriler',
        'graveyard' => 'Mezarlık',
        'leaderboard' => 'Liderlik tablosu olanlar',
        'loved' => 'Sevilen',
        'mine' => 'Benim haritalarım',
        'pending' => 'Beklemede & Yapım Aşamasında',
        'qualified' => 'Nitelikli',
        'ranked' => 'Dereceli',
    ],
    'genre' => [
        'any' => 'Hepsi',
        'unspecified' => 'Belirtilmemiş',
        'video-game' => 'Bilgisayar Oyunu',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Diğer',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronik',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => 'Ayna',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'İngilizce',
        'chinese' => 'Çince',
        'french' => 'Fransızca',
        'german' => 'Almanca',
        'italian' => 'İtalyanca',
        'japanese' => 'Japonca',
        'korean' => 'Korece',
        'spanish' => 'İspanyolca',
        'swedish' => 'İsveççe',
        'instrumental' => 'Enstrümental',
        'other' => 'Diğer',
    ],
    'played' => [
        'any' => 'Hepsi',
        'played' => 'Oynanmış',
        'unplayed' => 'Oynanmamış',
    ],
    'extra' => [
        'video' => 'Videolu',
        'storyboard' => 'Storyboard\'lu',
    ],
    'rank' => [
        'any' => 'Hepsi',
        'XH' => 'Gümüş SS',
        'X' => '',
        'SH' => 'Gümüş S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Oynanma sayısı',
        'favourites' => 'Favoriler',
    ],
];
