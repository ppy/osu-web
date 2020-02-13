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
    'limitation_notice' => 'NOT: Sadece <a href=":lazer_link">osu!lazer</a> veya yeni osu sayfasını kullanan oyuncular bu sistem aracılığıyla özel mesaj alabilecek. <br/> Eğer emin değilseniz, bunun yerine <a href=":oldpm_link">eski forum sayfasını</a> kullanarak özel mesaj atın.',
    'talking_in' => ':channel kanalındasınız',
    'talking_with' => ':name ile konuşuyorsunuz',
    'title_compact' => 'sohbet',

    'cannot_send' => [
        'channel' => 'Şu anda bu kanala mesaj yazamazsınız. Şunlardan herhangi birisi buna sebep olabilir:',
        'user' => 'Şu anda bu kişiye mesaj yazamazsınız. Şunlardan herhangi birisi buna sebep olabilir:',
        'reasons' => [
            'blocked' => 'Alıcı tarafından engellendiniz',
            'channel_moderated' => 'Bu kanal kısıtlandı',
            'friends_only' => 'Alıcı sadece arkadaş listesindeki kişilerden gelen mesajları kabul ediyor',
            'restricted' => 'Şu anda uzaklaştırıldınız',
            'target_restricted' => 'Alıcı şu an uzaklaştırılmış durumda',
        ],
    ],
    'input' => [
        'disabled' => 'mesaj gönderilemiyor...',
        'placeholder' => 'mesaj yaz...',
        'send' => 'Gönder',
    ],
    'no-conversations' => [
        'howto' => "Kullanıcının profilinden veya kullanıcı kartı popup'ından konuşma başlatın.",
        'lazer' => '<a href=":link">osu!lazer</a> aracılığıyla katıldığınız herkese açık kanallar burada da görünür olacak.',
        'pm_limitations' => 'Sadece <a href=":link">osu!lazer</a> veya yeni osu sayfasını kullanan oyuncular özel mesaj alacak.',
        'title' => 'Henüz konuşma yok.',
    ],
];
