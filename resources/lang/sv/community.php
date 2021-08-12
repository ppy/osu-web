<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Jag är övertygad! :D',
            'support' => 'stödja osu!',
            'gift' => 'eller ge supporter till en annan spelare i present',
            'instructions' => 'klicka på hjärtat för att gå till osu!store',
        ],
        'why-support' => [
            'title' => 'Varför ska jag stödja osu!? Vart går pengarna?',

            'team' => [
                'title' => 'Stödja teamet',
                'description' => 'Ett litet team utvecklar och driver osu!. Ditt stöd hjälper dem att, du vet... leva.',
            ],
            'infra' => [
                'title' => 'Server-infrastruktur',
                'description' => 'Bidrag går till servrarna för att hålla igång webbplatsen, flerspelartjänster, onlinetopplistor, o.s.v.',
            ],
            'featured-artists' => [
                'title' => 'Utvalda artister',
                'description' => 'Med ditt stöd kan vi få tag i ännu fler grymma artister och licensiera mer bra musik för användning i osu!',
                'link_text' => 'Visa den aktuella deltagarlistan &raquo;',
            ],
            'ads' => [
                'title' => 'Behåll osu! självförsörjande',
                'description' => 'Dina bidrag hjälper till att hålla spelet oberoende och helt fritt från reklam och externa sponsorer.',
            ],
            'tournaments' => [
                'title' => 'Officiella turneringar',
                'description' => 'Hjälp till att finansiera driften av (och priserna för) de officiella osu! VM-turneringarna.',
                'link_text' => 'Utforska turneringar &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Program för öppen källkod',
                'description' => 'Stöd de bidragsgivare som har gett sin tid och ansträngning för att hjälpa till att göra osu! bättre.',
                'link_text' => 'Läs mer &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Coolt! Vilka förmåner får jag?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Få tillgång till att snabbt och enkelt söka efter och ladda ner beatmaps utan att lämna spelet.',
            ],

            'friend_ranking' => [
                'title' => 'Rankning bland vänner',
                'description' => "Se hur du står dig mot dina vänner på en beatmaps topplistor, både i spelet och på hemsidan.",
            ],

            'country_ranking' => [
                'title' => 'Nationell rankning',
                'description' => 'Erövra ditt land innan du erövrar världen.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrera efter mods',
                'description' => 'Associera bara med människor som spelar HDHR? Inga problem!',
            ],

            'auto_downloads' => [
                'title' => 'Automatiska nedladdningar',
                'description' => 'Beatmaps kommer automatiskt laddas ner i flerspelarläge, när du åskådar andra, eller när du klickar på relevanta länkar i chatten!',
            ],

            'upload_more' => [
                'title' => 'Ladda upp mer',
                'description' => 'Fler antal väntande beatmap-platser (per rankad beatmap) upp till 10 stycken.',
            ],

            'early_access' => [
                'title' => 'Tidig tillgång',
                'description' => 'Få tidig tillgång till nya utgåvor med nya funktioner innan de blir offentliga!<br/><br/>Detta inkluderar tidig tillgång till nya funktioner på webbplatsen också!',
            ],

            'customisation' => [
                'title' => 'Anpassning',
                'description' => "Stå ut i mängden genom att ladda upp en egen omslagsbild eller genom att skapa en helt anpassningsbar \"jag!\"-sektion i din användarprofil.",
            ],

            'beatmap_filters' => [
                'title' => 'Beatmapfilter',
                'description' => 'Filtrera beatmapsökningar efter spelade och ospelade beatmaps, eller efter uppnådd rank.',
            ],

            'yellow_fellow' => [
                'title' => 'Gul lirare',
                'description' => 'Bli igenkänd i spelet med din nya neongula namnfärg i chatten.',
            ],

            'speedy_downloads' => [
                'title' => 'Snabbare nedladdningar',
                'description' => 'Mindre nedladdningsrestriktioner, speciellt när du använder osu!direct.',
            ],

            'change_username' => [
                'title' => 'Ändra användarnamn',
                'description' => 'En gratis namnändring ingår i ditt första köp av supporter.',
            ],

            'skinnables' => [
                'title' => 'Skinnables',
                'description' => 'Extra skinnables i spelet, som till exempel huvudmenybakgrund.',
            ],

            'feature_votes' => [
                'title' => 'Funktionsröster',
                'description' => 'Röster på funktionsförfrågningar. (2 per månad)',
            ],

            'sort_options' => [
                'title' => 'Sorteringsalternativ',
                'description' => 'Möjligheten att visa nationell-, vän-, och modspecifika rankningar i spelet.',
            ],

            'more_favourites' => [
                'title' => 'Fler favoriter',
                'description' => 'Det maximala antalet beatmaps du kan favoritmarkera ökar från :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Flera vänner',
                'description' => 'Det maximala antalet vänner du kan ha ökar från :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Ladda upp fler Beatmaps',
                'description' => 'Hur många orankade beatmaps kan du ha på en gång beräknas från ett basvärde plus en extra bonus för varje rankad beatmap du för närvarande har (upp till en gräns). <br/><br/>Vanligtvist är detta :base plus :bonus per rankad beatmap (upp till :bonus_max). Med supporter ökar detta till :supporter_base plus :supporter_bonus per rankad beatmap (upp till :supporter_bonus_max).',
            ],
            'friend_filtering' => [
                'title' => 'Vän topplistor',
                'description' => 'Tävla med dina vänner och se hur du rankar upp mot dem!',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Tack för ditt stöd! Än så länge har du bidragit med :dollars spritt över :tags tag-köp!',
            'gifted' => ":giftedTags av dina tag-köp har getts bort som gåvor (till värdet av :giftedDollars), så generöst!",
            'not_yet' => "Du har inte en supporter-tag än :(",
            'valid_until' => 'Din nuvarande supporter-tag är giltig tills :date!',
            'was_valid_until' => 'Din supporter-tag var giltig till :date.',
        ],
    ],
];
