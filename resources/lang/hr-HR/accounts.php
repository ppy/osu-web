<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'postavke',
        'username' => 'korisničko ime',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Provjeri da li je tvoj avatar u skladu s :link.<br/>To znači da mora biti <strong>prikladno za sve uzraste</strong>. tj. bez golotinje, vulgarnosti ili sugestivnog sadržaja.',
            'rules_link' => 'pravilima zajednice',
        ],

        'email' => [
            'current' => 'trenutna e-mail adresa',
            'new' => 'nova e-mail adresa',
            'new_confirmation' => 'potvrda e-mail adrese',
            'title' => 'E-mail adresa',
        ],

        'password' => [
            'current' => 'trenutna lozinka',
            'new' => 'nova lozinka',
            'new_confirmation' => 'potvrda lozinke',
            'title' => 'Lozinka',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'trenutna lokacija',
                'user_interests' => 'interesi',
                'user_occ' => 'zanimanje',
                'user_twitter' => '',
                'user_website' => 'web stranica',
            ],
        ],

        'signature' => [
            'title' => 'Potpis',
            'update' => 'ažuriraj',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'primaj obavijesti o novom problemu na kvalificiranim beatmap-ima sljedećih modusa',
        'beatmapset_disqualify' => 'primaj obavijesti kad beatmap-ovi sljedećih modusa budu diskvalificirani',
        'comment_reply' => 'primaj obavijesti za odgovore na tvoje komentare',
        'title' => 'Obavijesti',
        'topic_auto_subscribe' => 'automatski uključi obavijesti na nove forum teme koje kreiraš',

        'options' => [
            '_' => 'načine isporuke',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => '',
            'channel_message' => 'privatne chat poruke',
            'comment_new' => 'nove komentare',
            'forum_topic_reply' => 'odgovor na temu',
            'mail' => 'mail',
            'mapping' => '',
            'push' => 'push',
            'user_achievement_unlock' => 'otključanje korisničke medalje',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'odobreni klijenti',
        'own_clients' => 'vlastiti klijenti',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'sakrij upozorenja za eksplicitni sadržaj u beatmap-ama',
        'beatmapset_title_show_original' => 'prikaži metapodatke beatmap-a na izvornom jeziku',
        'title' => 'Opcije',

        'beatmapset_download' => [
            '_' => 'zadana vrsta za preuzimanje beatmap-a',
            'all' => 'sa videom ako je dostupno',
            'direct' => 'otvori u osu!direct',
            'no_video' => 'bez videa',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tipkovnica',
        'mouse' => 'miš',
        'tablet' => 'tablet',
        'title' => 'Način igranja',
        'touch' => 'dodir',
    ],

    'privacy' => [
        'friends_only' => 'blokiraj privatne poruke od osoba koje nisu na tvojoj listi prijatelja',
        'hide_online' => 'sakrij svoju prisutnost na mreži',
        'title' => 'Privatnost',
    ],

    'security' => [
        'current_session' => 'trenutna',
        'end_session' => 'Završi sesiju',
        'end_session_confirmation' => 'Ovo će odmah prekinuti tvoju sesiju na tom uređaju. Jesi li siguran?',
        'last_active' => 'Zadnja aktivnost:',
        'title' => 'Sigurnost',
        'web_sessions' => 'web sesije',
    ],

    'update_email' => [
        'update' => 'ažuriraj',
    ],

    'update_password' => [
        'update' => 'ažuriraj',
    ],

    'verification_completed' => [
        'text' => 'Možes ovaj tab/prozor sada zatvoriti',
        'title' => 'Verifikacija je završena',
    ],

    'verification_invalid' => [
        'title' => 'Nevažeći ili isteknut link za verifikaciju',
    ],
];
