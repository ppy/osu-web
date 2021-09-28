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
        'beatmap_information' => '',
        'delete' => 'dzēst',
        'deleted' => 'Izdzēsa: :editor :delete_time.',
        'deny_kudosu' => 'neatļaut kudosu',
        'edit' => 'rediģēt',
        'edited' => 'Pēdējo reizi rediģēts :editor :update_time.',
        'guest' => '',
        'kudosu_denied' => 'Liegts saņemt kudosu.',
        'message_placeholder_deleted_beatmap' => 'Šis grūtības līmenis ir izdzēsts, tādēļ to vairs nav iespējas apspriest.',
        'message_placeholder_locked' => 'Šīs bītmapes diskusijas tika atspējotas.',
        'message_placeholder_silenced' => "",
        'message_type_select' => 'Atlasiet Komentāra Tipu',
        'reply_notice' => 'Nospiediet enter, lai atbildētu.',
        'reply_placeholder' => 'Raksiet atbildi šeit',
        'require-login' => 'Lūdzu ierakstieties lai pievienotu ziņojumu vai atbildētu',
        'resolved' => 'Atrisināts',
        'restore' => 'atjaunot',
        'show_deleted' => 'Rādīt dzēstos',
        'title' => 'Diskusijas',

        'collapse' => [
            'all-collapse' => 'Samazināt visu',
            'all-expand' => 'Palielināt visu',
        ],

        'empty' => [
            'empty' => 'Nav diskusiju!',
            'hidden' => 'Neviena diskusija neatbilst atlasītajam filtram.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Aizslēgt diskusiju',
                'unlock' => 'Atvērt diskusiju',
            ],

            'prompt' => [
                'lock' => 'Iemesls slēgšanai',
                'unlock' => 'Vai tiešām vēlaties atvērt?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Šis ziņojums tiks pārvietots uz vispārējo bītmapesset diskusiju. Lai pārveidotu šo bītmapi, izveidojat ziņojumu ar noteiktu laiku (piem. 00:12:345).',
            'in_timeline' => 'Lai pārveidotu vairākus laikus, ziņojat vairākas reizes (viens ziņojums = viens laiks).',
        ],

        'message_placeholder' => [
            'general' => 'Rakstiet šeit, lai publicētu uz Vispārīgi (:version)',
            'generalAll' => 'Rakstiet šeit, lai publicētu uz Vispārīgi (Visas grūtības)',
            'review' => '',
            'timeline' => 'Rakstiet šeit, lai publicētu uz Laika skalu (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalificēt',
            'hype' => 'Atbalstīt!',
            'mapper_note' => 'Piezīme',
            'nomination_reset' => 'Atiestatīt Nomināciju',
            'praise' => 'Uzslavināt',
            'problem' => 'Problēma',
            'review' => '',
            'suggestion' => 'Ieteikums',
        ],

        'mode' => [
            'events' => 'Vēsture',
            'general' => 'Vispārējā :scope',
            'reviews' => '',
            'timeline' => 'Laika līnija',
            'scopes' => [
                'general' => 'Šis grūtības līmenis',
                'generalAll' => 'Visi grūtības līmeņi',
            ],
        ],

        'new' => [
            'pin' => 'Piespraust',
            'timestamp' => 'Ieraksta laiks',
            'timestamp_missing' => 'uzspiežiet ctrl-c rediģēšanas režimā un ielīmējiet savu ziņojumu, lai pievienotu ieraksta laiku!',
            'title' => 'Jauna Diskusija',
            'unpin' => 'Nospraust',
        ],

        'review' => [
            'new' => '',
            'embed' => [
                'delete' => 'Izdzēst
',
                'missing' => '',
                'unlink' => 'Atvienot',
                'unsaved' => '',
                'timestamp' => [
                    'all-diff' => '',
                    'diff' => '',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'ievietot paragrāfu',
                'praise' => '',
                'problem' => '',
                'suggestion' => '',
            ],
        ],

        'show' => [
            'title' => ':title izveidoja :mapper',
        ],

        'sort' => [
            'created_at' => 'Izveidošanas laiks',
            'timeline' => 'Laika skala',
            'updated_at' => 'Beidzamais atjauninājums',
        ],

        'stats' => [
            'deleted' => 'Dzēsts',
            'mapper_notes' => 'Piezīmes',
            'mine' => 'Iegūt',
            'pending' => 'Procesā',
            'praises' => 'Uzslavinājumi',
            'resolved' => 'Atrisināts',
            'total' => 'Visi',
        ],

        'status-messages' => [
            'approved' => 'Šī bītmape tika apstiprināta: :date!',
            'graveyard' => "Šī bītmape nav atjaunināta kopš :date un visticamāk veidotājs to ir pametis...",
            'loved' => 'Šī bītmape tika pievienota Mīlēts kopš :date!',
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
        'love_choose' => '',
        'love_confirm' => 'Vai mīli šo bītmapi?',
        'nominate' => 'Nominēt',
        'nominate_confirm' => 'Nominēt šo bītkarti?',
        'nominated_by' => 'nominēja: :users',
        'not_enough_hype' => "",
        'remove_from_loved' => '',
        'remove_from_loved_prompt' => '',
        'required_text' => 'Nominācijas: current/:required',
        'reset_message_deleted' => 'dzēsts',
        'title' => 'Nominācijas status',
        'unresolved_issues' => 'Ir vēljoprojām neatrisinātas problēmas, kuras ir nepieciešams adresēt.',

        'rank_estimate' => [
            '_' => '',
            'queue' => '',
            'soon' => 'drīz',
        ],

        'reset_at' => [
            'nomination_reset' => 'Nominācijas process atiestatās :time_ago, jo :user ar jaunu problēmu :disscussion (:message).',
            'disqualify' => 'Diskvalifcēts :time_ago, jo :user ar jaunu problēmu :disscussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Esiet pārliecināts? Ziņojot jaunu problēmu tiks atiestatīts nominācijas process.',
            'disqualify' => 'Vai esiet pārliecināts? Šis noņems bītmapi no kvalificēšanās un atiestatīs tās izvirzīšanu.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'rakstiet atslēgas vārdus...',
            'login_required' => 'Ieiet, lai meklētu.',
            'options' => 'Vairāk Meklēšanas Opcijas',
            'supporter_filter' => 'Filtrēšana pēc :filters pieprasa aktīvu osu!atbalsta piespraudni',
            'not-found' => 'nav rezultātu',
            'not-found-quote' => '... puis, nekas netika atrasts.',
            'filters' => [
                'extra' => 'papildus',
                'general' => 'Visparīgī',
                'genre' => 'Žanrs',
                'language' => 'Valoda',
                'mode' => 'Režīms',
                'nsfw' => '',
                'played' => 'Spēlēts',
                'rank' => 'Rangs Sasniegts',
                'status' => 'Kategorijas',
            ],
            'sorting' => [
                'title' => 'Nosaukums',
                'artist' => 'Izpildītājs',
                'difficulty' => 'Sarežģītība',
                'favourites' => '',
                'updated' => 'Atjaunināt',
                'ranked' => '',
                'rating' => 'Reitingi',
                'plays' => 'Spēles',
                'relevance' => '',
                'nominations' => '',
            ],
            'supporter_filter_quote' => [
                '_' => '',
                'link_text' => '',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Iekļaut parveidotas bītmapes',
        'featured_artists' => '',
        'follows' => '',
        'recommended' => 'Ieteiktais grūtības līmenis',
    ],
    'mode' => [
        'all' => '',
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
        'leaderboard' => '',
        'loved' => 'Mīlēts',
        'mine' => 'Manas kartes',
        'pending' => '',
        'qualified' => 'Kvalificēts',
        'ranked' => '',
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
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
    ],
    'language' => [
        'any' => '',
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
        'unspecified' => '',
    ],

    'nsfw' => [
        'exclude' => '',
        'include' => '',
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
        'playcount' => '',
        'favourites' => '',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Viss',
        ],
    ],
];
