<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'postavke računa',
        'username' => 'korisničko ime',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => '',
            'rules' => 'Provjeri da li je tvoj avatar u skladu s :link.<br/>To znači da mora biti <strong>prikladno za sve uzraste</strong>. tj. bez golotinje, vulgarnosti ili sugestivnog sadržaja.',
            'rules_link' => 'pravilima zajednice',
        ],

        'email' => [
            'new' => 'nova adresa e-pošte',
            'new_confirmation' => 'potvrda adrese e-pošte',
            'title' => 'E-pošta',
            'locked' => [
                '_' => '',
                'accounts' => '',
            ],
        ],

        'legacy_api' => [
            'api' => '',
            'irc' => '',
            'title' => '',
        ],

        'password' => [
            'current' => 'trenutna lozinka',
            'new' => 'nova lozinka',
            'new_confirmation' => 'potvrda lozinke',
            'title' => 'Lozinka',
        ],

        'profile' => [
            'country' => '',
            'title' => 'Profil',

            'country_change' => [
                '_' => "",
                'update_link' => 'Promjeni na :country',
            ],

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

    'github_user' => [
        'info' => "",
        'link' => '',
        'title' => 'GitHub',
        'unlink' => '',

        'error' => [
            'already_linked' => 'Ovaj GitHub nalog je vec povezan drugom korisniku.',
            'no_contribution' => '',
            'unverified_email' => '',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'primaj obavijesti o novim problemima na kvalificiranim beatmapovima sljedećih modova',
        'beatmapset_disqualify' => 'primaj obavijesti kad beatmap-ovi sljedećih modova budu diskvalificirani',
        'comment_reply' => 'primaj obavijesti za odgovore na tvoje komentare',
        'title' => 'Obavijesti',
        'topic_auto_subscribe' => 'automatski uključi obavijesti na nove forum teme koje stvoriš',

        'options' => [
            '_' => 'načine isporuke',
            'beatmap_owner_change' => 'gostova težina',
            'beatmapset:modding' => 'modificiranje beatmapa',
            'channel_message' => 'privatne chat poruke',
            'channel_team' => '',
            'comment_new' => 'nove komentare',
            'forum_topic_reply' => 'odgovor na temu',
            'mail' => 'pošta',
            'mapping' => 'autor beatmape',
            'push' => 'push',
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
        'text' => 'Sada možeš zatvoriti ovu karticu/prozor',
        'title' => 'Potvrda je završena',
    ],

    'verification_invalid' => [
        'title' => 'Nevažeći ili isteknut link za potvrdu',
    ],
];
