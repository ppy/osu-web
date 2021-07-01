<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'beállítások',
        'username' => 'felhasználónév',

        'avatar' => [
            'title' => 'Avatár',
            'rules' => 'Kérjük, ellenőrizze, hogy az avatár illeszkedik-e ehhez :link.<br/>Ez azt jelenti, hogy <strong>minden korosztály számára alkalmasnak kell lennie</strong>. Vagyis nincs meztelenség, mások számára elfogadhatatlan vagy szuggesztív tartalom.',
            'rules_link' => 'a közösségi szabályok',
        ],

        'email' => [
            'current' => 'jelenlegi e-mail cím',
            'new' => 'új e-mail cím',
            'new_confirmation' => 'e-mail cím megerősítése',
            'title' => 'E-Mail',
        ],

        'password' => [
            'current' => 'jelenlegi jelszó',
            'new' => 'új jelszó',
            'new_confirmation' => 'jelszó megerősítése',
            'title' => 'Jelszó',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'tartózkodási hely',
                'user_interests' => 'érdeklődés',
                'user_occ' => 'foglalkozás',
                'user_twitter' => '',
                'user_website' => 'weboldal',
            ],
        ],

        'signature' => [
            'title' => 'Aláírás',
            'update' => 'mentés',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'Értesítések kérése minősített beatmapok problémáival kapcsolatban a következő módokból',
        'beatmapset_disqualify' => 'értesíts, ha a következő játékmódok egy beatmapje diszkvalifikálva lett',
        'comment_reply' => 'értesítések küldése a kommentjeidre érkezett válaszokról',
        'title' => 'Értesítések',
        'topic_auto_subscribe' => 'az általad létrehozott új fórum témák értesítéseinek automatikus bekapcsolása',

        'options' => [
            '_' => 'Szállítási lehetőségek',
            'beatmap_owner_change' => 'vendég nehézség',
            'beatmapset:modding' => 'beatmap modolás',
            'channel_message' => 'Privát üzenetek',
            'comment_new' => 'Új megjegyzések',
            'forum_topic_reply' => 'Válaszolj erre a témára',
            'mail' => 'e-mail',
            'mapping' => 'beatmap készítő',
            'push' => 'Elöjövő',
            'user_achievement_unlock' => 'Medál feloldva',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'felhatalmazott kliensek',
        'own_clients' => 'külső alkalmazások',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'beatmapekben lévő felnőtt tartalmakra vonatkozó figyelmeztetések elrejtése',
        'beatmapset_title_show_original' => 'A beatmap metaadatai megjelenítése eredeti nyelven',
        'title' => 'Beállítások',

        'beatmapset_download' => [
            '_' => 'Alapértelmezett beatmap letöltés típusa',
            'all' => 'Videóval, ha elérhető',
            'direct' => 'Megnyitás osu!direct-ben',
            'no_video' => 'Videó nélkül',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'billentyűzet',
        'mouse' => 'egér',
        'tablet' => 'tablet',
        'title' => 'Játékstílusok',
        'touch' => 'érintőképernyő',
    ],

    'privacy' => [
        'friends_only' => 'privát üzenetek tiltása olyan személyektől, akik nincsenek a baráti listádon',
        'hide_online' => 'online állapot elrejtése',
        'title' => 'Adatvédelem',
    ],

    'security' => [
        'current_session' => 'jelenlegi',
        'end_session' => 'Munkamenet befejezése',
        'end_session_confirmation' => 'Ez azonnal befejezi a munkamenetet az eszközön. Biztos vagy benne?',
        'last_active' => 'Utoljára aktív:',
        'title' => 'Biztonság',
        'web_sessions' => 'webes munkamenetek',
    ],

    'update_email' => [
        'update' => 'mentés',
    ],

    'update_password' => [
        'update' => 'mentés',
    ],

    'verification_completed' => [
        'text' => 'Mostmár bezárhatod ezt az oldalt',
        'title' => 'Az ellenőrzés befejeződött',
    ],

    'verification_invalid' => [
        'title' => 'Érvénytelen vagy lejárt ellenőrző link',
    ],
];
