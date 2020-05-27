<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Jag är övertygad! :D',
            'support' => 'stödja osu!',
            'gift' => 'eller ge support till en annan spelare i present',
            'instructions' => 'klicka på hjärtat för att gå till osu!store',
        ],
        'why-support' => [
            'title' => 'Varför ska jag stödja osu!? Vart går pengarna?',

            'team' => [
                'title' => 'Stödja teamet',
                'description' => 'Ett litet team utvecklar och driver osu!. Ditt stöd hjälper dem att, du vet... leva.',
            ],
            'infra' => [
                'title' => 'Server infrastruktur',
                'description' => 'Bidrag går till servrarna för att köra webbplatsen, flerspelartjänster, online topplistor, o.s.v.          ',
            ],
            'featured-artists' => [
                'title' => 'Utvalda Artister',
                'description' => 'Med ditt stöd kan vi närma oss ännu mer grymma artister och licensiera mer bra musik för användning i osu!',
                'link_text' => 'Visa den aktuella deltagarlistan &raquo;',
            ],
            'ads' => [
                'title' => 'Behåll osu! självförsörjande',
                'description' => 'Dina bidrag hjälper till att hålla spelet oberoende och helt fri från annonser och externa sponsorer.',
            ],
            'tournaments' => [
                'title' => 'Officiella turneringar',
                'description' => 'Hjälp till att finansiera driften av (och priserna för) den officiella osu! VM-murneringar.',
                'link_text' => 'Utforska turneringar &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Program för öppen källkod',
                'description' => 'Stöd de bidragsgivare som har gett sin tid och ansträngning för att hjälpa till att göra osu! bättre.',
                'link_text' => 'Ta reda på mer &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Coolt! Vilka förmåner får jag?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'snabb och enkel tillgång till att söka beatmaps utan att lämna spelet.',
            ],

            'friend_ranking' => [
                'title' => 'Rankning bland vänner',
                'description' => "Se hur du staplar upp mot dina vänner på en beatmaps topplistor, både i spelet och på hemsidan.",
            ],

            'country_ranking' => [
                'title' => 'Nationell Rankning',
                'description' => 'Erövra ditt land innan du erövrar världen.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrera efter mods',
                'description' => 'Associera bara med människor som spelar HDHR? Inga problem!',
            ],

            'auto_downloads' => [
                'title' => 'Automatiska Nedladdningar',
                'description' => 'Automatiska nedladdningar när du spelar multiplayer, åskådar andra, eller klickar på länkar i chatten!',
            ],

            'upload_more' => [
                'title' => 'Ladda upp mer',
                'description' => 'Fler antal avvaktning beatmap platser (per rankad beatmap) upp till 10 stycken.',
            ],

            'early_access' => [
                'title' => 'Tidig tillgång',
                'description' => 'Tillgång till tidiga utgåvor, där du kan pröva nya funktioner innan dem kommer ut för alla!',
            ],

            'customisation' => [
                'title' => 'Anpassning',
                'description' => "Anpassa din profil genom att lägga till en full anpassningsbar användar sida",
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Filters',
                'description' => 'Filtrera beatmap sökningar på spelade och ej spelade maps och rank uppnåd (om det finns).',
            ],

            'yellow_fellow' => [
                'title' => 'Gul Typ',
                'description' => 'Bli igenkänd i spelet med din nya ljusa gula chat användarnamn färg.',
            ],

            'speedy_downloads' => [
                'title' => 'Snabbare nedladdningar',
                'description' => 'Mindre nedladdnings restriktioner, speciellt när du använder osu!direct.',
            ],

            'change_username' => [
                'title' => 'Ändra användarnamn',
                'description' => 'Möjligheten att ändra ditt användarnamn utan extra konstad. (endast en gång)',
            ],

            'skinnables' => [
                'title' => 'Pynt',
                'description' => 'Extra pynt i spelet, som till exempel huvudmeny bakrund.',
            ],

            'feature_votes' => [
                'title' => 'Funktion Röster',
                'description' => 'Rösta på funktion efterfrågan. (2 gånger per månad)',
            ],

            'sort_options' => [
                'title' => 'Sortering Inställningar',
                'description' => 'Möjligheten att visa beatmap land / vän / mod-specifika rankningar i spelet.',
            ],

            'more_favourites' => [
                'title' => 'Fler favoriter',
                'description' => 'Det maximala antalet beatmaps du kan favorisera ökar från :normally &rarr; :supporter',
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
