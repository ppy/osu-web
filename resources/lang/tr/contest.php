<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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

        'button' => [
            'add' => 'Oyla',
            'remove' => 'Oyu Kaldır',
            'used_up' => 'Tüm oylarını kullandın',
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
        'download' => '.osz indir',
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
        'count' => ':count oy|:count oy',
        'points' => ':count puan|:count puan',
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
