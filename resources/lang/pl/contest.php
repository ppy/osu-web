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
    'header' => [
        'small' => 'Rywalizacja na więcej sposobów niż tylko klikanie w kółka.',
        'large' => 'Konkursy społeczności',
    ],
    'voting' => [
        'over' => 'Głosowanie dla tego konkursu zostało zakończone',
        'login_required' => 'Zaloguj się, aby zagłosować!',
        'best_of' => [
            'none_played' => "Wygląda na to, że żadna z beatmap kwalifikujących się do tego konkursu nie została przez ciebie zagrana.",
        ],
    ],
    'entry' => [
        '_' => 'zgłoszenie',
        'login_required' => 'Zaloguj się, aby uczestniczyć w tym konkursie.',
        'silenced_or_restricted' => 'Nie możesz uczestniczyć w konkursach podczas uciszenia bądź blokady konta.',
        'preparation' => 'Ten konkurs jest obecnie przygotowywany. Czekaj cierpliwie!',
        'over' => 'Dziękujemy za zgłoszenia! Przesyłanie prac zakończyło się i wkrótce rozpocznie się głosowanie.',
        'limit_reached' => 'Osiągnięto limit zgłoszeń dla tego konkursu',
        'drop_here' => 'Tutaj umieść swoje zgłoszenie',
        'download' => 'Pobierz plik .osz',
        'wrong_type' => [
            'art' => 'Jedynie pliki o rozszerzeniach .jpg czy .png są dozwolone w tym konkursie.',
            'beatmap' => 'Jedynie pliki o rozszerzeniu .osu są dozwolone w tym konkursie.',
            'music' => 'Jedynie pliki o rozszerzeniu .mp3 są dozwolone w tym konkursie.',
        ],
        'too_big' => 'Maksymalna wielkość zgłoszeń dla tego konkursu to :limit.',
    ],
    'beatmaps' => [
        'download' => 'Pobierz zgłoszenie',
    ],
    'vote' => [
        'list' => 'głosy',
        'count' => ':count głos|:count głosy|:count głosów',
        'points' => ':count punkt|:count punkty|:count punktów',
    ],
    'dates' => [
        'ended' => 'Zakończony :date',

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
];
