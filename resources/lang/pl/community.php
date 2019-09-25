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
            'gift' => 'lub podaruj status donatora innemu graczowi',
            'instructions' => 'kliknij ikonę serca, aby przejść do sklepu osu!',
        ],
        'why-support' => [
            'title' => 'Dlaczego warto wspomóc osu!? Na co są przeznaczane pieniądze?',

            'team' => [
                'title' => 'Wynagrodzenie dla zespołu',
                'description' => 'osu! jest prowadzone i rozwijane przez mały zespół. Twoje wsparcie pomaga im, no wiesz, żyć.',
            ],
            'infra' => [
                'title' => 'Infrastruktura serwerowa',
                'description' => 'Część wsparcia jest przeznaczona na serwery odpowiadające za działanie strony, tryb wieloosobowy, tabele wyników itd.',
            ],
            'featured-artists' => [
                'title' => 'Wyróżnieni artyści',
                'description' => 'Dzięki twojemu wsparciu możemy kontaktować się ze świetnymi artystami, aby osu! zyskało jeszcze więcej niesamowitej licencjonowanej muzyki!',
                'link_text' => 'Pokaż aktualną listę artystów &raquo;',
            ],
            'ads' => [
                'title' => 'Samowystarczalność',
                'description' => 'Twoje wsparcie pozwala utrzymać osu! wolne od reklam i zewnętrznych sponsorów.',
            ],
            'tournaments' => [
                'title' => 'Oficjalne turnieje',
                'description' => 'Pomóż finansować organizację i nagrody dla oficjalnych turniejów osu! World Cup.',
                'link_text' => 'Przeglądaj turnieje &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Program nagradzania ochotników',
                'description' => 'Wspomóż ochotników, którzy poświęcają swój czas, aby uczynić osu! lepszą grą.',
                'link_text' => 'Dowiedz się więcej &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Bajer! Co dostaję?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Szybki i łatwy dostęp do beatmap bez potrzeby opuszczania gry.',
            ],

            'friend_ranking' => [
                'title' => 'Ranking znajomych',
                'description' => "Sprawdź, gdzie plasujesz się w rywalizacji ze znajomymi na liście wyników beatmapy zarówno na stronie, jak i w grze.",
            ],

            'country_ranking' => [
                'title' => 'Ranking krajowy',
                'description' => 'Podbij swój kraj, zanim podbijesz cały świat.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrowanie według modyfikatorów',
                'description' => 'Chcesz widzieć tylko graczy HDHR? Nie ma problemu!',
            ],

            'auto_downloads' => [
                'title' => 'Automatyczne pobieranie',
                'description' => 'Automatyczne pobieranie podczas grania w trybie wieloosobowym, oglądania kogoś czy klikania linków na czacie!',
            ],

            'upload_more' => [
                'title' => 'Dodawaj więcej',
                'description' => 'Więcej slotów na nowe beatmapy (za każdą rankingową beatmapę) ograniczone do 10.',
            ],

            'early_access' => [
                'title' => 'Wczesny dostęp',
                'description' => 'Uzyskaj dostęp do wczesnych wersji nowych funkcji, zanim zostaną one upublicznione (w tym do tych na stronie)!',
            ],

            'customisation' => [
                'title' => 'Personalizacja',
                'description' => "Wyróżnij się z tłumu dzięki niestandardowemu obrazowi tła lub tworząc w pełni dowolną stronę „O mnie” ze swojego profilu użytkownika.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtry beatmap',
                'description' => 'Filtruj wyniki wyszukiwania beatmap według zagranych i niezagranych lub osiągniętego wyniku.',
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
                'description' => 'Jednorazowa darmowa zmiana nazwy użytkownika przy pierwszym zakupie.',
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
                'description' => 'Maksymalna liczba beatmap, które możesz dodać do ulubionych, zostaje zwiększona z :normally do :supporter.',
            ],
            'more_friends' => [
                'title' => 'Zwiększony limit znajomych',
                'description' => 'Maksymalna liczba znajomych zostaje zwiększona z :normally do :supporter.',
            ],
            'more_beatmaps' => [
                'title' => 'Zwiększony limit przesyłanych beatmap',
                'description' => 'Maksymalna liczba posiadanych beatmap nierankingowych jest obliczana na podstawie wartości bazowej, do której dolicza się premię za każdą rankingową beatmapę, jaką masz na koncie (do pewnej granicy).<br/><br/>Zazwyczaj jest to 4 plus 1 (maks. 2) za każdą rankingową beatmapę. Mając status donatora, ta wartość jest zwiększona do 8 plus 1 (maks 12) za każdą rankingową beatmapę.',
            ],
            'friend_filtering' => [
                'title' => 'Rankingi znajomych',
                'description' => 'Rywalizuj ze swoimi znajomymi i zobacz, jak ci idzie!*<br/><br/><small>* funkcja jeszcze niedostępna na nowej stronie</small>',
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
