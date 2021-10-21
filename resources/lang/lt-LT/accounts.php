<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'nustatymai',
        'username' => 'vartotojo vardas',

        'avatar' => [
            'title' => 'Avataras',
            'rules' => 'Prašome pasitikrinti ar jūsų avataras yra susiję su :link.<br/> Tai reiškia turi būti<strong> paskirtas visam amžiuje </strong> tai yra nėra nuogų, ar kitų pažeidžiamo tūrinio.',
            'rules_link' => 'bendruomenės taisyklės',
        ],

        'email' => [
            'current' => 'dabartinis el. paštas',
            'new' => 'naujas el. paštas',
            'new_confirmation' => 'el. pašto patvirtinimas',
            'title' => 'El. Paštas',
        ],

        'password' => [
            'current' => 'dabartinis slaptažodis',
            'new' => 'naujas slaptažodis',
            'new_confirmation' => 'slaptažodžio patvirtinimas',
            'title' => 'Slaptažodis',
        ],

        'profile' => [
            'title' => 'Profilis',

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

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'gauti pranešimus dėl naujų problemų ant išlaikytų ritmo žemėlapių ar kitas susijusių modų',
        'beatmapset_disqualify' => 'gauti pranešimus tada kai beatmap šių režimų yra diskvalifikuoti',
        'comment_reply' => 'gauti pranešimus apie atsakymus ant jūsų komentarų',
        'title' => 'Pranešimai',
        'topic_auto_subscribe' => 'automatiškai įjungti pranešimus naujuose forumo temose kurias tu sukūrei',

        'options' => [
            '_' => 'pristatymo būdai',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'beatmap modifikacijos',
            'channel_message' => 'privatūs susirašinėjimo rašymas',
            'comment_new' => 'nauji komentarai',
            'forum_topic_reply' => 'temos atsakymas',
            'mail' => 'paštas',
            'mapping' => '',
            'push' => 'push',
            'user_achievement_unlock' => 'žaidėjo medalis atrakintas',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autorizuoti klientai',
        'own_clients' => 'jūsų turimi klientai',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => '',
        'beatmapset_title_show_original' => 'rodyti beatmap duomenis originalo kalboje',
        'title' => 'Nustatymai',

        'beatmapset_download' => [
            '_' => 'paprastas beatmap siuntimosi tipas
',
            'all' => 'su vaizdo įrašų jei galima',
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
        'title' => 'Privatumas',
    ],

    'security' => [
        'current_session' => 'dabartinis',
        'end_session' => 'Užbaigti sesiją',
        'end_session_confirmation' => 'Tai iškarto pabaigs sesiją tame įrenginyje. Ar jūs isitikinęs?',
        'last_active' => 'Paskutinį kartą aktyvus:',
        'title' => 'Apsauga',
        'web_sessions' => 'internetinės sesijos',
    ],

    'update_email' => [
        'update' => 'atnaujinti',
    ],

    'update_password' => [
        'update' => 'atnaujinti',
    ],

    'verification_completed' => [
        'text' => 'Galite uždaryti šį skirtuką/langą dabar',
        'title' => 'Patvirtinimas užbaigtas',
    ],

    'verification_invalid' => [
        'title' => 'Netinkamas arba nebegaliojanti patvirtinimo nuoroda',
    ],
];
