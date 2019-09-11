<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'support' => [
        'convinced' => [
            'title' => 'Zachęciłeś mnie! :D',
            'support' => 'wspomóż osu!',
            'gift' => 'albo podaruj status donatora innemu graczowi',
            'instructions' => 'kliknij ikonę serca, aby przejść do sklepu osu!',
        ],
        'why-support' => [
            'title' => 'Dlaczego mam wspomóc osu!? Na co przeznaczacie pieniądze?',

            'team' => [
                'title' => 'Wynagrodzenie dla zespołu',
                'description' => 'osu! jest prowadzone i rozwijane przez mały zespół. Twoje wsparcie pomoże im... przeżyć.',
            ],
            'infra' => [
                'title' => 'Infrastruktura serwerowa',
                'description' => 'Część wsparcia jest przeznaczona na serwery odpowiadające za działanie strony, tryb wieloosobowy, tabele wyników itd.',
            ],
            'featured-artists' => [
                'title' => 'Wyróżnieni artyści',
                'description' => '',
                'link_text' => 'Pokaż aktualną listę artystów &raquo;',
            ],
            'ads' => [
                'title' => 'Samowystarczalność osu!',
                'description' => '',
            ],
            'tournaments' => [
                'title' => 'Oficjalne turnieje',
                'description' => '',
                'link_text' => 'Przeglądaj turnieje &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Program nagradzania woluntariuszy',
                'description' => '',
                'link_text' => 'Dowiedz się więcej &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Tak? Co dostaję?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Szybki i łatwy dostęp do beatmap bez potrzeby opuszczania gry.',
            ],

            'friend_ranking' => [
                'title' => 'Ranking znajomych',
                'description' => "",
            ],

            'country_ranking' => [
                'title' => 'Ranking krajowy',
                'description' => 'Podbij swój kraj, zanim podbijesz cały świat.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrowanie wg. modyfikatorów',
                'description' => '',
            ],

            'auto_downloads' => [
                'title' => 'Automatyczne pobieranie',
                'description' => 'Automatyczne pobieranie podczas grania w trybie wieloosobowym, oglądania kogoś czy klikania linków w czacie!',
            ],

            'upload_more' => [
                'title' => 'Dodawaj więcej',
                'description' => 'Więcej slotów na nowe beatmapy (za każdą rankingową beatmapę) ograniczone do 10.',
            ],

            'early_access' => [
                'title' => 'Wczesny dostęp',
                'description' => 'Dostęp do wczesnych wersji, gdzie możesz wypróbować nowe opcje, zanim zostaną one upublicznione (w tym wczesny dostęp do nowych funkcji na stronie)!',
            ],

            'customisation' => [
                'title' => 'Personalizacja',
                'description' => "Spersonalizuj swój profil poprzez w pełni modyfikowalną stronę i własne tło profilu.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtry beatmap',
                'description' => 'Filtruj wyszukiwania beatmap przez osiągnięty wynik.',
            ],

            'yellow_fellow' => [
                'title' => 'Złoty nick',
                'description' => 'Bądź rozpoznawalny w grze dzięki swojemu złotemu nickowi.',
            ],

            'speedy_downloads' => [
                'title' => 'Szybkie pobieranie',
                'description' => 'Mniejsze ograniczenia prędkości pobierania, szczególnie podczas używania osu!direct.',
            ],

            'change_username' => [
                'title' => 'Zmiana nicku',
                'description' => 'Możliwość zmiany nicku bez dodatkowych kosztów (jednorazowo).',
            ],

            'skinnables' => [
                'title' => 'Dodatkowe elementy skórek',
                'description' => 'Dodatkowe elementy skórek, takie jak tło w głównym menu.',
            ],

            'feature_votes' => [
                'title' => 'Oceny funkcji',
                'description' => 'Głosuj na prośby o nowe funkcje! (2 za każdy wykupiony miesiąc)',
            ],

            'sort_options' => [
                'title' => 'Sortowanie',
                'description' => 'Możliwość przeglądania rankingu krajowego, znajomych oraz dla wybranych przez ciebie modów w grze.',
            ],

            'more_favourites' => [
                'title' => 'Zwiększony limit ulubionych beatmap',
                'description' => 'Maksymalna liczba beatmap, które możesz dodać do ulubionych, zostaje zwiększona z :normally do :supporter',
            ],
            'more_friends' => [
                'title' => 'Zwiększony limit znajomych',
                'description' => 'Maksymalna liczba znajomych zostaje zwiększona z :normally do :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Zwiększony limit przesyłanych beatmap',
                'description' => '',
            ],
            'friend_filtering' => [
                'title' => 'Tabele wyników znajomych',
                'description' => '',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Dziękujemy za twoje dotychczasowe wsparcie! Otrzymaliśmy od ciebie łącznie :dollars pochodzących z :tags zakupionych statusów donatora!',
            'gifted' => "Ze wszystkich zakupionych statusów donatora, :giftedTags podarowano innym użytkownikom (za łączną wartość :giftedDollars). Wspaniała szczodrość!",
            'not_yet' => "Nie masz jeszcze statusu donatora osu! :(",
            'valid_until' => 'Twój status donatora przestanie być aktywny :date!',
            'was_valid_until' => 'Twój status donatora przestał być aktywny :date.',
        ],
    ],
];
