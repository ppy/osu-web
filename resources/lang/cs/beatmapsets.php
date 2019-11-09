<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
            'approved' => 'schváleno:',
            'favourite' => 'Přidat do mých oblíbených',
            'logged-out' => 'Pro stahování beatmap musíš být přihlášen!',
            'loved' => 'amorem zasažené:',
            'mapped_by' => 'beatmapu vytvořil :mapper',
            'qualified' => 'kvalifikováno:',
            'ranked' => 'hodnocené od:',
            'submitted' => 'nahráno:',
            'unfavourite' => 'Odebrat z mých oblíbených',
            'updated' => 'naposledy upraveno:',
            'updated_timeago' => 'naposledy aktualizováno :timeago',

            'download' => [
                '_' => 'Stáhnout',
                'direct' => '',
                'no-video' => 'bez Videa',
                'video' => 's Videem',
            ],

            'login_required' => [
                'bottom' => 'pro přístup k dalším funkcím',
                'top' => 'Přihlašte se',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Máte příliš map v oblibených! Než to budete zkoušet znova, nějakou odstraňte.',
        ],

        'hype' => [
            'action' => 'Dejte Hype téhle mapě, pokud jste si užili její hraní a pomocte jí se dostat do <strong>Hodnoceného</strong> stavu.',

            'current' => [
                '_' => 'Tato mapa je právě :status.',

                'status' => [
                    'pending' => 'čekající',
                    'qualified' => 'kvalifikované',
                    'wip' => 'rozpracované',
                ],
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'button_title' => '',
                'link' => '',
            ],
        ],

        'info' => [
            'description' => 'Popis',
            'genre' => 'Žánr',
            'language' => 'Jazyk',
            'no_scores' => 'Data se vypočítávají...',
            'points-of-failure' => 'Body neúspěchů',
            'source' => 'Zdroj',
            'success-rate' => 'Úspěšnost',
            'tags' => 'Tagy',
            'unranked' => 'Nehodnocená beatmapa',
        ],

        'scoreboard' => [
            'achieved' => 'dosaženo :when',
            'country' => 'Státní žebříčky',
            'friend' => 'Žebříček přátel',
            'global' => 'Celosvětové žebříčky',
            'supporter-link' => 'Klikněte <a href=":link">zde</a> pro zobrazení všech výhod, které dostanete!',
            'supporter-only' => 'Pro zobrazení státních a žebříčků přátel potřebujete funkci Supportera!',
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

        'stats' => [
            'cs' => 'Velikost koleček',
            'cs-mania' => 'Počet kláves',
            'drain' => 'Vysávání životů',
            'accuracy' => 'Přesnost',
            'ar' => 'Rychlost zjevování koleček',
            'stars' => 'Počet hvězd',
            'total_length' => 'Délka',
            'bpm' => 'BPM',
            'count_circles' => 'Počet koleček',
            'count_sliders' => 'Počet sliderů',
            'user-rating' => 'Uživatelské hodnocení',
            'rating-spread' => 'Graf hodnocení',
            'nominations' => 'Nominace',
            'playcount' => 'Počet zahrání',
        ],
    ],
];
