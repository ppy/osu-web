<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Šīs bītkartes lejupielāde šobrīd nav iespējama.',
        'parts-removed' => 'Daļas no šīs bītmapes ir noņemtas pēc autora vai trešās puses tiesību īpašnieka pieprasījuma.',
        'more-info' => 'Lai iegūtu papildu informāciju, noklikšķiniet šeit.',
        'rule_violation' => 'Daži šajā bītmapē ietvertie resursi ir izņemti pēc tam, kad tie tika novērtēti kā nepiemēroti izmantošanai osu!.',
    ],

    'cover' => [
        'deleted' => 'Izdzēstā bītmape',
    ],

    'download' => [
        'limit_exceeded' => 'Piebremzējiet, spēlējiet vairāk.',
    ],

    'featured_artist_badge' => [
        'label' => 'Attēlotais mākslinieks',
    ],

    'index' => [
        'title' => 'Bītkaršu saraksts',
        'guest_title' => 'Bītkartes',
    ],

    'panel' => [
        'empty' => 'nav bītmapju',

        'download' => [
            'all' => 'lejupielādēt',
            'video' => 'lejupielādēt ar video',
            'no_video' => 'lejupielādēt bez video',
            'direct' => 'atvērt ar osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Hibrīda bītmapei ir jāizvēlas vismaz viens spēles režīms, kuram veikt nomināciju.',
        'incorrect_mode' => 'Jums nav atļaujas nominēt modam: :mode',
        'full_bn_required' => 'Jums ir jābūt pilntiesīgam nominētājam, lai veiktu šo kvalifikācijas nomināciju.',
        'too_many' => 'Nominācijas prasība jau ir izpildīta.',

        'dialog' => [
            'confirmation' => 'Vai esat pārliecināts, ka vēlaties nominēt šo bītmapi?',
            'header' => 'Nominēt Bītmapi',
            'hybrid_warning' => 'piezīme: jūs varat nominēt tikai vienu reizi, tāpēc, lūdzu, pārliecinieties, ka nominējat visus plānotos spēles režīmus (modus)',
            'which_modes' => 'Kādiem modiem nominēt?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Nepiemērota satura',
    ],

    'show' => [
        'discussion' => 'Diskusija',

        'deleted_banner' => [
            'title' => '',
            'message' => '',
        ],

        'details' => [
            'by_artist' => ':artist',
            'favourite' => 'Favorizēt šo bītmapi',
            'favourite_login' => 'Pierakstieties, lai favorizētu šo bītmapi',
            'logged-out' => 'Jums nepieciešams pierakstīties pirms lejupielādēt jebkuru bītkarti!',
            'mapped_by' => 'kartēja :mapper',
            'mapped_by_guest' => 'viesa grūtības līmenis: :mapper',
            'unfavourite' => 'Noņemt favorizāciju šai bītmapei',
            'updated_timeago' => 'pēdējo reizi atjaonots :timeago',

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
            'loved' => 'loved :timeago',
            'qualified' => 'kvalificēja :timeago',
            'ranked' => 'ierindoja :timeago',
            'submitted' => 'iesniedza :timeago',
            'updated' => 'pēdējais atjauninājums :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Jums ir pārāk daudz favorizētu bītmapju! Pirms mēģināt vēlreiz, lūdzu, noņemiet dažas mapes no favorītiem.',
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
                '_' => 'Ja atrodat problēmu ar šo bītmapi, lūdzu, diskvalificējiet to :link.',
            ],

            'report' => [
                '_' => 'Ja atrodat problēmu ar šo ritma karti, lūdzu, ziņojiet par to :link, lai brīdinātu komandu.',
                'button' => 'Ziņot par problēmu',
                'link' => 'šeit',
            ],
        ],

        'info' => [
            'description' => 'Apraksts',
            'genre' => 'Žanrs',
            'language' => 'Valoda',
            'no_scores' => 'Rezultāti joprojām tiek aprēķināti...',
            'nominators' => 'Nominētāji',
            'nsfw' => 'Nepiemērots saturs',
            'offset' => 'Tiešsaistes nobīde',
            'points-of-failure' => 'Izkrišanas punkti',
            'source' => 'Avots',
            'storyboard' => 'Šī bītmape satur montāžu',
            'success-rate' => 'Izdošanās līmenis',
            'tags' => 'Birkas',
            'video' => 'Šī bītmape satur video',
        ],

        'nsfw_warning' => [
            'details' => 'Šajā bītmapē ir atklāts, aizskarošs vai satraucošs saturs. Vai tomēr vēlaties to skatīt?',
            'title' => 'Nepiemērots Saturs',

            'buttons' => [
                'disable' => 'Atspējot brīdinājumu',
                'listing' => 'Bītmapju saraksts',
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
            'title' => 'Rezultātu apkopojums',

            'headers' => [
                'accuracy' => 'Precizitāte',
                'combo' => 'Max Kombo',
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
                'unranked' => 'Neierindota bītmape.',
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
            'loved' => 'Loved',
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
