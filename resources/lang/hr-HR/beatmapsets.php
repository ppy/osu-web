<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Ova beatmapa trenutno nije dostupna za preuzimanje.',
        'parts-removed' => 'Dijelovi ove beatmape su uklonjeni na zahtjev vlasnika ili noslitelja prava treće strane.',
        'more-info' => 'Klikni ovdje za više informacija.',
        'rule_violation' => 'Neka sredstva sadržana u ovoj mapi su uklonjena nakon što su ocijenjena kao neprikladna za korištenje u osu!.',
    ],

    'cover' => [
        'deleted' => 'Izbrisana beatmapa,',
    ],

    'download' => [
        'limit_exceeded' => 'Uspori, igraj više.',
    ],

    'featured_artist_badge' => [
        'label' => 'Istaknut umjetnik',
    ],

    'index' => [
        'title' => 'Popis beatmapa',
        'guest_title' => 'Beatmape',
    ],

    'panel' => [
        'empty' => 'nema beatmapa',

        'download' => [
            'all' => 'preuzmi',
            'video' => 'preuzmi uz video',
            'no_video' => 'preuzmi bez videa',
            'direct' => 'otvori u osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Hibridne beatmape zahtijevaju da odabereš barem jedan način igranja za nominaciju.',
        'incorrect_mode' => 'Nemaš dopuštenje da nominiraš za mod: :mode',
        'full_bn_required' => 'Moraš biti puni nominator da izvršiš ovu kvalifikacijsku nominaciju.',
        'too_many' => 'Uvjet za nominaciju je već ispunjen.',

        'dialog' => [
            'confirmation' => 'Jesi li siguran/na da želiš nominirati ovu beatmapu?',
            'header' => 'Nominiraj beatmapu',
            'hybrid_warning' => 'napomena: možetš nominirati samo jednom, stoga te molimo da budeš siguran/na da nominiraš za sve načine igre koje namjeravaš',
            'which_modes' => 'Nominiraj za koje modove?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Eksplicitno',
    ],

    'show' => [
        'discussion' => 'Rasprava',

        'details' => [
            'by_artist' => 'od :artist',
            'favourite' => 'Označi beatmapu kao omiljenu',
            'favourite_login' => 'Prijavi se kako bi označio/la ovu beatmapu kao omiljenu',
            'logged-out' => 'Moraš se prijaviti prije preuzimanja beatmapa!',
            'mapped_by' => 'mapirano od :mapper',
            'unfavourite' => 'Ukloni beatmapu sa oznake omiljeno',
            'updated_timeago' => 'zadnje ažurirano :timeago',

            'download' => [
                '_' => 'Preuzmi',
                'direct' => '',
                'no-video' => 'bez videa',
                'video' => 'sa videom',
            ],

            'login_required' => [
                'bottom' => 'za pristup više značajki',
                'top' => 'Prijavi se',
            ],
        ],

        'details_date' => [
            'approved' => 'odobreno :timeago',
            'loved' => 'voljeno :timeago',
            'qualified' => 'kvalificirano :timeago',
            'ranked' => 'rangirano :timeago',
            'submitted' => 'podnešeno :timeago',
            'updated' => 'zadnje ažurirano :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Imaš previše omiljenih beatmapa! Molimo ukloni neke od njih prije ponovnog pokušaja.',
        ],

        'hype' => [
            'action' => 'Hypeaj ovu beatmapu ako is uživao/la igrajući je i da joj pomogneš da postane <strong>Rangirana</strong>.',

            'current' => [
                '_' => 'Ova mapa je trenutno :status.',

                'status' => [
                    'pending' => 'na čekanju',
                    'qualified' => 'kvalificiran/a',
                    'wip' => 'rad u tijeku',
                ],
            ],

            'disqualify' => [
                '_' => 'Ako pronađeš problem s ovom beatmapom, diskvalificiraj je :link.',
            ],

            'report' => [
                '_' => 'Ako pronađeš problem s ovom beatmapom, prijavi ga :link kako bi upozorio/la tim.',
                'button' => 'Prijavi problem',
                'link' => 'ovdje',
            ],
        ],

        'info' => [
            'description' => 'Opis',
            'genre' => 'Žanr',
            'language' => 'Jezik',
            'no_scores' => 'Podaci se još kalkuliraju...',
            'nominators' => '',
            'nsfw' => 'Eksplicitni sadržaj',
            'offset' => 'Online razmak',
            'points-of-failure' => 'Točke neuspjeha',
            'source' => 'Izvor',
            'storyboard' => 'Ova beatmapa sadrži storyboard',
            'success-rate' => 'Stopa uspjeha',
            'tags' => 'Oznake',
            'video' => 'Ova beatmapa sadrži video',
        ],

        'nsfw_warning' => [
            'details' => 'Ova beatmapa sadrži eksplicitan, uvredljiv ili uznemirujući sadržaj. Želiš li ga ipak pogledati?',
            'title' => 'Eksplicitni sadržaj',

            'buttons' => [
                'disable' => 'Onemogući upozorenje',
                'listing' => 'Popis beatmapa',
                'show' => 'Prikaži',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'arhivirano :when',
            'country' => 'Rang u državi',
            'error' => 'Neuspješno učitavanje poretka',
            'friend' => 'Rang prijatelja',
            'global' => 'Globalni rang',
            'supporter-link' => 'Klikni <a href=":link">ovdje</a> da vidiš sve otmjene značajke koje dobivaš!',
            'supporter-only' => 'Moraš biti osu!supporter da bi pristupio/la ljestvicama specifičnim za prijatelje, državu ili mod!',
            'title' => 'Scoreboard',

            'headers' => [
                'accuracy' => 'Preciznost',
                'combo' => 'Najveći combo',
                'miss' => 'Promašaj',
                'mods' => 'Modovi',
                'pin' => 'Prikvači',
                'player' => 'Igrač',
                'pp' => '',
                'rank' => 'Rang',
                'score' => 'Bodovi',
                'score_total' => 'Ukupni Bodovi',
                'time' => 'Vrijeme',
            ],

            'no_scores' => [
                'country' => 'Nitko iz tvoje zemlje još nije postavio rezultat na ovoj mapi!',
                'friend' => 'Nitko od tvojih prijatelja još nije postavio rezultat na ovoj mapi!',
                'global' => 'Još nema rezultata. Možda bi trebao/la pokušati postaviti jednog?',
                'loading' => 'Učitavanje rezultata...',
                'unranked' => 'Nerangirane beatmape.',
            ],
            'score' => [
                'first' => 'U vodstvu',
                'own' => 'Tvoj rekord',
            ],
            'supporter_link' => [
                '_' => 'Klikni :here da vidiš sve otmjene značajke koje dobivaš!',
                'here' => 'ovdje',
            ],
        ],

        'stats' => [
            'cs' => 'Veličina krugova',
            'cs-mania' => 'Broj tipki',
            'drain' => 'HP trošak',
            'accuracy' => 'Preciznost',
            'ar' => 'Stopa približavanja',
            'stars' => 'Ocjena zvjezdicama',
            'total_length' => 'Duljina (duljina troška: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Broj krugova',
            'count_sliders' => 'Broj slidera',
            'offset' => 'Online razmak :offset',
            'user-rating' => 'Korisnička ocijena',
            'rating-spread' => 'Širenje ocjena',
            'nominations' => 'Nominacije ',
            'playcount' => 'Broj igranja',
        ],

        'status' => [
            'ranked' => 'Rangirano',
            'approved' => 'Odobreno',
            'loved' => 'Voljeno',
            'qualified' => 'Kvalificiran/a',
            'wip' => 'Rad u tijeku',
            'pending' => 'Na čekanju',
            'graveyard' => 'Groblje',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Istaknuto',
    ],
];
