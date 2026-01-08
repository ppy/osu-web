<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'nustatymai',
        'username' => 'vartotojo vardas',

        'avatar' => [
            'title' => 'Avataras',
            'reset' => 'atstatyti',
            'rules' => 'Prašome užtikrinti, kad avataras atitinka :link.<br/>Reiškias jis turi būti<strong> tinkamas visiems amžiams </strong>. pvz. nėra nuogybių, nešvankybių ar kito pažeidžiamo tūrinio.',
            'rules_link' => 'bendruomenės taisyklės',
        ],

        'email' => [
            'new' => 'naujas el. paštas',
            'new_confirmation' => 'el. pašto patvirtinimas',
            'title' => 'El. Paštas',
            'locked' => [
                '_' => 'Prašome susisiekti su :accounts jei tau reikia atnaujinti el. paštą.',
                'accounts' => 'paskyros pagalbos komanda',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Sena API versija',
        ],

        'password' => [
            'current' => 'dabartinis slaptažodis',
            'new' => 'naujas slaptažodis',
            'new_confirmation' => 'slaptažodžio patvirtinimas',
            'title' => 'Slaptažodis',
        ],

        'profile' => [
            'country' => 'šalis',
            'title' => 'Profilis',

            'country_change' => [
                '_' => "Panašu, kad tavo šalis, nesutampa su šalimi, kurioje gyveni. :update_link.",
                'update_link' => 'Pakeisti į :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'dabartinė vieta',
                'user_interests' => 'pomėgiai',
                'user_occ' => 'profesija',
                'user_twitter' => '',
                'user_website' => 'tinklalapis',
            ],
        ],

        'signature' => [
            'title' => 'Parašas',
            'update' => 'išsaugoti',
        ],
    ],

    'github_user' => [
        'info' => "Jei prisidedate prie osu! atvirojo kodo saugyklų, susiejant jūsų GitHub paskyrą galite pririšti jūsų pakeitimų pateiktis prie jūsų osu! paskyros. GitHub paskyros be jokios prisidėjimų prie osu! istorijos negali būti susietos.",
        'link' => 'Susieti GitHub paskyrą',
        'title' => 'GitHub',
        'unlink' => 'Atsieti GitHub paskyrą',

        'error' => [
            'already_linked' => 'Ši GitHub paskyra jau yra susieta su kitu naudotuju.',
            'no_contribution' => 'Negalima susieti GitHub paskyros be įnašų istorijos osu! saugyklose.',
            'unverified_email' => 'Prašome patvirtinti jūsų pagrindinį el. pašto adresą GitHub platformoje, tada vėl bandyti susieti su savo paskyra.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'gauti pranešimus dėl naujų problemų kvalifikuotuose beatmap\'uose šiuose režimuose ',
        'beatmapset_disqualify' => 'gauti pranešimus, kai šių režimų beatmap\'ai diskvalifikuojami',
        'comment_reply' => 'gauti pranešimus apie atsakymus ant jūsų komentarų',
        'news_post' => '',
        'title' => 'Pranešimai',
        'topic_auto_subscribe' => 'automatiškai įjungti pranešimus naujuose forumo temose kurias tu sukūrei',

        'options' => [
            '_' => 'pristatymo būdai',
            'beatmap_owner_change' => 'svečio sunkumas',
            'beatmapset:modding' => 'beatmap\'ų taisymai',
            'channel_message' => 'privatūs susirašinėjimai',
            'channel_team' => 'komandos žinutės',
            'comment_new' => 'nauji komentarai',
            'forum_topic_reply' => 'temos atsakymas',
            'mail' => 'paštas',
            'mapping' => 'beatmap\'o kūrėjas',
            'news_post' => '',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autorizuoti klientai',
        'own_clients' => 'jūsų turimi klientai',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'slėpti perspėjimus dėl eksplicitinio turinio beatmap\'uose',
        'beatmapset_title_show_original' => 'rodyti beatmap\'o metaduomenys orginaliaja kalba',
        'title' => 'Parinktys',

        'beatmapset_download' => [
            '_' => 'numatytasis beatmap\'ų siuntimosi tipas
',
            'all' => 'su vaizdo įrašų, jei yra',
            'direct' => 'atidaryti per osu!direct',
            'no_video' => 'be vaizdo įrašo',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'klaviatūra',
        'mouse' => 'pelė',
        'tablet' => 'grafinė planšetė',
        'title' => 'Žaidimo stilius',
        'touch' => 'liečiamas ekranas',
    ],

    'privacy' => [
        'friends_only' => 'blokuoti privačias žinutes iš žmonių kurių nėra draugų sąraše',
        'hide_online' => 'paslėpti jūsų prisijungimo sesiją',
        'hide_online_info' => '',
        'title' => 'Privatumas',
    ],

    'security' => [
        'current_session' => 'dabartinis',
        'end_session' => 'Užbaigti sesiją',
        'end_session_confirmation' => 'Tai iškarto pabaigs sesiją tame įrenginyje. Ar jūs isitikinęs?',
        'last_active' => 'Paskutinį kartą aktyvus:',
        'title' => 'Saugumas',
        'web_sessions' => 'internetinės sesijos',
    ],

    'update_email' => [
        'update' => 'užsaugoti',
    ],

    'update_password' => [
        'update' => 'atnaujinti',
    ],

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => 'Galite uždaryti šį skirtuką/langą dabar',
        'title' => 'Patvirtinimas užbaigtas',
    ],

    'verification_invalid' => [
        'title' => 'Netinkama arba nebegaliojanti patvirtinimo nuoroda',
    ],
];
