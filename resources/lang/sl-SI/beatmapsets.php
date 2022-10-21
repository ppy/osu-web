<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Ta beatmapa trenutno ni na voljo za prenos.',
        'parts-removed' => 'Zaradi prošnje ustvarjalca beatmape ali avtorskih pravic tretje osebe so bile odstranjene porcije te beatmape.',
        'more-info' => 'Preveri tukaj za več informacij.',
        'rule_violation' => 'Nekatera sredstva v tej beatmapi so bila odstranjena po presoditvi, ker niso primerna za uporabo v osu!.',
    ],

    'cover' => [
        'deleted' => 'Odstranjena beatmapa',
    ],

    'download' => [
        'limit_exceeded' => 'Upočasni se, igraj več.',
    ],

    'featured_artist_badge' => [
        'label' => 'Priznani ustvarjalec',
    ],

    'index' => [
        'title' => 'Seznam beatpmap',
        'guest_title' => 'Beatmape',
    ],

    'panel' => [
        'empty' => 'ni beatmap',

        'download' => [
            'all' => 'prenesi',
            'video' => 'prenesi z videoposnetkom',
            'no_video' => 'prenesi brez videoposnetka',
            'direct' => 'odpri v osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Hibridna beatmapa zahteva izbiro vsaj enega igralnega načina za nominacijo.',
        'incorrect_mode' => 'Nimaš dovoljenja za nominacijo igralnega načina: :mode',
        'full_bn_required' => 'Za kvalificirano nominacijo moraš biti polni nominator.',
        'too_many' => 'Pogoj za nominacijo je že izpolnjen.',

        'dialog' => [
            'confirmation' => 'Ali si prepričan za nominacijo te beatmape?',
            'header' => 'Nominiraj beatmapo',
            'hybrid_warning' => 'opomba: nominiraš lahko le enkrat, zato poskrbi, da nominiraš za vse nameravane igralne načine',
            'which_modes' => 'Nominacija katerih igralnih načinov?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Eksplicitno',
    ],

    'show' => [
        'discussion' => 'Razprava',

        'details' => [
            'by_artist' => 'od :artist',
            'favourite' => 'Dodaj beatmapo med priljubljene',
            'favourite_login' => 'Vpiši se za dodajanje beatmape med priljubljene',
            'logged-out' => 'Preden lahko preneseš beatmapo moraš biti vpisan!',
            'mapped_by' => '',
            'unfavourite' => 'Odstrani beatmapo iz priljubljenih',
            'updated_timeago' => 'zadnje posodobljeno :timeago',

            'download' => [
                '_' => 'Prenesi',
                'direct' => '',
                'no-video' => 'brez videoposnetka',
                'video' => 'z videoposnetkom',
            ],

            'login_required' => [
                'bottom' => 'za dostop do več funkcij',
                'top' => 'Vpiši se',
            ],
        ],

        'details_date' => [
            'approved' => 'sprejeto :timeago',
            'loved' => 'loved :timeago',
            'qualified' => 'kvalificirano :timeago',
            'ranked' => 'rankirano :timeago',
            'submitted' => 'objavljeno :timeago',
            'updated' => 'zadnje posodobljeno :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Dosegel si največje število priljubljenih beatmap! Prosimo odstrani nekaj beatmap preden poskusiš znova.',
        ],

        'hype' => [
            'action' => 'Če si užival v igranju te beatmape, hypaj to beatmapo in pomagaj doseči <strong>Rankirano</strong> stanje.',

            'current' => [
                '_' => 'Ta beatmapa je trenutno v stanju :status.',

                'status' => [
                    'pending' => 'v teku',
                    'qualified' => 'kvalificirano',
                    'wip' => 'v poteku izdelave',
                ],
            ],

            'disqualify' => [
                '_' => 'Če najdeš katerokoli težavo s to beatmapo, te prosimo za diskvalifikacijo te beatmape :link.',
            ],

            'report' => [
                '_' => 'Če najdeš katerokoli težavo s to beatmapo, te prosimo za prijavo ekipi :link.',
                'button' => 'Prijavi težavo',
                'link' => 'tukaj',
            ],
        ],

        'info' => [
            'description' => 'Opis',
            'genre' => 'Žanr',
            'language' => 'Jezik',
            'no_scores' => 'Podatki v preračunavanju...',
            'nsfw' => 'Eksplicitna vsebina',
            'offset' => 'Online odmik',
            'points-of-failure' => 'Točke neuspehov',
            'source' => 'Vir',
            'storyboard' => 'Ta beatmapa vsebuje storyboard',
            'success-rate' => 'Stopnja uspešnosti',
            'tags' => 'Oznake',
            'video' => 'Ta beatmapa vsebuje videoposnetek',
        ],

        'nsfw_warning' => [
            'details' => 'Ta beatmapa vsebuje eksplicitno, žaljivo ali neželeno vsebino. Ali si vseeno želiš ogledati beatmapo?',
            'title' => 'Eksplicitna Vsebina',

            'buttons' => [
                'disable' => 'Onemogoči opozorila',
                'listing' => 'Seznam beatmap',
                'show' => 'Prikaži',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'doseženo :when',
            'country' => 'Državna lestvica',
            'error' => 'Neuspešno nalaganje uvrstitev',
            'friend' => 'Lestvica prijateljev',
            'global' => 'Svetovna lestvica',
            'supporter-link' => 'Klikni <a href=":link">tukaj</a>, kakšne funkcije lahko dobiš!',
            'supporter-only' => 'Za dostop do državnih, prijateljskih in mod specifičnih lestvic potrebuješ osu!supporter značko!',
            'title' => 'Točkovnik',

            'headers' => [
                'accuracy' => 'Natančnost',
                'combo' => 'Max Combo',
                'miss' => 'Miss',
                'mods' => 'Modifikatorji',
                'pin' => 'Pripni',
                'player' => 'Igralec',
                'pp' => '',
                'rank' => 'Rank',
                'score' => 'Točke',
                'score_total' => 'Skupaj točk',
                'time' => 'Čas',
            ],

            'no_scores' => [
                'country' => 'Nihče iz tvoje države še ni dosegel rezultata na tej beatmapi!',
                'friend' => 'Nihče od tvojih prijateljev še ni dosegel rezultata na tej beatmapi!',
                'global' => 'Ni še rezultatov. Mogoče lahko ti poskusiš za rezultat?',
                'loading' => 'Nalaganje rezultatov...',
                'unranked' => 'Nerankirana beatmapa.',
            ],
            'score' => [
                'first' => 'V vodstvu',
                'own' => 'Tvoj najboljši',
            ],
            'supporter_link' => [
                '_' => 'Klikni :here, kakšne funkcije lahko dobiš!',
                'here' => 'tukaj',
            ],
        ],

        'stats' => [
            'cs' => 'Velikost Krogov',
            'cs-mania' => 'Število tipk',
            'drain' => 'HP izguba',
            'accuracy' => 'Natančnost',
            'ar' => 'Stopnja približevanja',
            'stars' => 'Število zvezdic',
            'total_length' => 'Dolžina (Dolžina izgube :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Število Krogov',
            'count_sliders' => 'Število Sliderjev',
            'offset' => 'Online zamik: :offset',
            'user-rating' => 'Igralčeva Ocena',
            'rating-spread' => 'Razpon Ocen',
            'nominations' => 'Nominacije',
            'playcount' => 'Število igranj',
        ],

        'status' => [
            'ranked' => 'Rankirano',
            'approved' => 'Odobreno',
            'loved' => 'Loved',
            'qualified' => 'Kvalificirano',
            'wip' => 'WIP',
            'pending' => 'V čakanju',
            'graveyard' => 'Pokopališče',
        ],
    ],

    'spotlight_badge' => [
        'label' => '',
    ],
];
