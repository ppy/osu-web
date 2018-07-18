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
    'availability' => [
        'disabled' => 'Tato beatmapa není momentálně dostupná ke stažení.',
        'parts-removed' => 'Část této beatmapy byla smazána na žádost tvůrce nebo vlastníka třetí strany.',
        'more-info' => 'Pro více informací klikněte zde.',
    ],

    'index' => [
        'title' => 'Seznam Beatmap',
        'guest_title' => 'Beatmapy',
    ],

    'show' => [
        'discussion' => 'Diskuze',

        'details' => [
            'mapped_by' => 'mapu vytvořil :mapper',
            'submitted' => 'nahráno:',
            'updated' => 'naposledy upraveno:',
            'updated_timeago' => 'naposledy aktualizováno :timeago',
            'ranked' => 'hodnocené od:',
            'approved' => 'schváleno:',
            'qualified' => 'kvalifikováno:',
            'loved' => 'amorem zasažené:',
            'logged-out' => 'Pro stahování beatmap musíte být přihlášeni!',
            'download' => [
                '_' => 'Stáhnout',
                'video' => 's Videem',
                'no-video' => 'bez Videa',
                'direct' => '',
            ],
            'favourite' => 'Přidat do oblíbených',
            'unfavourite' => 'Odebrat z oblíbených',
            'favourited_count' => '+ 1 ostatní!|+ :count ostatní!',
        ],
        'stats' => [
            'cs' => 'Velikost koleček',
            'cs-mania' => 'Počet kláves',
            'drain' => 'Vysávání životů',
            'accuracy' => 'Přesnost',
            'ar' => 'Rychlost objevování',
            'stars' => 'Počet hvězd',
            'total_length' => 'Délka',
            'bpm' => 'BPM',
            'count_circles' => 'Počet koleček',
            'count_sliders' => 'Počet sliderů',
            'user-rating' => 'Hodnocení uživatelů',
            'rating-spread' => 'Graf hodnocení',
            'nominations' => 'Nominace',
            'playcount' => 'Počet zahrání',
        ],
        'info' => [
            'description' => 'Popis',
            'genre' => 'Žánr',
            'language' => 'Jazyk',
            'no_scores' => 'Data se vypočítávají...',
            'points-of-failure' => 'Body neúspěchů',
            'source' => 'Zdroj',
            'success-rate' => 'Úspěšnost',
            'tags' => 'Štítky',
            'unranked' => 'Nehodnocená beatmapa',
        ],
        'scoreboard' => [
            'achieved' => 'dosaženo :when',
            'country' => 'Státní Žebříčky',
            'friend' => 'Žebříček Přátel',
            'global' => 'Globální Žebříčky',
            'supporter-link' => 'Klikněte <a href=":link">zde</a> pro zobrazení všech výhod, které dostanete!',
            'supporter-only' => 'Pro zobrazení státních žebříčků a žebříčků přátel potřebujete funkci Supportera!',
            'title' => 'Tabulka výsledků',

            'headers' => [
                'accuracy' => 'Přesnost',
                'combo' => 'Maximální Kombo',
                'miss' => 'Minuto',
                'mods' => 'Módy',
                'player' => 'Hráč',
                'pp' => '',
                'rank' => 'Umístění',
                'score_total' => 'Celkové skóre',
                'score' => 'Skóre',
            ],

            'no_scores' => [
                'country' => 'Nikdo ve vaší zemi na této mapě zatím žádné skóre nenahrál!',
                'friend' => 'Nikdo z vašich přátel na této mapě zatím žádné skóre nenahrál!',
                'global' => 'Zatím žádné skóre. Možná by ses o to měl pokusit!',
                'loading' => 'Načítání skóre...',
                'unranked' => 'Nehodnocená beatmapa.',
            ],
            'score' => [
                'first' => 'V čele',
                'own' => 'Vaše nejlepší',
            ],
        ],
    ],
];
