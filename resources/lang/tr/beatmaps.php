<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
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
        'guest' => ':user kullanıcısının konuk zorluğu',
        'kudosu_denied' => 'Kudosu almaktan mahrum bırakıldı.',
        'message_placeholder_deleted_beatmap' => 'Bu zorluk seviyesi silindi o yüzden hakkında daha fazla tartışılamaz.',
        'message_placeholder_locked' => 'Bu beatmap için tartışma devre dışı bırakıldı.',
        'message_placeholder_silenced' => "Susturulduğunuzda tartışma gönderisi gönderemezsiniz.",
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
                'unlock' => 'Tartışmanın kilidini açmak istediğine emin misin?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Bu gönderi beatmap setinin genel tartışmasına gidecek. Bu beatmapi modlamak için mesajı bir zaman damgası ile başlatın (ör: 00:12:345).',
            'in_timeline' => 'Birden fazla zaman damgasını modlamak için, birden fazla gönderi yapın (gönderi başına bir zaman damgası).',
        ],

        'message_placeholder' => [
            'general' => 'Genel\'e yazmak için burayı kullanın (:version)',
            'generalAll' => 'Genel\'e yazmak için burayı kullanın (tüm zorluklar)',
            'review' => 'İnceleme göndermek için buraya yazın',
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

        'review' => [
            'new' => 'Yeni İnceleme',
            'embed' => [
                'delete' => 'Sil',
                'missing' => '[TARTIŞMA SİLİNDİ]',
                'unlink' => 'Bağlantıyı kaldır',
                'unsaved' => 'Kaydedilmemiş',
                'timestamp' => [
                    'all-diff' => '"Tüm zorluklar" kısmındaki gönderilere zaman damgası yerleştirilemez.',
                    'diff' => 'Eğer bu :type bir zaman damgasıyla başlıyorsa, Zaman çizgisi altında gösterilecektir.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'paragraf ekle',
                'praise' => 'övgü ekle',
                'problem' => 'sorun ekle',
                'suggestion' => 'öneri ekle',
            ],
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
                'down' => 'En son eksi oylar',
                'up' => 'En son artı oylar',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Beatmapi Gazla!',
        'button_done' => 'Çoktan Gazlandı!',
        'confirm' => "Emin misiniz? Bu işlem kalan :n adet gaz hakkından birini kullanacak ve geriye alınamayacak.",
        'explanation' => 'Bu beatmapi aday gösterilmesi ve dereceli olması için daha görünür yapmak için gazla!',
        'explanation_guest' => 'Giriş yap ve bu beatmapi gazlayarak, aday gösterilmesi ve dereceli olması için daha görünür yap!',
        'new_time' => "Bir sonraki gaz :new_time tarihinde gelecek.",
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
        'disqualify' => 'Diskalifiye et',
        'incorrect_state' => 'Bu eylemi gerçekleştirirken bir hata oluştu, sayfayı yenilemeyi deneyin.',
        'love' => 'Sevilenlere ekle',
        'love_choose' => 'Sevilen\'lere eklenecek zorluğu seçin',
        'love_confirm' => 'Bu beatmapi seviyor musun?',
        'nominate' => 'Aday Göster',
        'nominate_confirm' => 'Beatmap aday gösterilsin mi?',
        'nominated_by' => ':users tarafından aday gösterildi',
        'not_enough_hype' => "Yeterince gaz yok.",
        'remove_from_loved' => 'Sevilenlerden Çıkar',
        'remove_from_loved_prompt' => 'Sevilenlerden çıkarılma sebebi:',
        'required_text' => 'Aday Göstermeler: :current/:required',
        'reset_message_deleted' => 'silindi',
        'title' => 'Adaylık Durumu',
        'unresolved_issues' => 'Halen çözülmesi gereken sorunlar mevcut.',

        'rank_estimate' => [
            '_' => 'Herhangi bir sorun bulunmazsa mapin tahminen dereceli olacağı vakit :date. :queue :position. sırada bulunuyor.',
            'queue' => 'Derecelendirme sırasında',
            'soon' => 'çok yakın',
        ],

        'reset_at' => [
            'nomination_reset' => 'Adaylık süreci :time_ago :user tarafından yeni :discussion (:message) sorunu sebebiyle sıfırlandı.',
            'disqualify' => ':time_ago :user tarafından yeni bir sorun üzerine :discussion diskalifiye edildi (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Emin misin? Yeni bir sorun bildirmek aday gösterme sürecini sıfırlayacaktır.',
            'disqualify' => 'Emin misiniz? Bu, beatmapin nitelikli olmasını önleyecek ve aday gösterme sürecini sıfırlayacak.',
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
                'extra' => 'ekstra',
                'general' => 'Genel',
                'genre' => 'Tür',
                'language' => 'Dil',
                'mode' => 'Mod',
                'nsfw' => 'Müstehcen İçerik',
                'played' => 'Oynanmışlık',
                'rank' => 'Alınan Derece',
                'status' => 'Kategoriler',
            ],
            'sorting' => [
                'title' => 'Başlık',
                'artist' => 'Sanatçı',
                'difficulty' => 'Zorluk',
                'favourites' => 'Favoriler',
                'updated' => 'Güncellendi',
                'ranked' => 'Dereceli olma',
                'rating' => 'Reyting',
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
        'converts' => 'Dönüştürülmüş beatmapleri dahil et',
        'follows' => 'Abone olunan mapperlar',
        'recommended' => 'Önerilen zorluk seviyesi',
    ],
    'mode' => [
        'all' => 'Hepsi',
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
        'graveyard' => 'Mezarlıkta',
        'leaderboard' => 'Liderlik tablosu olanlar',
        'loved' => 'Sevilen',
        'mine' => 'Benim Maplerim',
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
        'metal' => 'Metal',
        'classical' => 'Klasik',
        'folk' => 'Folk',
        'jazz' => 'Caz',
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
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
    ],
    'language' => [
        'any' => 'Herhangi biri',
        'english' => 'İngilizce',
        'chinese' => 'Çince',
        'french' => 'Fransızca',
        'german' => 'Almanca',
        'italian' => 'İtalyanca',
        'japanese' => 'Japonca',
        'korean' => 'Korece',
        'spanish' => 'İspanyolca',
        'swedish' => 'İsveççe',
        'russian' => 'Rusça',
        'polish' => 'Lehçe',
        'instrumental' => 'Enstrümantal',
        'other' => 'Diğer',
        'unspecified' => 'Belirtilmemiş',
    ],

    'nsfw' => [
        'exclude' => 'Gizle',
        'include' => 'Göster',
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
        'playcount' => 'Oynanma sayısı: :count',
        'favourites' => 'Favoriler: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Tümü',
        ],
    ],
];
