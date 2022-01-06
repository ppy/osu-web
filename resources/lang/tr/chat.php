<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'talking_in' => ':channel kanalında konuşuyorsunuz',
    'talking_with' => ':name ile konuşuyorsunuz',
    'title_compact' => 'sohbet',

    'cannot_send' => [
        'channel' => 'Şu anda bu kanala mesaj yazamazsınız. Şunlardan herhangi birisi buna sebep olabilir:',
        'user' => 'Şu anda bu kişiye mesaj yazamazsınız. Şunlardan herhangi birisi buna sebep olabilir:',
        'reasons' => [
            'blocked' => 'Alıcı tarafından engellisiniz',
            'channel_moderated' => 'Bu kanal şu anda modere edilmekte',
            'friends_only' => 'Alıcı sadece arkadaş listesindeki kişilerden gelen mesajları kabul ediyor',
            'not_enough_plays' => 'Oyunu yeterince oynamadınız',
            'not_verified' => 'Oturumunuz doğrulanmadı',
            'restricted' => 'Şu anda hesabınız kısıtlı durumda',
            'silenced' => 'Şu anda susturulmuş durumdasınız',
            'target_restricted' => 'Alıcı şu anda kısıtlı durumda',
        ],
    ],

    'input' => [
        'disabled' => 'mesaj gönderilemiyor...',
        'disconnected' => 'Bağlantı kesildi',
        'placeholder' => 'mesaj yaz...',
        'send' => 'Gönder',
    ],

    'no-conversations' => [
        'howto' => "Kullanıcının profilinden veya kullanıcı kartı popup'ından konuşma başlatın.",
        'lazer' => '<a href=":link">osu!lazer</a> aracılığıyla katıldığınız herkese açık kanallar burada da görünür olacak.',
        'title' => 'henüz konuşma yok',
    ],
];
