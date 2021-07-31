<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Onaylı.',
        'beatmap_owner_change' => ':beatmap zorluğunun sahibi :new_user kullanıcısı ile değiştirildi.',
        'discussion_delete' => 'Moderatör :discussion tartışmasını sildi.',
        'discussion_lock' => 'Bu beatmap için tartışma sağlandı',
        'discussion_post_delete' => ':discussion tartışmasındaki gönderi Moderatör tarafından silindi.',
        'discussion_post_restore' => ':discussion tartışmasındaki gönderi Moderatör tarafından restore edildi.',
        'discussion_restore' => ':discussion tartışması moderatör tarafından restore edildi.',
        'discussion_unlock' => 'Bu beatmap için tartışma sağlandı.',
        'disqualify' => ':user tarafından diskalifiye edildi. Sebep: :discussion (:text).',
        'disqualify_legacy' => ':user tarafından diskalifiye edildi. Sebep: :text.',
        'genre_edit' => 'Tür :old dan :new ile değiştirildi.',
        'issue_reopen' => ':discussion tartışmasında çözülen sorun tekrar tartışmaya açıldı.',
        'issue_resolve' => ':discussion tartışmasındaki sorun çözüldü olarak işaretlendi.',
        'kudosu_allow' => ':discussion tartışmasındaki Kudosu reddi kaldırıldı.',
        'kudosu_deny' => ':discussion tartışmasına kudosu reddi kondu.',
        'kudosu_gain' => ':discussion tartışması sahibi :user kudosu için yeterli oy topladı.',
        'kudosu_lost' => ':discussion tartışması sahibi :user oy kaybetti ve aldığı kudosu kaldırıldı.',
        'kudosu_recalculate' => ':discussion tartışmasının aldığı kudosu tekrar hesaplandı.',
        'language_edit' => 'Dil :old\'dan :new\'e değiştirildi.',
        'love' => ':user tarafından sevildi',
        'nominate' => ':user tarafından aday gösterildi.',
        'nominate_modes' => ' :user (:modes) tarafından aday gösterildi.',
        'nomination_reset' => 'Yeni sorun :discussion (:text) bir adaylık sıfırlamasını tetikledi.',
        'nomination_reset_received' => '',
        'nomination_reset_received_profile' => '',
        'qualify' => 'Bu beatmap gerekli aday gösterilme miktarına ulaştı ve nitelikli oldu.',
        'rank' => 'Dereceli.',
        'remove_from_loved' => ':user tarafından Sevilenlerden çıkarıldı (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Müstehcen işareti kaldırıldı',
            'to_1' => 'Müstehcen olarak işaretlendi',
        ],
    ],

    'index' => [
        'title' => 'Beatmap Seti Etkinlikleri',

        'form' => [
            'period' => 'Zaman Periyodu',
            'types' => 'Türler',
        ],
    ],

    'item' => [
        'content' => 'İçerik',
        'discussion_deleted' => '[silindi]',
        'type' => 'Tür',
    ],

    'type' => [
        'approve' => 'Onay',
        'beatmap_owner_change' => 'Zorluk sahibi değiştirme',
        'discussion_delete' => 'Tartışma silindi',
        'discussion_post_delete' => 'Tartışma yanıtı silme',
        'discussion_post_restore' => 'Tartışma yanıtı geri getirme',
        'discussion_restore' => 'Tartışma geri getirme',
        'disqualify' => 'Diskalifiye',
        'genre_edit' => 'Tür düzeni',
        'issue_reopen' => 'Tekrar açılan tartışmalar',
        'issue_resolve' => 'Tartışma çözümü',
        'kudosu_allow' => 'Kudosu avansı',
        'kudosu_deny' => 'Kudosu reddi',
        'kudosu_gain' => 'Kudosu kazancı',
        'kudosu_lost' => 'Kudosu kaybı',
        'kudosu_recalculate' => 'Kudosu tekrar hesaplama',
        'language_edit' => 'Dil düzeni',
        'love' => 'Love',
        'nominate' => 'Adaylık',
        'nomination_reset' => 'Adaylık Sıfırlama',
        'nomination_reset_received' => '',
        'nsfw_toggle' => 'Müstehcen işareti',
        'qualify' => 'Adaylık',
        'rank' => 'Sıralama',
        'remove_from_loved' => 'Sevilenlerden çıkarma',
    ],
];
