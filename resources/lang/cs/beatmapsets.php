<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Tato beatmapa není momentálně dostupná ke stažení.',
        'parts-removed' => 'Část této beatmapy byla smazána na žádost tvůrce nebo vlastníka třetí strany.',
        'more-info' => 'Pro více informací klikněte zde.',
        'rule_violation' => 'Některé assety obsažené v této mapě byly odstraněny poté, co byly posouzeny jako nevhodné pro použití v osu!.',
    ],

    'cover' => [
        'deleted' => 'Vymazaná beatmapa',
    ],

    'download' => [
        'limit_exceeded' => 'Zpomal, více hraj.',
        'no_mirrors' => 'Nejsou dostupné žádné servery pro stahování.',
    ],

    'featured_artist_badge' => [
        'label' => 'Oficiální umělec',
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
        'bng_limited_too_many_rulesets' => 'Zkušební nominátoři nemohou nominovat více rulesetů.',
        'full_nomination_required' => 'Musíš být plnohodnotný nominátor, abys mohl provést finální nominaci rulesetu.',
        'hybrid_requires_modes' => 'Hybridní beatmapa vyžaduje, abyste vybrali alespoň jeden herní režim, za který ji chcete nominovat.',
        'incorrect_mode' => 'Nemáte oprávnění k nominaci za mód: :mode',
        'invalid_limited_nomination' => 'Tato beatmapa má neplatné nominace a nemůže být v kvalifikovaném stavu.',
        'invalid_ruleset' => 'Tato nominace má neplatné rulesety.',
        'too_many' => 'Požadavek na nominaci je již splněn.',
        'too_many_non_main_ruleset' => 'Požadavek pro nominace u jiných než hlavních rulesetů je již splněn.',

        'dialog' => [
            'confirmation' => 'Jste si jisti, že chcete nominovat tuto beatmapu?',
            'different_nominator_warning' => 'Kvalifikace této beatmapy s jinými nominátory vyresetuje její pozici ve frontě kvalifikací.',
            'header' => 'Nominovat beatmapu',
            'hybrid_warning' => 'poznámka: můžete nominovat pouze jednou, takže se ujistěte, že nominujete za všechny herní režimy, které chcete',
            'current_main_ruleset' => 'Hlavní ruleset je aktuálně: :ruleset',
            'which_modes' => 'Nominovat pro jaké módy?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicitní',
    ],

    'show' => [
        'discussion' => 'Diskuze',

        'admin' => [
            'full_size_cover' => 'Zobrazit plnou velikost úvodního obrázku',
            'page' => 'Zobrazit administrátorskou stránku',
        ],

        'deleted_banner' => [
            'title' => 'Tato beatmapa byla odstraněna.',
            'message' => '(toto můžou vidět jen moderátoři)',
        ],

        'details' => [
            'by_artist' => 'od :artist',
            'favourite' => 'přidat do mých oblíbených',
            'favourite_login' => 'pro přidání beatmapy do oblíbených se přihlas',
            'logged-out' => 'před stahováním beatmap se musíš nejprve přihlásit!',
            'mapped_by' => 'beatmapu vytvořil :mapper',
            'mapped_by_guest' => 'obtížnost hosta od :mapper',
            'unfavourite' => 'odebrat z mých oblíbených',
            'updated_timeago' => 'naposledy aktualizováno :timeago',

            'download' => [
                '_' => 'Stáhnout',
                'direct' => '',
                'no-video' => 'bez Videa',
                'video' => 's Videem',
            ],

            'login_required' => [
                'bottom' => 'pro přístup k dalším funkcím',
                'top' => 'Přihlaste se',
            ],
        ],

        'details_date' => [
            'approved' => 'schváleno :timeago',
            'loved' => 'oblíbeno komunitou :timeago',
            'qualified' => 'kvalifikováno :timeago',
            'ranked' => 'hodnoceno :timeago',
            'submitted' => 'odesláno :timeago',
            'updated' => 'naposledy aktualizováno :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Máte příliš map v oblibených! Než to budete zkoušet znova, nějakou odstraňte.',
        ],

        'hype' => [
            'action' => 'Podpoř tuto mapu, pokud sis užili její hraní, a pomoz jí postoupit do <strong>Hodnoceného</strong> stavu.',

            'current' => [
                '_' => 'Tato mapa je právě :status.',

                'status' => [
                    'pending' => 'čekající',
                    'qualified' => 'kvalifikovaná',
                    'wip' => 'rozdělaná',
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
            'mapper_tags' => 'Označení od autora',
            'no_scores' => 'Data se vypočítávají...',
            'nominators' => 'Nominátoři',
            'nsfw' => 'Explicitní obsah',
            'offset' => 'Online offset',
            'points-of-failure' => 'Body neúspěchů',
            'source' => 'Zdroj',
            'storyboard' => 'Tato beatmapa obsahuje storyboard',
            'success-rate' => 'Úspěšnost',
            'user_tags' => 'Označení od uživatelů',
            'video' => 'Tato beatmapa obsahuje video',
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
            'error' => 'Nepodařilo se načíst žebříčky',
            'friend' => 'Žebříček přátel',
            'global' => 'Celosvětové žebříčky',
            'supporter-link' => 'Klikněte <a href=":link">zde</a> pro zobrazení všech výhod, které dostanete!',
            'supporter-only' => 'Pro zobrazení národních žebříčků a žebříčků přátel potřebujete funkci Supportera!',
            'team' => 'Žebříček týmu',
            'title' => 'Tabulka výsledků',

            'headers' => [
                'accuracy' => 'Přesnost',
                'combo' => 'Maximální Kombo',
                'miss' => 'Minuto',
                'mods' => 'Módy',
                'pin' => 'Připnout',
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
                'team' => 'Nikdo z tvého týmu na této mapě zatím žádné skóre nenahrál!',
                'unranked' => 'Nehodnocená beatmapa.',
            ],
            'score' => [
                'first' => 'V čele',
                'own' => 'Vaše nejlepší',
            ],
            'supporter_link' => [
                '_' => 'Klikni :here pro zobrazení všech výhod, které dostaneš!',
                'here' => 'sem',
            ],
        ],

        'stats' => [
            'cs' => 'Velikost koleček',
            'cs-mania' => 'Počet kláves',
            'drain' => 'Vysávání životů',
            'accuracy' => 'Přesnost',
            'ar' => 'Rychlost zjevování koleček',
            'stars' => 'Počet hvězd',
            'total_length' => 'Délka (Délka vysávání životů: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Počet koleček',
            'count_sliders' => 'Počet sliderů',
            'offset' => 'Online offset: :offset',
            'user-rating' => 'Uživatelské hodnocení',
            'rating-spread' => 'Graf hodnocení',
            'nominations' => 'Nominace',
            'playcount' => 'Počet zahrání',
            'favourites' => 'V oblíbených',
            'no_favourites' => 'Nikdo ještě nepřidal do oblíbených',
        ],

        'status' => [
            'ranked' => 'Hodnocená',
            'approved' => 'Schválená',
            'loved' => 'Oblíbená komunitou',
            'qualified' => 'Kvalifikovaná',
            'wip' => 'Rozdělaná',
            'pending' => 'Čekající',
            'graveyard' => 'Hřbitov',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Zvýraznění',
    ],
];
