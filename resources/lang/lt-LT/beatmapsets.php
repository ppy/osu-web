<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Atsiųsti bitmapą šiuo metu nėra galimybės.',
        'parts-removed' => 'Dalys šio bitmapo buvo pašalintos, kūrėjo ar trečiosios šalies laikančios teises prašymu.',
        'more-info' => 'Žiūrėk čia dėl papildomos informacijos.',
        'rule_violation' => 'Kai kurie elementai buvo pašalinti iš šio bitmapo, įvertinus juos kaip netinkamus naudojimui tarp osu!.',
    ],

    'cover' => [
        'deleted' => 'Ištrintas bitmapas',
    ],

    'download' => [
        'limit_exceeded' => 'Neskubėk, pažaisk daugiau.',
    ],

    'featured_artist_badge' => [
        'label' => 'Rekomenduojami atlikėjai',
    ],

    'index' => [
        'title' => 'Bitmapų sąrašas',
        'guest_title' => 'Bitmapai',
    ],

    'panel' => [
        'empty' => 'nėra bitmapų',

        'download' => [
            'all' => 'atsisiųsti',
            'video' => 'atsisiųsti su vaizdo įrašu',
            'no_video' => 'atsisiųsti be vaizdo įrašo',
            'direct' => 'atidaryti per osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Mišriame bitmape reikia pasirinkti bent vieną rėžimą nominavimui.',
        'incorrect_mode' => 'Jūs neturite leidimo nominuoti šiam rėžimui: :mode',
        'full_bn_required' => 'Turi būti pilnai įgaliotas nominatorius, kad galėtum atlikti kvalifikavimo nominacija.',
        'too_many' => 'Nominavimo reikalavimai jau patenkinti.',

        'dialog' => [
            'confirmation' => 'Ar tikrai norite nominuoti šį bitmapą?',
            'header' => 'Nominuoti Bitmapą',
            'hybrid_warning' => 'pastaba: jūs galite nominuoti tik kartą, tai prašom užtikrinti, kad nominuojate visus rėžimus, kuriuos ketinote',
            'which_modes' => 'Kokiems rėžimams nominuoti?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Eksplicitinis',
    ],

    'show' => [
        'discussion' => 'Diskusija',

        'deleted_banner' => [
            'title' => '',
            'message' => '',
        ],

        'details' => [
            'by_artist' => ':artist',
            'favourite' => 'Pridėti bitmapą į mėgstamus',
            'favourite_login' => 'Prisijunk, kad mėgti šį bitmapą',
            'logged-out' => 'Reikia prisijungti bitmapų atsisiuntimui!',
            'mapped_by' => 'sukūrė :mapper',
            'mapped_by_guest' => 'svečio sunkumas iš :mapper',
            'unfavourite' => 'Pašalinti bitmapą iš mėgstamų',
            'updated_timeago' => 'paskutinį kartą atnaujinta :timeago',

            'download' => [
                '_' => 'Atsisiųsti',
                'direct' => '',
                'no-video' => 'be vaizdo įrašo',
                'video' => 'su vaizdo įrašu',
            ],

            'login_required' => [
                'bottom' => 'kad pasiektum daugiau funkcijų',
                'top' => 'Prisijungti',
            ],
        ],

        'details_date' => [
            'approved' => 'patvirtintas :timeago',
            'loved' => 'mylimas :timeago',
            'qualified' => 'kvalifikuota :timeago',
            'ranked' => 'reitinguota :timeago',
            'submitted' => 'pateikta :timeago',
            'updated' => 'paskutinį kartą atnaujinta :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Per daug mėgstamų bitmapų! Pašalink keletą iš mėgstamų prieš bandydamas vėl.',
        ],

        'hype' => [
            'action' => 'Skatink šį bitmapą, jei patiko jį žaisti, ir padėk jam pasiekti <strong>Reitinguoto</strong> būseną.',

            'current' => [
                '_' => 'Šis bitmapas yra :status.',

                'status' => [
                    'pending' => 'laukiantis',
                    'qualified' => 'kvalifikuotas',
                    'wip' => 'vis dar kuriamas',
                ],
            ],

            'disqualify' => [
                '_' => 'Jei randate problemą šiame bitmape, prašome diskvalifikuoti :link.',
            ],

            'report' => [
                '_' => 'Jei radote problemą su šiuo bitmapu, prašome pranešti :link, kad mūsų komanda sužinotu.',
                'button' => 'Pranešti Problemą',
                'link' => 'čia',
            ],
        ],

        'info' => [
            'description' => 'Aprašymas',
            'genre' => 'Žanras',
            'language' => 'Kalba',
            'no_scores' => 'Duomenys dar apskaičiuojami...',
            'nominators' => 'Nominatoriai',
            'nsfw' => 'Eksplicitinis turinys',
            'offset' => 'Tinklo poslinkis',
            'points-of-failure' => 'Pralaimėjimų Vietos',
            'source' => 'Šaltinis',
            'storyboard' => 'Šis bitmapas turi foninę animaciją',
            'success-rate' => 'Įveikimų Rodiklis',
            'tags' => 'Žymos',
            'video' => 'Šis bitmapas turi vaizdo įrašą',
        ],

        'nsfw_warning' => [
            'details' => 'Šiame bitmape yra eksplicitinio, įžeidžiančio ar nerimą keliančio turinio. Vis tiek rodyti?',
            'title' => 'Eksplicitinis Turinys',

            'buttons' => [
                'disable' => 'Išjungti įspėjimą',
                'listing' => 'Bitmapų sąrašas',
                'show' => 'Rodyti',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'pasiekta :when',
            'country' => 'Šalies Rezultatai',
            'error' => 'Nepaviko įkelti rezultatų',
            'friend' => 'Draugų Rezultatai',
            'global' => 'Pasauliniai Rezultatai',
            'supporter-link' => 'Spausk <a href=":link">čia</a>, kad pamatytum visus privalomus, kuriuos gausi!',
            'supporter-only' => 'Tu turi būti osu!rėmėjas, kad pasiektum draugų, šalių ar konkrečių modų rezultatus!',
            'title' => 'Rezultatų lenta',

            'headers' => [
                'accuracy' => 'Tikslumas',
                'combo' => 'Didžiausias Kombo',
                'miss' => 'Nepataikyti',
                'mods' => 'Modai',
                'pin' => 'Prisegti',
                'player' => 'Žaidėjas',
                'pp' => '',
                'rank' => 'Reitingas',
                'score' => 'Taškai',
                'score_total' => 'Visi taškai',
                'time' => 'Laikas',
            ],

            'no_scores' => [
                'country' => 'Niekas iš jūsų šalies dar neįstatė rezultato šiam bitmapui!',
                'friend' => 'Niekas iš jūsų draugų dar nenustatė rezultato šiam bitmapui!',
                'global' => 'Jokiu rezultatų. Galbūt norėtum pabandyti nustatyti koki?',
                'loading' => 'Įkeliami rezultatai...',
                'unranked' => 'Nereitinguotas bitmapas.',
            ],
            'score' => [
                'first' => 'Pirmauja',
                'own' => 'Tavo geriausias',
            ],
            'supporter_link' => [
                '_' => 'Spausk :here, kad pamatytum visus privalomus, kuriuos gausi!',
                'here' => 'čia',
            ],
        ],

        'stats' => [
            'cs' => 'Apskritimų dydis',
            'cs-mania' => 'Klavišų kiekis',
            'drain' => 'HP išsekimas',
            'accuracy' => 'Tikslumas',
            'ar' => 'Artėjimo greitis',
            'stars' => 'Žvaigždžių Įvertinimas',
            'total_length' => 'Trukmė (Senkimo trukmė: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Apskritimų skaičius',
            'count_sliders' => 'Slidukų Skaičius',
            'offset' => 'Tinklo poslinkis: :offset',
            'user-rating' => 'Vartotojų Įvertinimas',
            'rating-spread' => 'Vertinimų Išsidėstymas',
            'nominations' => 'Nominacijos',
            'playcount' => 'Sužaidimų skaičius',
        ],

        'status' => [
            'ranked' => 'Reitinguotas',
            'approved' => 'Patvirtintas',
            'loved' => 'Mylimas',
            'qualified' => 'Kvalifikuotas',
            'wip' => 'WIP',
            'pending' => 'Laukiantis',
            'graveyard' => 'Kapinės',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Pasižymėjęs',
    ],
];
