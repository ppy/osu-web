<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'header' => [
            // size in font-size
            'big_description' => 'Kochasz osu!?<br/>                                 Wspomóż rozwój gry! :D',
            'small_description' => '',
            'support_button' => 'Chcę wspomóc osu!',
        ],

        'dev_quote' => 'osu! jest kompletnie darmową grą, ale utrzymanie jej nie jest już darmowe. Oprócz kosztów utrzymania serwerów i wysokiej jakości internetu, czasu spędzonego na zarządzanie systemem i społecznością, ustanawiania nagród za konkursy, odpowiadania na pytania dotyczące pomocy technicznej i ogólnego uszczęsliwiania społeczności, osu! wymaga dość sporej sumy pieniędzy. I nie zapominajmy, że robimy to bez żadnych reklam ani partnerstw z denerwującymi toolbarami!
            <br/><br/>osu! jest w większości utrzymwane przeze mnie, którego możecie znać jako "peppy".
            Musiałem opuścić normalną pracę, aby wyrabiać się czasowo z osu! i czasami zdarza się, że mam problem z utrzymaniem standardów, o które się staram.
            Chciałbym zaoferować osobiste podziękowania dla każdego, który wspomógł osu! do tej pory,
            tak samo jak tych, którzy ciągle wspierają tę wspaniałą grę i społeczność :).',

        'supporter_status' => [
            'contribution' => 'Dziękujemy za twoje dotychczasowe wsparcie! Otrzymaliśmy od ciebie łącznie :dollars pochodzących z :tags zakupionych statusów donatora!',
            'gifted' => 'Ze wszystkich zakupionych statusów donatora, :giftedTags podarowano innym użytkownikom (za łączną wartość :giftedDollars). Wspaniała szczodrość!',
            'not_yet' => "Nie posiadasz jeszcze statusu donatora :(",
            'title' => 'Status donatora',
            'valid_until' => 'Twój status donatora przestanie być aktywny :date!',
            'was_valid_until' => 'Twój status donatora przestał być aktywny :date.',
        ],

        'why_support' => [
            'title' => 'Dlaczego mam wspomóc osu!?',
            'blocks' => [
                'dev' => 'Stworzona i utrzymywana głównie przez jedną osobę z Australii.',
                'time' => 'Zajmuje tyle czasu, że nie można tego już nazwać "hobby".',
                'ads' => 'Brak jakichkolwiek reklam. <br/><br/>
                        W odróżnieniu od 99,95% Internetu, nie zarabiamy na pokazywaniu reklam.',
                'goodies' => 'Dostajesz dodatkowe korzyści!',
            ],
        ],

        'perks' => [
            'title' => 'Tak? Co dostaję?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'szybki i łatwy dostęp do beatmap bez opuszczania gry.',
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
                'description' => 'Dostęp do wczesnych wersji, gdzie możesz wypróbować nowe opcje, zanim zostaną one upublicznione!',
            ],

            'customisation' => [
                'title' => 'Personalizacja',
                'description' => 'Spersonalizuj swój profil poprzez w pełni modyfikowalną stronę.',
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
                'description' => 'Możliwość zmiany nicku bez dodatkowych kosztów (jednorazowo)',
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

            'feel_special' => [
                'title' => 'Uczucie wyjątkowości',
                'description' => 'Wspaniałe uczucie pochodzące z wspomagania osu!',
            ],

            'more_to_come' => [
                'title' => 'Więcej w przyszłości',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Zachęciłeś mnie! :D',
            'support' => 'wspomóż osu!',
            'gift' => 'albo podaruj status donatora innemu graczowi',
            'instructions' => 'kliknij ikonę serca, aby przejść do sklepu osu!',
        ],
    ],
];
