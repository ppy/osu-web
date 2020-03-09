<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'discussion-posts' => [
        'store' => [
            'error' => 'Neizdevās saglabāt ziņojumu',
        ],
    ],

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
        'kudosu_denied' => 'Liegts saņemt kudosu.',
        'message_placeholder_deleted_beatmap' => 'Šis grūtības līmenis ir izdzēsts, tādēļ to vairs nav iespējas apspriest.',
        'message_placeholder_locked' => 'Šīs bītmapes diskusijas tika atspējotas.',
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
        'love_confirm' => 'Vai mīli šo bītmapi?',
        'nominate' => 'Nominēt',
        'nominate_confirm' => 'Nominēt šo bītkarti?',
        'nominated_by' => 'nominēja: :users',
        'not_enough_hype' => "",
        'qualified' => 'Paredzēts pieņemt: :date, ja netiks vairāk konstatētas problēmas.',
        'qualified_soon' => 'Paredzēts pieņemt drīz, ja netiks vairāk konstatētas problēmas.',
        'required_text' => 'Nominācijas: current/:required',
        'reset_message_deleted' => 'dzēsts',
        'title' => 'Nominācijas status',
        'unresolved_issues' => 'Ir vēljoprojām neatrisinātas problēmas, kuras ir nepieciešams adresēt.',

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
                'general' => 'Visparīgī',
                'mode' => 'Režīms',
                'status' => 'Kategorijas',
                'genre' => 'Žanrs',
                'language' => 'Valoda',
                'extra' => 'papildus',
                'rank' => 'Rangs Sasniegts',
                'played' => 'Spēlēts',
            ],
            'sorting' => [
                'title' => 'Nosaukums',
                'artist' => '',
                'difficulty' => '',
                'favourites' => '',
                'updated' => '',
                'ranked' => '',
                'rating' => '',
                'plays' => '',
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
        'recommended' => 'Ieteiktais grūtības līmenis',
        'converts' => 'Iekļaut parveidotas bītmapes',
    ],
    'mode' => [
        'any' => 'Viss',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Viss',
        'approved' => 'Apstiprināts',
        'favourites' => '',
        'graveyard' => 'Kapsēta',
        'leaderboard' => '',
        'loved' => 'Mīlēts',
        'mine' => '',
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
        'MR' => 'Spoguļveids',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
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
        'instrumental' => 'Instrumentālā',
        'other' => 'Citi',
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
];
