<?php
/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'small' => 'Konkurencja na więcej sposobów niż tylko klikanie kółek.',
        'large' => 'Konkursy Społecznościowe w osu!',
    ],
    'voting' => [
        'over' => 'Głosowanie w tym konkursie się zakończyło',
        'login_required' => 'Zaloguj się, żeby zagłosować.',
        'best_of' => [
            'none_played' => 'Wygląda na to, że nie grałeś żadnej z map kwalifikujących się do tego konkursu!',
        ],
    ],
    'entry' => [
        '_' => 'zgłoszenie',
        'login_required' => 'Musisz się zalogować, żeby zgłosić się do konkursu.',
        'silenced_or_restricted' => 'Nie możesz brać udziału w konkursach, jeśli jesteś uciszony, bądź jesteś zbanowany.',
        'preparation' => 'Aktualnie pracujemy nad tym konkursem. Czekaj cierpliwie!',
        'over' => 'Dziękujemy za zgłoszenia! Zgłoszenia zostały zamknięte, a wkrótce zacznie się głosowanie.',
        'limit_reached' => 'Przekroczyłeś limit zgłoszeń do tego konkursu',
        'drop_here' => 'Upuść swoje zgłoszenie tutaj',
        'wrong_type' => [
            'art' => 'Tylko pliki o rozszerzeniach .jpg i .png są dozwolone w tym konkursie.',
            'beatmap' => 'Tylko pliki .osu zą dozwolone w tym konkursie.',
            'music' => 'Tylko pliki .mp3 są dozwolone w tym konkursie.',
        ],
        'too_big' => 'Maksymalna ilość zgłoszeń to :limit.',
    ],
    'beatmaps' => [
        'download' => 'Pobierz próbkę',
    ],
    'vote' => [
        'list' => 'głosy',
        'count' => '1 głos|:count głosy',
    ],
    'dates' => [
        'ended' => 'Zakończony :date',
        'starts' => [
            '_' => 'Zaczyna się :date',
            'soon' => 'niedługo™',
        ],
    ],
    'states' => [
        'entry' => 'Otwarty na zgłoszenia',
        'voting' => 'Głosowanie Rozpoczęte',
        'results' => 'Wyniki',
    ],
];
