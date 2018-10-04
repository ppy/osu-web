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
    'header' => [
        'small' => 'Yalnızca dairelere tıklamaktan başka yollarda yarışın.',
        'large' => 'Topluluk Yarışmaları',
    ],
    'voting' => [
        'over' => 'Bu yarışma için oylama sona erdi',
        'login_required' => 'Oylamak için lütfen giriş yapınız.',
        'best_of' => [
            'none_played' => "Bu yarışma için geçerli olan hiçbir beatmapi oynamamışsınız!",
        ],
    ],
    'entry' => [
        '_' => 'girdi',
        'login_required' => 'Yarışmaya katılmak için giriş yapınız.',
        'silenced_or_restricted' => 'Kısıtlanmış veya susturulmuşken yarışmalara katılamazsınız.',
        'preparation' => 'Şu an bu yarışmayı hazırlıyoruz. Lütfen sabırla bekleyiniz!',
        'over' => 'Girdileriniz için teşekkürler! Bu yarışma için gönderiler kapandı ve yakında oylamalara açılacak.',
        'limit_reached' => 'Bu yarışma için girdi sınırına ulaştınız',
        'drop_here' => 'Girdinizi buraya bırakın',
        'wrong_type' => [
            'art' => 'Bu yarışma için sadece .jpg ve .png dosyaları kabul edilir.',
            'beatmap' => 'Bu yarışma için sadece .osu dosyaları kabul edilir.',
            'music' => 'Bu yarışma için sadece .mp3 dosyaları kabul edilir.',
        ],
        'too_big' => 'Bu yarışma için :limit girdi gönderilebilir.',
    ],
    'beatmaps' => [
        'download' => 'Girdiyi İndir',
    ],
    'vote' => [
        'list' => 'oylar',
        'count' => ':count oy',
    ],
    'dates' => [
        'ended' => ':date tarihinde sona erdi',

        'starts' => [
            '_' => 'Başlangıç :date',
            'soon' => 'yakında™',
        ],
    ],
    'states' => [
        'entry' => 'Girişler Açık',
        'voting' => 'Oylama Başladı',
        'results' => 'Sonuçlar Çıktı',
    ],
];
