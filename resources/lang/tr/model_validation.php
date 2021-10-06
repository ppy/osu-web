<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Geçersiz :attribute belirtildi.',
    'not_negative' => ':attribute negatif olamaz.',
    'required' => ':attribute gereklidir.',
    'too_long' => ':attribute azami uzunluğu aştı - sadece :limit karakter olabilir.',
    'wrong_confirmation' => 'Doğrulama eşleşmiyor.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Zaman damgası belirtildi, ancak beatmap eksik.',
        'beatmapset_no_hype' => "Beatmap gazlanamaz.",
        'hype_requires_null_beatmap' => 'Gaz, Genel (tüm zorluklar) sekmesinde verilmelidir.',
        'invalid_beatmap_id' => 'Yanlış zorluk belirtildi.',
        'invalid_beatmapset_id' => 'Yanlış beatmap belirtildi.',
        'locked' => 'Tartışma kilitli.',

        'attributes' => [
            'message_type' => 'Mesaj türü',
            'timestamp' => 'Zaman damgası',
        ],

        'hype' => [
            'discussion_locked' => "Bu beatmap şu anda tartışmaya kapalıdır ve gazlanamaz",
            'guest' => 'Gazlamak giriş yapmalısın.',
            'hyped' => 'Bu beatmapi çoktan gazladın.',
            'limit_exceeded' => 'Bütün gazını kullandın.',
            'not_hypeable' => 'Bu beatmap gazlanamaz',
            'owner' => 'Kendi beatmapini gazlayamazsın.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Belirtilen zaman damgası beatmap\'in uzunluğunu aşmakta.',
            'negative' => "Zaman damgası negatif olamaz.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Tartışma kilitli.',
        'first_post' => 'Başlangıç yazısı silinemez.',

        'attributes' => [
            'message' => 'Mesaj',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Silinmiş yorumlara cevap verilemez.',
        'top_only' => 'Yorum cevabının sabitlenmesine izin verilmiyor.',

        'attributes' => [
            'message' => 'Mesaj',
        ],
    ],

    'follow' => [
        'invalid' => 'Geçersiz :attribute belirtildi.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Yalnızca bir özellik talebine oy verebilirsiniz.',
            'not_enough_feature_votes' => 'Yetersiz oy.',
        ],

        'poll_vote' => [
            'invalid' => 'Geçersiz seçenek belirtildi.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Beatmap metaveri gönderisinin silinmesi yasaktır.',
            'beatmapset_post_no_edit' => 'Beatmap metaveri gönderisini düzenlemek yasaktır.',
            'first_post_no_delete' => 'Başlangıç gönderisi silinemez',
            'missing_topic' => 'Gönderinin konusu eksik',
            'only_quote' => 'Cevabınız sadece bir alıntı içeriyor.',

            'attributes' => [
                'post_text' => 'Gönderi içeriği',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Konu başlığı',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Yinelenen seçenekler yasaktır.',
            'grace_period_expired' => ':limit saatten sonra bir anket düzenlenemez',
            'hiding_results_forever' => 'Asla bitmeyen bir anketin sonuçları saklanamaz.',
            'invalid_max_options' => 'Kullanıcı başına seçenek sayısı mevcut seçenek sayısını geçemez.',
            'minimum_one_selection' => 'Kullanıcı başına en az bir seçenek gereklidir.',
            'minimum_two_options' => 'En az iki seçenek gereklidir.',
            'too_many_options' => 'İzin verilen maksimum seçenek sayısı aşıldı.',

            'attributes' => [
                'title' => 'Anket başlığı',
            ],
        ],

        'topic_vote' => [
            'required' => 'Oy verirken bir seçenek seçin.',
            'too_many' => 'İzin verilenden fazla seçenek seçildi.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'İzin verilen azami OAuth uygulama sayısı aşıldı.',
            'url' => 'Lütfen geçerli bir URL giriniz.',

            'attributes' => [
                'name' => 'Uygulama Adı',
                'redirect' => 'Uygulama Geri Çağırma URL\'si',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Şifre kullanıcı adını içeremez.',
        'email_already_used' => 'E-posta adresi zaten kullanılıyor.',
        'email_not_allowed' => 'E-posta adresine izin verilmiyor.',
        'invalid_country' => 'Ülke, veritabanında bulunmuyor.',
        'invalid_discord' => 'Discord kullanıcı adı hatalı.',
        'invalid_email' => "Geçerli bir e-posta adresi gibi görünmüyor.",
        'invalid_twitter' => 'Twitter kullanıcı adı hatalı.',
        'too_short' => 'Yeni şifre çok kısa.',
        'unknown_duplicate' => 'Kullanıcı adı ya da e-posta zaten kullanımda.',
        'username_available_in' => 'Bu kullanıcı adı :duration içinde kullanıma açılacak.',
        'username_available_soon' => 'Bu kullanıcı adı hemen her an kullanıma açılabilir!',
        'username_invalid_characters' => 'İstenen kullanıcı adı geçersiz karakterler içeriyor.',
        'username_in_use' => 'Kullanıcı adı zaten kullanımda!',
        'username_locked' => 'Kullanıcı adı zaten kullanımda!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Lütfen ya alt çizgi ya da boşluk kullanın, ikisini birden değil!',
        'username_no_spaces' => "Kullanıcı adı boşluk ile başlayamaz ya da bitemez!",
        'username_not_allowed' => 'Kullanıcı adı seçimine izin verilmiyor.',
        'username_too_short' => 'İstenen kullanıcı adı çok kısa.',
        'username_too_long' => 'İstenen kullanıcı adı çok uzun.',
        'weak' => 'Kara listeye eklenmiş şifre.',
        'wrong_current_password' => 'Mevcut şifre hatalı.',
        'wrong_email_confirmation' => 'E-posta doğrulaması eşleşmiyor.',
        'wrong_password_confirmation' => 'Şifre doğrulaması eşleşmiyor.',
        'too_long' => 'Maksimum uzunluk aşıldı - yalnızca :limit karakter olabilir.',

        'attributes' => [
            'username' => 'Kullanıcı adı',
            'user_email' => 'E-posta adresi',
            'password' => 'Şifre',
        ],

        'change_username' => [
            'restricted' => 'Kısıtlanmış iken kullanıcı adını değiştiremezsin.',
            'supporter_required' => [
                '_' => 'İsminizi değiştirmek için :link olmanız gerekli!',
                'link_text' => 'osu!\'u desteklemiş',
            ],
            'username_is_same' => 'Bu zaten senin kullanıcı adın, şapşal!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Dereceli beatmapler bildirilemez',
        'reason_not_valid' => ':reason sebebi bu rapor türü için geçerli değil.',
        'self' => "Kendinizi raporlayamazsınız!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Miktar',
                'cost' => 'Ücret',
            ],
        ],
    ],
];
