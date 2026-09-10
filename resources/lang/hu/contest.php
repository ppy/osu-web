<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Versenyezz kör kattintgatáson kívüli módokban.',
        'large' => 'Közösségi Versenyek',
    ],

    'index' => [
        'nav_title' => 'lista',
    ],

    'judge' => [
        'comments' => 'hozzászolások',
        'hide_judged' => 'elrejteni az elbírált bejegyzéseket',
        'nav_title' => 'bíró',
        'no_current_vote' => 'még nem szavaztál.',
        'update' => 'frissités',
        'unsaved_changes' => 'nem mentett módosítások',
        'validation' => [
            'missing_score' => 'hiányzó pontszám',
            'contest_vote_judged' => 'bírált versenyeken nem szavazhat',
        ],
        'voted' => 'Már leadtál szavazatot erre a bejegyzésre.',
    ],

    'judge_results' => [
        '_' => 'Eredmények elbírálása',
        'creator' => 'készítő',
        'score' => 'Pontszám',
        'score_std' => 'Szabványosított pontszám',
        'total_score' => 'összpontszám',
        'total_score_std' => 'teljes szabványosított pontszám',
    ],

    'voting' => [
        'judge_link' => 'Ennek a versenynek a zsűrije vagy. Itt bírálhatod el a bejegyzéseket!',
        'judged_notice' => 'Ez a verseny a bírálati rendszerrel zajlik, a zsűrik jelenleg dolgoznak a bejegyzéseken.',
        'login_required' => 'Kérlek jelentkezz be a szavazáshoz.',
        'over' => 'Erre a versenyre már véget ért a szavazás',
        'show_voted_only' => 'Szavazottak mutatása',

        'best_of' => [
            'none_played' => "Úgy tünik, hogy egyetlen beatmapet sem játszottál ami megfelelne ennek a versenynek!",
        ],

        'button' => [
            'add' => 'Szavazás',
            'remove' => 'Szavazat eltávolítása',
            'used_up' => 'Felhasználtad az összes szavazatodat',
        ],

        'progress' => [
            '_' => ':used / :max szavazás használva',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Szavazás előtt, először játszanod kell az összes beatmappel a kiválasztott játéklistákban',
            ],
        ],
    ],

    'entry' => [
        '_' => 'jelentkezés',
        'login_required' => 'Kérlek jelentkezz be a versenyhez való csatlakozáshoz.',
        'silenced_or_restricted' => 'Felfüggesztve illetve némítva nem jelentkezhetsz versenyekre.',
        'preparation' => 'Ez a verseny előkészítés alatt áll. Kérjük várj türelmesen!',
        'drop_here' => 'Húzd a jelentkezésedet ide',
        'allowed_extensions' => 'Elfogadott fájlkiterjesztések: :types',
        'max_size' => 'Maximum méret: :limit',
        'required_dimensions' => 'A méreteknek a következő formátumban kell szerepelniük: :widthx:height',
        'download' => '.osz letöltése',
        'wrong_file_type' => 'Csak :types kiterjesztésű fájlokat engedélyezettek erre a versenyre.',
        'wrong_dimensions' => 'A jelentkezéseknek erre a versenyre :widthx:height méretűnek kellenek lennie',
        'too_big' => 'A jelentkezések száma erre a versenyre csak :limit lehet.',
    ],

    'beatmaps' => [
        'download' => 'Jelentkezés letöltése',
    ],

    'vote' => [
        'list' => 'szavazatok',
        'count' => ':count szavazat|:count szavazatok',
        'points' => ':count pont|:count pontok',
        'points_float' => ':points pontok',
    ],

    'dates' => [
        'ended' => 'Vége: :date',
        'ended_no_date' => 'Befejezve',

        'starts' => [
            '_' => 'Kezdete: :date',
            'soon' => 'hamarosan™',
        ],
    ],

    'states' => [
        'entry' => 'Nyitott Jelentkezés',
        'voting' => 'Szavazás Folyamatban',
        'results' => 'Kihirdetett Eredmény',
    ],

    'show' => [
        'admin' => [
            'page' => 'Információ és bejegyzések megtekintése',
        ],
    ],
];
