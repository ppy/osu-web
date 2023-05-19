<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'nastavitve',
        'username' => 'uporabniško ime',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Prosimo, da naj se tvoj avatar drži :link.<br/>To pomeni, da mora biti <strong>primerno za vse starosti</strong>. t.j. Nič golote, kletvic ali druge neželene vsebine.',
            'rules_link' => 'pravila skupnosti',
        ],

        'email' => [
            'new' => 'nova e-pošta',
            'new_confirmation' => 'potrditev e-pošte',
            'title' => 'E-pošta',
        ],

        'password' => [
            'current' => 'trenutno geslo',
            'new' => 'novo geslo',
            'new_confirmation' => 'potrditev gesla',
            'title' => 'Geslo',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'trenutna lokacija',
                'user_interests' => 'hobiji',
                'user_occ' => 'zaposlitev',
                'user_twitter' => '',
                'user_website' => 'spletna stran',
            ],
        ],

        'signature' => [
            'title' => 'Podpis',
            'update' => 'posodobi',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'prejmi obvestila o novih težavah na kvalificiranih beatmapah pri naslednjih modifikatorjih',
        'beatmapset_disqualify' => 'prejmi obvestila ko so beatmape pri naslednjih modifikatorjih diskvalificirane',
        'comment_reply' => 'prejmi obvestila, ko nekdo odgovori na tvoj komentar',
        'title' => 'Obvestila',
        'topic_auto_subscribe' => 'avtomatsko omogoči obvestila o novih temah na forumu v tvoji lasti',

        'options' => [
            '_' => 'možnosti pošiljanja',
            'beatmap_owner_change' => 'težavnost za goste',
            'beatmapset:modding' => 'modificiranje beatmape',
            'channel_message' => 'zasebna sporočila',
            'comment_new' => 'novi komentarji',
            'forum_topic_reply' => 'odgovor na temo',
            'mail' => 'e-pošta',
            'mapping' => 'ustvarjalec beatmap',
            'push' => 'potisno',
            'user_achievement_unlock' => 'uporabniška medalja odklenjena',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'pooblaščene stranke',
        'own_clients' => 'zasebne stranke',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'skrij opozorila za eksplicitno vsebino v beatmapah',
        'beatmapset_title_show_original' => 'prikaži metadata beatmape v originalnem jeziku',
        'title' => 'Možnosti',

        'beatmapset_download' => [
            '_' => 'privzeti tip prenosa beatmape',
            'all' => 'z videoposnetkom',
            'direct' => 'odpri v osu!direct',
            'no_video' => 'brez videoposnetka',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tipkovnica',
        'mouse' => 'miška',
        'tablet' => 'tablica',
        'title' => 'Načini igranja',
        'touch' => 'dotik',
    ],

    'privacy' => [
        'friends_only' => 'blokiranje zasebnih sporočil ljudi, ki niso na vašem seznamu prijateljev',
        'hide_online' => 'skrij svojo prisotnost',
        'title' => 'Zasebnost',
    ],

    'security' => [
        'current_session' => 'trenutno',
        'end_session' => 'Končaj sejo',
        'end_session_confirmation' => 'Dejanje bo nemudoma končalo sejo na tej napravi. Si prepričan?',
        'last_active' => 'Zadnje aktiven:',
        'title' => 'Varnost',
        'web_sessions' => 'spletne seje',
    ],

    'update_email' => [
        'update' => 'posodobi',
    ],

    'update_password' => [
        'update' => 'posodobi',
    ],

    'verification_completed' => [
        'text' => 'Zdaj lahko zapreš ta zavihek/okno',
        'title' => 'Verifikacija je bila uspešna',
    ],

    'verification_invalid' => [
        'title' => 'Napačna ali potekla verifikacijska povezava',
    ],
];
