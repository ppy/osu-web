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
    'codes' => [
        'http-401' => 'Devam etmek için lütfen giriş yapın.',
        'http-403' => 'Erişim engellendi.',
        'http-404' => 'Bulunamadı.',
        'http-429' => 'Çok fazla deneme yapıldı. Daha sonra tekrar deneyin.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Bir hata oluştu. Sayfayı yenilemeyi deneyin.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Geçersiz mod seçildi.',
        'standard_converts_only' => 'Bu beatmap zorluğunda seçilen mod\'da şuanda skor mevcut değil.',
    ],
    'checkout' => [
        'generic' => 'Çıkışınızı yaparken bir hata oluştu.',
    ],
    'search' => [
        'default' => 'Hiç bir sonuç bulunamadı, sonra tekrar deneyiniz.',
        'operation_timeout_exception' => 'Arama, şu an her zamankinden daha yoğun, lütfen sonra tekrar deneyiniz.',
    ],

    'logged_out' => 'Oturumunuz kapatıldı. Lütfen giriş yapın ve tekrar deneyin.',
    'supporter_only' => 'Bu özelliği kullanabilmeniz için supporter olmanız gerekmektedir.',
    'no_restricted_access' => 'Hesabınız kısıtlanmış durumdayken bu işlemi gerçekleştiremezsiniz.',
    'unknown' => 'Bilinmeyen bir hata oluştu.',
];
