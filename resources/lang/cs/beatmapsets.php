<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Tato beatmapa není momentálně dostupná ke stažení.',
        'parts-removed' => 'Část této beatmapy byla smazána na žádost tvůrce nebo vlastníka třetí strany.',
        'more-info' => 'Pro více informací klikněte zde.',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'featured_artist_badge' => [
        'label' => 'Featured artist',
    ],

    'index' => [
        'title' => 'Seznam Beatmap',
        'guest_title' => 'Beatmapy',
    ],

    'panel' => [
        'empty' => 'žádné beatmapy',

        'download' => [
            'all' => 'stáhnout',
            'video' => 'stáhnout s videem',
            'no_video' => 'stáhnout bez videa',
            'direct' => 'otevřít v osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => '',
        'full_bn_required' => '',
        'too_many' => '',

        'dialog' => [
            'confirmation' => '',
            'header' => 'Nominovat beatmapu',
            'hybrid_warning' => '',
            'which_modes' => '',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicitní',
    ],

    'show' => [
        'discussion' => 'Diskuze',

        'details' => [
            'by_artist' => 'od :artist',
            'favourite' => 'Přidat do mých oblíbených',
            'favourite_login' => '',
            'logged-out' => 'Pro stahování beatmap musíš být přihlášen!',
            'mapped_by' => 'beatmapu vytvořil :mapper',
            'unfavourite' => 'Odebrat z mých oblíbených',
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

        'details_date' => [
            'approved' => 'schváleno :timeago',
            'loved' => '',
            'qualified' => 'kvalifikováno :timeago',
            'ranked' => '',
            'submitted' => 'odesláno :timeago',
            'updated' => 'naposledy aktualizováno :timeago',
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

            'disqualify' => [
                '_' => 'Pokud najdete problém s touto mapou, diskvalifikujte ji prosím :link.',
            ],

            'report' => [
                '_' => 'Pokud najdete problém s touto mapou, nahlaste jej :link k upozornění týmu.',
                'button' => 'Nahlásit problém',
                'link' => 'zde',
            ],
        ],

        'info' => [
            'description' => 'Popis',
            'genre' => 'Žánr',
            'language' => 'Jazyk',
            'no_scores' => 'Data se vypočítávají...',
            'nsfw' => 'Explicitní obsah',
            'points-of-failure' => 'Body neúspěchů',
            'source' => 'Zdroj',
            'storyboard' => '',
            'success-rate' => 'Úspěšnost',
            'tags' => 'Tagy',
            'video' => '',
        ],

        'nsfw_warning' => [
            'details' => 'Tato beatmapa obsahuje explicitní, urážlivý nebo rušivý obsah. Chcete ji přesto zobrazit?',
            'title' => 'Explicitní obsah',

            'buttons' => [
                'disable' => 'Vypnout varování',
                'listing' => 'Seznam beatmap',
                'show' => 'Zobrazit',
            ],
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
                'pin' => '',
                'player' => 'Hráč',
                'pp' => '',
                'rank' => 'Umístění',
                'score' => 'Skóre',
                'score_total' => 'Celkové skóre',
                'time' => 'Čas',
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
            'supporter_link' => [
                '_' => '',
                'here' => '',
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

        'status' => [
            'ranked' => 'Hodnocené',
            'approved' => 'Schválené',
            'loved' => 'Oblíbené',
            'qualified' => 'Kvalifikované',
            'wip' => 'Nedodělané',
            'pending' => 'Nevyřízené',
            'graveyard' => 'Hřbitov',
        ],
    ],
];
