<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Neizdevās atjaunināt balsojumu',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'atļaut kudosu',
        'beatmap_information' => 'Bītmapes Lapa',
        'delete' => 'dzēst',
        'deleted' => 'Izdzēsa: :editor :delete_time.',
        'deny_kudosu' => 'neatļaut kudosu',
        'edit' => 'rediģēt',
        'edited' => 'Pēdējo reizi rediģēja :editor :update_time.',
        'guest' => 'Viesa grūtības līmenis: :user',
        'kudosu_denied' => 'Liegts saņemt kudosu.',
        'message_placeholder_deleted_beatmap' => 'Šis grūtības līmenis ir izdzēsts, tāpēc to vairs nevar apspriest.',
        'message_placeholder_locked' => 'Šīs bītmapes diskusijas ir atspējotas.',
        'message_placeholder_silenced' => "Nevar publicēt diskusiju, kamēr apklusināts.",
        'message_type_select' => 'Atlasiet Komentāra Tipu',
        'reply_notice' => 'Nospiediet enter, lai atbildētu.',
        'reply_placeholder' => 'Raksiet atbildi šeit',
        'require-login' => 'Lūdzu, pierakstieties, lai publicētu vai atbildētu',
        'resolved' => 'Atrisināts',
        'restore' => 'atjaunot',
        'show_deleted' => 'Rādīt dzēstos',
        'title' => 'Diskusijas',

        'collapse' => [
            'all-collapse' => 'Sakļaut visu',
            'all-expand' => 'Izvērst visu',
        ],

        'empty' => [
            'empty' => 'Pagaidām nav diskusiju!',
            'hidden' => 'Neviena diskusija neatbilst atlasītajam filtram.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Slēgt diskusiju',
                'unlock' => 'Atslēgt diskusiju',
            ],

            'prompt' => [
                'lock' => 'Iemesls slēgšanai',
                'unlock' => 'Vai tiešām vēlaties atslēgt?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Šis raksts tiks nodots vispārējai bītmapes diskusijai. Lai modificētu šo grūtības pakāpi, sāciet ziņojumu ar laika zīmogu (piem., 00:12:345).',
            'in_timeline' => 'Lai modificētu vairākus laikus, ziņojiet vairākas reizes (viens ziņojums uz vienu laika vienību).',
        ],

        'message_placeholder' => [
            'general' => 'Rakstiet šeit, lai publicētu uz Vispārīgi (:version)',
            'generalAll' => 'Rakstiet šeit, lai publicētu uz Vispārīgi (Visas grūtības)',
            'review' => 'Rakstiet šeit, lai publicētu atsauksmi',
            'timeline' => 'Rakstiet šeit, lai publicētu uz Laika skalu (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalificēt',
            'hype' => 'Atbalstīt!',
            'mapper_note' => 'Piezīme',
            'nomination_reset' => 'Atiestatīt Nomināciju',
            'praise' => 'Uzslavēt',
            'problem' => 'Problēma',
            'problem_warning' => 'Ziņot par problēmu',
            'review' => 'Atsauksme',
            'suggestion' => 'Ieteikums',
        ],

        'mode' => [
            'events' => 'Vēsture',
            'general' => 'Vispārējā :scope',
            'reviews' => 'Atsauksmes',
            'timeline' => 'Laika skala',
            'scopes' => [
                'general' => 'Šis grūtības līmenis',
                'generalAll' => 'Visi grūtības līmeņi',
            ],
        ],

        'new' => [
            'pin' => 'Piespraust',
            'timestamp' => 'Laika zīmogs',
            'timestamp_missing' => 'ctrl-c rediģēšanas režīmā un ielīmējiet ziņu, lai pievienotu laika zīmogu!',
            'title' => 'Jauna Diskusija',
            'unpin' => 'Atspraust',
        ],

        'review' => [
            'new' => 'Jauna Atsauksme',
            'embed' => [
                'delete' => 'Izdzēst',
                'missing' => '[DISKUSIJA DZĒSTA]',
                'unlink' => 'Atvienot',
                'unsaved' => 'Nesaglabāts',
                'timestamp' => [
                    'all-diff' => 'Rakstiem uz "Visas grūtības" nevar pievienot laika zīmogu.',
                    'diff' => 'Ja šis :type sākas ar laika zīmogu, tas tiks parādīts zem Laika skalas.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'ievietot rindkopu',
                'praise' => 'ievietot uzslavu',
                'problem' => 'ievietot problēmu',
                'suggestion' => 'ievietot ieteikumu',
            ],
        ],

        'show' => [
            'title' => ':title izveidoja :mapper',
        ],

        'sort' => [
            'created_at' => 'Izveidošanas laiks',
            'timeline' => 'Laika skala',
            'updated_at' => 'Pēdējais atjauninājums',
        ],

        'stats' => [
            'deleted' => 'Dzēsts',
            'mapper_notes' => 'Piezīmes',
            'mine' => 'Mans',
            'pending' => 'Procesā',
            'praises' => 'Uzslavas',
            'resolved' => 'Atrisināts',
            'total' => 'Viss',
        ],

        'status-messages' => [
            'approved' => 'Šī bītmape tika apstiprināta: :date!',
            'graveyard' => "Šī bītmape nav atjaunināta kopš :date, tāpēc tā ir pamesta...",
            'loved' => 'Šī bītmape tika pievienota loved datumā :date!',
            'ranked' => 'Šī bītmape tika pieņemta: :date!',
            'wip' => 'Piezīme: Šī bītmape ir atzīmēta kā izveide procesā pēc izveidotāja pieprasījuma.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Nav negatīvu balsu',
                'up' => 'Nav pozitīvu balsu',
            ],
            'latest' => [
                'down' => 'Beidzamās negatīvās balsis',
                'up' => 'Beidzamās pozitīvās balsis',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Atbalstīt Bītmapi!',
        'button_done' => 'Jau Atbalstīts!',
        'confirm' => "Vai esi pārliecināts? Tas izmantos vienu no atlikušajām :n atbalstiem un to nevarēs atgriezt.",
        'explanation' => 'Atbalstiet šo bītmapi, lai to padarītu labāk redzamu priekš nominēšanas un pieņemšanas!',
        'explanation_guest' => 'Ierakstieties un atbalstiet šo bītmapi, lai to padarītu labāk redzamu priekš nominēšanas un pieņemšanas!',
        'new_time' => "Jūs saņemsiet jaunu atbalstu: :new_time.",
        'remaining' => 'Jums ir atlikuši :remaining atbalsti.',
        'required_text' => 'Atbalsti: :current/:required',
        'section_title' => 'Atbalstu Burzma',
        'title' => 'Atbalstīt',
    ],

    'feedback' => [
        'button' => 'Atstāt atsauksmi',
    ],

    'nominations' => [
        'delete' => 'Izdzēst',
        'delete_own_confirm' => 'Vai esiet pārliecināts? Bītmape tiks izdzēsta un jūs tiksiet atgriezts atpakaļ uz savu profilu.',
        'delete_other_confirm' => 'Vai esiet pārliecināts? Bītmape tiks izdzēsta un jūs tiksiet nogādāts atpakaļ lietotāja profilā.',
        'disqualification_prompt' => 'Iemesls diskvalifikācijai?',
        'disqualified_at' => 'Diskvalificēts :time_ago (:reason).',
        'disqualified_no_reason' => 'nav norādīts iemesls',
        'disqualify' => 'Diskvalificēt',
        'incorrect_state' => 'Kļūda veicot šo darbību, mēģiniet atsvaidzināt lapu.',
        'love' => 'Mīļš',
        'love_choose' => 'Izvēlieties grūtību loved mapei',
        'love_confirm' => 'Vai mīli šo bītmapi?',
        'nominate' => 'Nominēt',
        'nominate_confirm' => 'Nominēt šo bītkarti?',
        'nominated_by' => 'nominēja: :users',
        'not_enough_hype' => "Nav pietiekami daudz atbalsta.",
        'remove_from_loved' => 'Noņemt no Loved',
        'remove_from_loved_prompt' => 'Iemesls noņemšanai no Iemīļota:',
        'required_text' => 'Nominācijas: current/:required',
        'reset_message_deleted' => 'dzēsts',
        'title' => 'Nominācijas status',
        'unresolved_issues' => 'Ir vēljoprojām neatrisinātas problēmas, kuras ir nepieciešams adresēt.',

        'rank_estimate' => [
            '_' => 'Tiek paredzēts, ka šī mape tiks ierindota :date, ja netiks konstatētas problēmas. Tā ir #:position :queue.',
            'on' => '',
            'queue' => 'ierindošanas rinda',
            'soon' => 'drīz',
        ],

        'reset_at' => [
            'nomination_reset' => 'Nominācijas process atiestatās :time_ago, jo :user ar jaunu problēmu :disscussion (:message).',
            'disqualify' => 'Diskvalifcēts :time_ago, jo :user ar jaunu problēmu :disscussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Vai esiet pārliecināts? Šis noņems bītmapi no kvalificēšanās un atiestatīs tās izvirzīšanu.',
            'nomination_reset' => 'Esiet pārliecināts? Ziņojot jaunu problēmu tiks atiestatīts nominācijas process.',
            'problem_warning' => 'Vai esat pārliecināts, ka jāziņo par problēmu ar šo bītmapi? Tas brīdinās Bītmapju Nominatorus.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'rakstiet atslēgas vārdus...',
            'login_required' => 'Ieiet, lai meklētu.',
            'options' => 'Vairāk Meklēšanas Opcijas',
            'supporter_filter' => 'Filtrēšanai pēc :filters ir nepieciešams aktīvs osu!supporter',
            'not-found' => 'nav rezultātu',
            'not-found-quote' => '... puis, nekas netika atrasts.',
            'filters' => [
                'extra' => 'papildus',
                'general' => 'Visparīgī',
                'genre' => 'Žanrs',
                'language' => 'Valoda',
                'mode' => 'Režīms',
                'nsfw' => 'Nepiemērots Saturs',
                'played' => 'Spēlēts',
                'rank' => 'Rangs Sasniegts',
                'status' => 'Kategorijas',
            ],
            'sorting' => [
                'title' => 'Nosaukums',
                'artist' => 'Izpildītājs',
                'difficulty' => 'Sarežģītība',
                'favourites' => 'Iemīļotākās',
                'updated' => 'Atjaunināt',
                'ranked' => 'Ierindota',
                'rating' => 'Reitingi',
                'plays' => 'Spēles',
                'relevance' => 'Atbilstība',
                'nominations' => 'Nominācijas',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrēšanai pēc :filters ir nepieciešams aktīvs :link',
                'link_text' => 'osu!supporter tags',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Iekļaut pārveidotās bītmapes',
        'featured_artists' => 'Attēlotie mākslinieki',
        'follows' => 'Abonētie kartētāji',
        'recommended' => 'Ieteiktais grūtības līmenis',
        'spotlights' => 'Bītmapes uzmanības centrā',
    ],
    'mode' => [
        'all' => 'Viss',
        'any' => 'Viss',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Viss',
        'approved' => 'Apstiprināts',
        'favourites' => 'Favorīti',
        'graveyard' => 'Kapsēta',
        'leaderboard' => 'Ir Līderu Saraksts',
        'loved' => 'Loved',
        'mine' => 'Manas kartes',
        'pending' => 'Procesā',
        'wip' => 'WIP',
        'qualified' => 'Kvalificēts',
        'ranked' => 'Rangots',
    ],
    'genre' => [
        'any' => 'Viss',
        'unspecified' => 'Nenorādīts',
        'video-game' => 'Video Spēle',
        'anime' => 'Anime',
        'rock' => 'Roks',
        'pop' => 'Pop',
        'other' => 'Citi',
        'novelty' => 'Jaunums',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektroniskā',
        'metal' => 'Metāls',
        'classical' => 'Klasiskais',
        'folk' => 'Tautas',
        'jazz' => 'Džezs',
    ],
    'language' => [
        'any' => 'Jebkura',
        'english' => 'Angļu',
        'chinese' => 'Ķīniešu',
        'french' => 'Franču',
        'german' => 'Vāciešu',
        'italian' => 'Itāļu',
        'japanese' => 'Japāņu',
        'korean' => 'Korejiešu',
        'spanish' => 'Spāņu',
        'swedish' => 'Zviedru',
        'russian' => 'Krievu',
        'polish' => 'Poļu',
        'instrumental' => 'Instrumentālā',
        'other' => 'Citi',
        'unspecified' => 'Nenorādīts',
    ],

    'nsfw' => [
        'exclude' => 'Slēpt',
        'include' => 'Rādīt',
    ],

    'played' => [
        'any' => 'Viss',
        'played' => 'Spēlēts',
        'unplayed' => 'Nespēlēts',
    ],
    'extra' => [
        'video' => 'Ir Video',
        'storyboard' => 'Ir montāža',
    ],
    'rank' => [
        'any' => 'Visi',
        'XH' => 'Sudraba SS',
        'X' => '',
        'SH' => 'Sudraba S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Spēlējumu skaits: :count',
        'favourites' => 'Patīk: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Viss',
        ],
    ],
];
