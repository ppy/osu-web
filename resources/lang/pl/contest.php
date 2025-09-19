<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Rywalizacja na więcej sposobów niż tylko klikanie w kółka.',
        'large' => 'Konkursy społeczności',
    ],

    'index' => [
        'nav_title' => 'lista',
    ],

    'judge' => [
        'comments' => 'komentarze',
        'hide_judged' => 'ukryj ocenione prace',
        'nav_title' => 'ocena prac',
        'no_current_vote' => 'brak głosów',
        'update' => 'zaktualizuj',
        'validation' => [
            'missing_score' => 'brak wyniku',
            'contest_vote_judged' => 'nie możesz głosować w konkursach ocenianych przez jury',
        ],
        'voted' => 'Już zagłosowano na tę pracę.',
    ],

    'judge_results' => [
        '_' => 'Wyniki oceny prac',
        'creator' => 'twórca',
        'score' => 'Wynik',
        'score_std' => 'Wynik standaryzowany',
        'total_score' => 'całkowity wynik',
        'total_score_std' => 'całkowity wynik standaryzowany',
    ],

    'voting' => [
        'judge_link' => 'Jesteś członkiem jury tego konkursu. Oceń zgłoszone prace tutaj!',
        'judged_notice' => 'Ten konkurs jest oceniany przez jury - członkowie zespołu są w trakcie przetwarzania zgłoszonych prac.',
        'login_required' => 'Zaloguj się, aby zagłosować.',
        'over' => 'Głosowanie dla tego konkursu zostało zakończone',
        'show_voted_only' => 'Pokaż prace z moimi głosami',

        'best_of' => [
            'none_played' => "Wygląda na to, że żadna z beatmap kwalifikujących się do tego konkursu nie została przez ciebie zagrana.",
        ],

        'button' => [
            'add' => 'Zagłosuj',
            'remove' => 'Cofnij głos',
            'used_up' => 'Nie masz już więcej głosów',
        ],

        'progress' => [
            '_' => 'oddano :used z :max głosów',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Musisz zagrać wszystkie beatmapy w określonych grach asynchronicznych, by zagłosować',
            ],
        ],
    ],

    'entry' => [
        '_' => 'zgłoszenie',
        'login_required' => 'Zaloguj się, aby wziąć udział w konkursie.',
        'silenced_or_restricted' => 'Nie możesz uczestniczyć w konkursach po tym, jak twoje konto zostało ograniczone lub uciszone.',
        'preparation' => 'Ten konkurs jest obecnie przygotowywany. Czekaj cierpliwie!',
        'drop_here' => 'Tutaj umieść swoje zgłoszenie',
        'download' => 'Pobierz plik .osz',

        'wrong_type' => [
            'art' => 'W tym konkursie dozwolone są wyłącznie pliki o rozszerzeniach .jpg i .png.',
            'beatmap' => 'W tym konkursie dozwolone są wyłącznie pliki o rozszerzeniu .osu.',
            'music' => 'W tym konkursie dozwolone są wyłącznie pliki o rozszerzeniu .mp3.',
        ],

        'wrong_dimensions' => 'Zgłoszenia do tego konkursu muszą mieć rozdzielczość :widthx:height',
        'too_big' => 'Maksymalny rozmiar pliku ze zgłoszeniem dla tego konkursu to :limit.',
    ],

    'beatmaps' => [
        'download' => 'Pobierz zgłoszenie',
    ],

    'vote' => [
        'list' => 'głosy',
        'count' => ':count_delimited głos|:count_delimited głosy|:count_delimited głosów',
        'points' => ':count_delimited punkt|:count_delimited punkty|:count_delimited punktów',
        'points_float' => ':points pkt',
    ],

    'dates' => [
        'ended' => 'Zakończony :date',
        'ended_no_date' => 'Zakończony',

        'starts' => [
            '_' => 'Data rozpoczęcia: :date',
            'soon' => 'wkrótce™',
        ],
    ],

    'states' => [
        'entry' => 'Otwarty na zgłoszenia',
        'voting' => 'Głosowanie',
        'results' => 'Wyniki',
    ],

    'show' => [
        'admin' => [
            'page' => 'Pokaż informacje i zgłoszenia',
        ],
    ],
];
