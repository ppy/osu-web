<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Šīs ritma-kartes lejupielāde šobrīd nav iespējama.',
        'parts-removed' => 'Daļas no šīs ritma-mapes ir noņemtas pēc autora vai trešās puses tiesību īpašnieka pieprasījuma.',
        'more-info' => 'Lai iegūtu papildu informāciju, noklikšķiniet šeit.',
        'rule_violation' => 'Daži šajā ritma-kartē ietvertie resursi ir izņemti pēc tam, kad tie tika novērtēti kā nepiemēroti izmantošanai osu!.',
    ],

    'cover' => [
        'deleted' => 'Izdzēsta ritma-karte',
    ],

    'download' => [
        'limit_exceeded' => 'Piebremzējiet, spēlējiet vairāk.',
        'no_mirrors' => 'Nav pieejami lejupielādes serveri.',
    ],

    'featured_artist_badge' => [
        'label' => 'Attēlotais mākslinieks',
    ],

    'index' => [
        'title' => 'Ritma-mapju saraksts',
        'guest_title' => 'Ritma-mapes',
    ],

    'panel' => [
        'empty' => 'nav ritma-mapju',

        'download' => [
            'all' => 'lejupielādēt',
            'video' => 'lejupielādēt ar video',
            'no_video' => 'lejupielādēt bez video',
            'direct' => 'atvērt ar osu!direct',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => 'Prakses nominātori nevar nominēt vairākus pamatlikumus.',
        'full_nomination_required' => 'Tev vajag būt pilnam nominātoram lai izpildītu pēdēju pamatlikuma nomināciju.',
        'hybrid_requires_modes' => 'Hibrīda ritma-mapē ir jāizvēlas vismaz viens spēles režīms, kuram veikt nomināciju.',
        'incorrect_mode' => 'Jums nav atļaujas nominēt modam: :mode',
        'invalid_limited_nomination' => 'Šai ritma-mapei ir nepareizi nominātori, un tā šādā stāvoklī nevar tikt kvalificēta.',
        'invalid_ruleset' => 'Nominātoram ir nepareizi pamatlikumi.',
        'too_many' => 'Nominācijas prasība jau ir izpildīta.',
        'too_many_non_main_ruleset' => 'Nominātoru pieprasījums par ne galvenu pamatlikumu ir jau piepildīts.',

        'dialog' => [
            'confirmation' => 'Vai esat pārliecināts, ka vēlaties nominēt šo ritma-mapi?',
            'different_nominator_warning' => 'Kvalificējot šo ritma-mapi ar dažādiem nominātoriem, aizvedīs to uz kvalifikācijas rindas beigām.',
            'header' => 'Nominēt Ritma-karti',
            'hybrid_warning' => 'piezīme: jūs varat nominēt tikai vienu reizi, tāpēc, lūdzu, pārliecinieties, ka nominējat visus plānotos spēles režīmus',
            'current_main_ruleset' => 'Galvenais pamatlikums pašlaik ir: :ruleset',
            'which_modes' => 'Kādiem modiem nominēt?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Nepiemērota satura',
    ],

    'show' => [
        'discussion' => 'Diskusija',

        'admin' => [
            'full_size_cover' => 'Skatīt pilna izmēra bildes pārvalku',
            'page' => '',
        ],

        'deleted_banner' => [
            'title' => 'Šī ritma-mape ir izdzēsta.',
            'message' => '(šo var redzēt tikai moderatori)',
        ],

        'details' => [
            'by_artist' => ':artist',
            'favourite' => 'iemīļot šo ritma-karti',
            'favourite_login' => 'pierakstieties, lai iemīļotu šo ritma-karti',
            'logged-out' => 'tev vajag pierakstīties pirms lejupielādēt jebkuru ritma-karti!',
            'mapped_by' => 'kartēja :mapper',
            'mapped_by_guest' => 'viesa grūtības līmenis: :mapper',
            'unfavourite' => 'noņemt iemīļojumu šajai ritma-kartei',
            'updated_timeago' => 'pēdējo reizi atjaunots :timeago',

            'download' => [
                '_' => 'Lejupielādēt',
                'direct' => '',
                'no-video' => 'bez Video',
                'video' => 'ar Video',
            ],

            'login_required' => [
                'bottom' => 'lai piekļūtu vairāk funkcijām',
                'top' => 'Pierakstīties',
            ],
        ],

        'details_date' => [
            'approved' => 'apstiprināja :timeago',
            'loved' => 'iemīļoja :timeago',
            'qualified' => 'kvalificēja :timeago',
            'ranked' => 'novērtēta :timeago',
            'submitted' => 'iesniegta :timeago',
            'updated' => 'pēdējais atjauninājums :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Jums ir pārāk daudz iemīļotu ritma-mapju! Pirms mēģināt vēlreiz, noņem dažas mapes no favorītiem.',
        ],

        'hype' => [
            'action' => 'Atbalstiet šo mapi, ja jums patika to spēlēt, palīdziet tai sasniegt <strong>Ierindota</strong> statusu.',

            'current' => [
                '_' => 'Pašlaik šī mape ir :status.',

                'status' => [
                    'pending' => 'procesā',
                    'qualified' => 'kvalificēta',
                    'wip' => 'izstrādes stadijā',
                ],
            ],

            'disqualify' => [
                '_' => 'Ja atrodat problēmu ar šo ritma-karti, lūdzu, diskvalificējiet to :link.',
            ],

            'report' => [
                '_' => 'Ja atrodat problēmu ar šo ritma-karti, lūdzu, ziņojiet par to :link, lai brīdinātu komandu.',
                'button' => 'Ziņot par problēmu',
                'link' => 'šeit',
            ],
        ],

        'info' => [
            'description' => 'Apraksts',
            'genre' => 'Žanrs',
            'language' => 'Valoda',
            'mapper_tags' => 'Kartētāju Piekariņš',
            'no_scores' => 'Rezultāti joprojām tiek aprēķināti...',
            'nominators' => 'Nominētāji',
            'nsfw' => 'Nepiemērots saturs',
            'offset' => 'Tiešsaistes nobīde',
            'points-of-failure' => 'Izkrišanas punkti',
            'source' => 'Avots',
            'storyboard' => 'Šī ritma-mape satur vizuālo saturu',
            'success-rate' => 'Izdošanās līmenis',
            'user_tags' => 'Lietotāju Piekariņš',
            'video' => 'Šī ritma-mape satur video',
        ],

        'nsfw_warning' => [
            'details' => 'Šajā ritma-mapē ir atklāts, aizskarošs vai  satraucošs saturs. Vai tomēr vēlaties to skatīt?',
            'title' => 'Nepiemērots Saturs',

            'buttons' => [
                'disable' => 'Atspējot brīdinājumu',
                'listing' => 'Ritma-mapju saraksts',
                'show' => 'Rādīt',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'sasniegts :when',
            'country' => 'Valsts rangi',
            'error' => 'Neizdevās ielādēt rangus',
            'friend' => 'Draugu rangi',
            'global' => 'Pasaules rangi',
            'supporter-link' => 'Klikšķiniet <a href=":link">šeit</a>, lai redzētu visas modernās funkcijas, ko saņemat!',
            'supporter-only' => 'Jums nepieciešams būt atbalstītājam, lai redzētu draugu un valsts rangus!',
            'team' => 'Komandas Novietojums',
            'title' => 'Rezultātu apkopojums',

            'headers' => [
                'accuracy' => 'Precizitāte',
                'combo' => 'Max Kombinācija',
                'miss' => 'Netrāpījumi',
                'mods' => 'Modifikācijas',
                'pin' => 'Piespraust',
                'player' => 'Spēlētājs',
                'pp' => '',
                'rank' => 'Rangs',
                'score' => 'Rezultāts',
                'score_total' => 'Kopējie Punkti',
                'time' => 'Laiks',
            ],

            'no_scores' => [
                'country' => 'Neviens no jūsu valsts vēl nav uzstādījis rezultātu šajā mapē!',
                'friend' => 'Neviens no jūsu draugiem vēl nav uzstādījis rezultātu šajā mapē!',
                'global' => 'Pagaidām nav rezultātu. Varbūt pamēģināt kādu uzstādīt?',
                'loading' => 'Ielādē rezultātus...',
                'team' => 'Neviens no tavas komandas pagaidām nav uzstādījis rezultātu uz šīs ritma-kartes!',
                'unranked' => 'Nevērtējama ritma-mape.',
            ],
            'score' => [
                'first' => 'Vadībā',
                'own' => 'Jūsu Labākais',
            ],
            'supporter_link' => [
                '_' => 'Klikšķiniet :here, lai redzētu visas modernās funkcijas, ko saņemat!',
                'here' => 'šeit',
            ],
        ],

        'stats' => [
            'cs' => 'Apļu Lielums',
            'cs-mania' => 'Taustiņu Skaits',
            'drain' => 'HP Izsīkšana',
            'accuracy' => 'Precizitāte',
            'ar' => 'Pietuvināšanās Ātrums',
            'stars' => 'Grūtība Zvaigznēs',
            'total_length' => 'Garums (Izsīkšanas garums: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Apļu Skaits',
            'count_sliders' => 'Slīdņu Skaits',
            'offset' => 'Tiešsaistes nobīde: :offset',
            'user-rating' => 'Lietotāju Vērtējums',
            'rating-spread' => 'Vērtējumu Diapazons',
            'nominations' => 'Nominācijas',
            'playcount' => 'Reizes spēlēts',
        ],

        'status' => [
            'ranked' => 'Ierindota',
            'approved' => 'Apstiprināta',
            'loved' => 'Iemīļota',
            'qualified' => 'Kvalificēta',
            'wip' => 'WIP',
            'pending' => 'Procesā',
            'graveyard' => 'Pamesta',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Uzmanības Centrā',
    ],
];
