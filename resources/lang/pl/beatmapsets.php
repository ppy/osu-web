<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Nie możesz pobrać tej beatmapy.',
        'parts-removed' => 'Ta beatmapa została usunięta za prośbą twórcy materiałów w niej użytych.',
        'more-info' => 'Kliknij tutaj, aby dowiedzieć się więcej.',
        'rule_violation' => 'Część zawartości tej beatmapy została usunięta po uznaniu jej za nieodpowiednią do użycia w osu!.',
    ],

    'download' => [
        'limit_exceeded' => 'Zwolnij, pograj więcej!',
    ],

    'featured_artist_badge' => [
        'label' => 'Wyróżniony artysta',
    ],

    'index' => [
        'title' => 'Lista beatmap',
        'guest_title' => 'Beatmapy',
    ],

    'panel' => [
        'empty' => 'brak beatmap',

        'download' => [
            'all' => 'pobierz',
            'video' => 'pobierz z wideo',
            'no_video' => 'pobierz bez wideo',
            'direct' => 'otwórz w osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Beatmapa hybrydowa wymaga wybrania przynajmniej jednego trybu gry, dla którego chcesz ją nominować.',
        'incorrect_mode' => 'Nie posiadasz uprawnień do nominowania beatmap dla tych trybów (:mode)',
        'full_bn_required' => 'Musisz posiadać pełne uprawnienia nominatora, by zakwalifikować tę beatmapę.',
        'too_many' => 'Osiągnięto już wystarczającą liczbę nominacji.',

        'dialog' => [
            'confirmation' => 'Czy na pewno chcesz nominować tę beatmapę?',
            'header' => 'Nominuj beatmapę',
            'hybrid_warning' => 'Uwaga: możesz nominować tylko raz, więc upewnij się, że nominujesz ją dla wszystkich pożądanych trybów gry.',
            'which_modes' => 'Dla jakich trybów chcesz nominować tę beatmapę?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Dla pełnoletnich',
    ],

    'show' => [
        'discussion' => 'Dyskusja',

        'details' => [
            'by_artist' => ':artist',
            'favourite' => 'Dodaj do ulubionych',
            'favourite_login' => 'Zaloguj się, by dodać tę beatmapę do ulubionych',
            'logged-out' => 'Zaloguj się, aby zacząć pobierać beatmapy!',
            'mapped_by' => 'autorstwa :mapper',
            'unfavourite' => 'Usuń z ulubionych',
            'updated_timeago' => 'ostatnio zaktualizowana :timeago',

            'download' => [
                '_' => 'Pobierz',
                'direct' => '',
                'no-video' => 'bez wideo',
                'video' => 'z wideo',
            ],

            'login_required' => [
                'bottom' => 'aby uzyskać dostęp do pozostałych funkcji',
                'top' => 'Zaloguj się',
            ],
        ],

        'details_date' => [
            'approved' => 'zatwierdzona :timeago',
            'loved' => 'ulubiona społeczności :timeago',
            'qualified' => 'zakwalifikowana :timeago',
            'ranked' => 'rankingowa :timeago',
            'submitted' => 'przesłana :timeago',
            'updated' => 'ostatnio zaktualizowana :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Masz za dużo ulubionych beatmap! Usuń kilka, jeżeli chcesz kontynuować.',
        ],

        'hype' => [
            'action' => 'Nagłośnij tę beatmapę, aby pomóc jej w uzyskaniu statusu <strong>rankingowego</strong>.',

            'current' => [
                '_' => 'Ta beatmapa jest obecnie :status.',

                'status' => [
                    'pending' => 'oczekująca',
                    'qualified' => 'zakwalifikowana',
                    'wip' => 'rozwijana',
                ],
            ],

            'disqualify' => [
                '_' => 'Jeżeli znajdziesz problem z tą beatmapą, zdyskwalifikuj ją :link.',
            ],

            'report' => [
                '_' => 'Jeżeli znajdziesz problem z tą beatmapą, zgłoś go :link, aby powiadomić zespół.',
                'button' => 'Zgłoś problem',
                'link' => 'tutaj',
            ],
        ],

        'info' => [
            'description' => 'Opis',
            'genre' => 'Gatunek',
            'language' => 'Język',
            'no_scores' => 'Dane są nadal ładowane...',
            'nsfw' => 'Treść dla pełnoletnich',
            'points-of-failure' => 'Wykres porażek',
            'source' => 'Źródło',
            'storyboard' => 'Ta beatmapa zawiera scenorys',
            'success-rate' => 'Wskaźnik ukończonych zagrań',
            'tags' => 'Tagi',
            'video' => 'Ta beatmapa zawiera wideo w tle',
        ],

        'nsfw_warning' => [
            'details' => 'Ta beatmapa zawiera niedwuznaczne, obraźliwe lub niepokojące treści. Czy chcesz ją zobaczyć mimo to?',
            'title' => 'Treść dla pełnoletnich',

            'buttons' => [
                'disable' => 'Wyłącz ostrzeżenia',
                'listing' => 'Wróć do listy beatmap',
                'show' => 'Pokaż',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'osiągnięte :when',
            'country' => 'Ranking krajowy',
            'error' => '',
            'friend' => 'Ranking znajomych',
            'global' => 'Ranking globalny',
            'supporter-link' => 'Kliknij <a href=":link">tutaj</a>, aby zobaczyć, jakie jeszcze funkcje otrzymasz w zamian za zakup statusu donatora!',
            'supporter-only' => 'Musisz posiadać status donatora, by uzyskać dostęp do rankingu krajowego, znajomych i odrębnych dla modyfikatorów!',
            'title' => 'Tabela wyników',

            'headers' => [
                'accuracy' => 'Celność',
                'combo' => 'Combo',
                'miss' => 'Pudła',
                'mods' => 'Modyfikatory',
                'pin' => 'Przypnij',
                'player' => 'Gracz',
                'pp' => '',
                'rank' => 'Pozycja',
                'score' => 'Wynik',
                'score_total' => 'Wynik',
                'time' => 'Data',
            ],

            'no_scores' => [
                'country' => 'Nikt z twojego kraju nie ustanowił jeszcze wyniku na tej beatmapie!',
                'friend' => 'Żaden z twoich znajomych nie ustanowił jeszcze wyniku na tej beatmapie!',
                'global' => 'Brak wyników. Może czas jakieś ustanowić?',
                'loading' => 'Ładowanie wyników...',
                'unranked' => 'Nierankingowa beatmapa.',
            ],
            'score' => [
                'first' => 'Najlepszy wynik',
                'own' => 'Twój wynik',
            ],
            'supporter_link' => [
                '_' => 'Kliknij :here, aby zobaczyć, jakie jeszcze funkcje otrzymasz w zamian za zakup statusu donatora!',
                'here' => 'tutaj',
            ],
        ],

        'stats' => [
            'cs' => 'Wielkość kółek',
            'cs-mania' => 'Liczba klawiszy',
            'drain' => 'Spadek HP',
            'accuracy' => 'Precyzja',
            'ar' => 'Prędkość otoczki',
            'stars' => 'Trudność',
            'total_length' => 'Długość (długość aktywnej gry: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Liczba kółek',
            'count_sliders' => 'Liczba sliderów',
            'user-rating' => 'Oceny użytkowników',
            'rating-spread' => 'Wykres ocen',
            'nominations' => 'Nominacje',
            'playcount' => 'Liczba zagrań',
        ],

        'status' => [
            'ranked' => 'Rankingowa',
            'approved' => 'Zatwierdzona',
            'loved' => 'Ulubiona społeczności',
            'qualified' => 'Zakwalifikowana',
            'wip' => 'Obecnie rozwijana',
            'pending' => 'Oczekująca',
            'graveyard' => 'Porzucona',
        ],
    ],
];
