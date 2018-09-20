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
    'not_negative' => ':attribute negatif olamaz.',
    'required' => ':attribute gereklidir.',
    'too_long' => ':attribute azami uzunluğu aştı - sadece :limit karakter olabilir.',
    'wrong_confirmation' => 'Doğrulama eşleşmiyor.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Tartışma kilitli.',
        'first_post' => 'Başlangıç yazısı silinemez.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Zaman damgası belirtildi, ancak beatmap eksik.',
        'beatmapset_no_hype' => "Bu beatmap'e destek oyu verilemez.",
        'hype_requires_null_beatmap' => 'Gaz Genel (tüm zorluklar) sekmesinde verilmelidir.',
        'invalid_beatmap_id' => 'Yanlış zorluk belirtildi.',
        'invalid_beatmapset_id' => 'Yanlış beatmap belirtildi.',
        'locked' => 'Tartışma kilitli.',

        'hype' => [
            'guest' => 'Destek oyu vermek için giriş yapmalısın.',
            'hyped' => 'Bu beatmap\'e zaten destek oyu kullandın.',
            'limit_exceeded' => 'Tüm destek oylarını kullandın.',
            'not_hypeable' => 'Bu beatmap gaza getirilemez',
            'owner' => 'Kendi beatmapine destek oy kullanamazsın.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Belirtilen zaman damgası beatmap\'in uzunluğunu aşmakta.',
            'negative' => "Zaman damgası negatif olamaz.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Yalnızca bir özellik isteğine oy verebilirsiniz.',
            'not_enough_feature_votes' => 'Yetersiz oy.',
        ],

        'poll_vote' => [
            'invalid' => 'Geçersiz seçenek belirtildi.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Beatmap üstverisi gönderisinin silinmesi yasaktır.',
            'beatmapset_post_no_edit' => 'Beatmap üstverisi gönderisini düzenlemek yasaktır.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Yinelenen seçenekler yasaktır.',
            'invalid_max_options' => 'Kullanıcı başına seçenek sayısı mevcut seçenek sayısını geçemez.',
            'minimum_one_selection' => 'Kullanıcı başına en az bir seçenek gereklidir.',
            'minimum_two_options' => 'En az iki seçenek gereklidir.',
            'too_many_options' => 'İzin verilen maksimum seçenek sayısı aşıldı.',
        ],

        'topic_vote' => [
            'required' => 'Oy verirken bir seçenek seçin.',
            'too_many' => 'İzin verilenden fazla seçenek seçildi.',
        ],
    ],

    'user' => [
        'contains_username' => 'Şifre kullanıcı adını içeremez.',
        'email_already_used' => 'E-posta adresi zaten kullanılıyor.',
        'invalid_country' => 'Ülke, veritabanında bulunmuyor.',
        'invalid_discord' => 'Discord kullanıcı adı hatalı.',
        'invalid_email' => "Geçerli bir e-posta adresi gibi görünmüyor.",
        'too_short' => 'Yeni şifre çok kısa.',
        'unknown_duplicate' => 'Kullanıcı adı ya da e-posta zaten kullanımda.',
        'username_available_in' => 'Bu kullanıcı adı :duration içinde kullanıma açılacak.',
        'username_available_soon' => 'Bu kullanıcı adı hemen her an kullanıma açılabilir!',
        'username_invalid_characters' => 'İstenen kullanıcı adı geçersiz karakterler içeriyor.',
        'username_in_use' => 'Kullanıcı adı zaten kullanımda!',
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

        'change_username' => [
            'supporter_required' => [
                '_' => 'İsminizi değiştirmek için :link olmanız gerekli!',
                'link_text' => 'osu!\'u desteklemiş',
            ],
            'username_is_same' => 'Bu zaten senin kullanıcı adın, şapşal!',
        ],
    ],
];
