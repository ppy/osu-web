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
    'event' => [
        'approve' => 'Onaylı.',
        'discussion_delete' => 'Moderatör :discussion tartışmasını sildi.',
        'discussion_lock' => 'Bu beatmap için tartışma sağlandı',
        'discussion_post_delete' => ':discussion tartışmasındaki gönderi Moderatör tarafından silindi.',
        'discussion_post_restore' => ':discussion tartışmasındaki gönderi Moderatör tarafından restore edildi.',
        'discussion_restore' => ':discussion tartışması moderatör tarafından restore edildi.',
        'discussion_unlock' => 'Bu beatmap için tartışma sağlandı.',
        'disqualify' => ':user tarafından diskalifiye edildi. Sebep: :discussion (:text).',
        'disqualify_legacy' => ':user tarafından diskalifiye edildi. Sebep: :text.',
        'issue_reopen' => ':discussion tartışmasında çözülen sorun tekrar tartışmaya açıldı.',
        'issue_resolve' => ':discussion tartışmasındaki sorun çözüldü olarak işaretlendi.',
        'kudosu_allow' => ':discussion tartışmasındaki Kudosu reddi kaldırıldı.',
        'kudosu_deny' => ':discussion tartışmasına kudosu reddi kondu.',
        'kudosu_gain' => ':discussion tartışması sahibi :user kudosu için yeterli oy topladı.',
        'kudosu_lost' => ':discussion tartışması sahibi :user oy kaybetti ve aldığı kudosu kaldırıldı.',
        'kudosu_recalculate' => ':discussion tartışmasının aldığı kudosu tekrar hesaplandı.',
        'love' => ':user tarafından sevildi',
        'nominate' => ':user tarafından aday gösterildi.',
        'nomination_reset' => 'Yeni sorun :discussion (:text) bir adaylık sıfırlamasını tetikledi.',
        'qualify' => 'Bu beatmap gerekli aday gösterilme miktarına ulaştı ve nitelikli oldu.',
        'rank' => 'Dereceli.',
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
        'discussion_delete' => 'Tartışma silindi',
        'discussion_post_delete' => 'Tartışma yanıtı silme',
        'discussion_post_restore' => 'Tartışma yanıtı geri getirme',
        'discussion_restore' => 'Tartışma geri getirme',
        'disqualify' => 'Diskalifiye',
        'issue_reopen' => 'Tekrar açılan tartışmalar',
        'issue_resolve' => 'Tartışma çözümü',
        'kudosu_allow' => 'Kudosu avansı',
        'kudosu_deny' => 'Kudosu reddi',
        'kudosu_gain' => 'Kudosu kazancı',
        'kudosu_lost' => 'Kudosu kaybı',
        'kudosu_recalculate' => 'Kudosu tekrar hesaplama',
        'love' => 'Love',
        'nominate' => 'Adaylık',
        'nomination_reset' => 'Adaylık Sıfırlama',
        'qualify' => 'Adaylık',
        'rank' => 'Sıralama',
    ],
];
