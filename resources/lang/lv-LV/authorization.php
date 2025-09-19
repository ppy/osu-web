<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Kā būtu, ja tā vietā tu nedaudz paspēlētu osu!?',
    'require_login' => 'Lūdzu, pieraksties, lai turpinātu.',
    'require_verification' => 'Lūdzu, verificējies, lai turpinātu.',
    'restricted' => "Nevar veikt darbību, kamēr esi ierobežots.",
    'silenced' => "Nevar veikt darbību, kamēr esat apklusināts.",
    'unauthorized' => 'Piekļuve liegta.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Nevar atsaukt atbalstīšanu.',
            'has_reply' => 'Nevar dzēst diskusijas ar atbildēm',
        ],
        'nominate' => [
            'exhausted' => 'Jūs esat sasniedzis šīs dienas nomināciju limitu, lūdzu, mēģiniet vēlreiz rīt.',
            'incorrect_state' => 'Kļūda, veicot šo darbību, mēģiniet atsvaidzināt lapu.',
            'owner' => "Nevar nominēt savu ritma-karti.",
            'set_metadata' => 'Jums pirms nominēšanas ir jānosaka žanrs un valoda.',
        ],
        'resolve' => [
            'not_owner' => 'Tikai diskusijas sācējs un ritma-kartes īpašnieks var atrisināt diskusiju.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Tikai ritma-kartes īpašnieks vai tās nominētājs/NAT grupas loceklis var publicēt veidotāja piezīmes.',
        ],

        'vote' => [
            'bot' => "Nevar balsot par diskusiju, ko izveidojis bots",
            'limit_exceeded' => 'Lūdzu, uzgaidi kādu laiku, pirms balso vēlreiz',
            'owner' => "Nevar balsot par savu diskusiju.",
            'wrong_beatmapset_state' => 'Var balsot tikai par pagaidu ritmu-kartēm diskusijām.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Jūs varat dzēst tikai savus rakstus.',
            'resolved' => 'Jūs nevarat dzēst atrisināto diskusiju rakstus.',
            'system_generated' => 'Automātiski ģenerēto rakstu nevar izdzēst.',
        ],

        'edit' => [
            'not_owner' => 'Tikai publicētājs var rediģēt rakstu.',
            'resolved' => 'Jūs nevarat rediģēt atrisinātas diskusijas rakstu.',
            'system_generated' => 'Automātiski ģenerētu rakstu nevar rediģēt.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Šī ritma-karte ir aizslēgta diskusijai.',

        'metadata' => [
            'nominated' => 'Nominētas mapes metadatus mainīt nevar. Sazinies ar BN vai NAT locekli, ja uzskati, ka tā ir iestatīta nepareizi.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => 'Tev vajag uzstādīt rezultātu uz ritma-mapi lai pievienotu piekariņu.',
        ],
    ],

    'chat' => [
        'blocked' => 'Nevar nosūtīt ziņu lietotājam, kurš nobloķējis tevi vai kuru tu esi nobloķējis.',
        'friends_only' => 'Lietotājs bloķē ziņas no cilvēkiem, kas nav viņa draugu sarakstā.',
        'moderated' => 'Šis kanāls pašlaik tiek regulēts.',
        'no_access' => 'Jums nav piekļuves tiesības uz šo kanālu.',
        'no_announce' => 'Tev nav atļauja publicēt paziņojumu.',
        'receive_friends_only' => 'Lietotājs nevarēs atbildēt, jo tu pieņem ziņas tikai no cilvēkiem, kas ir tavā draugu sarakstā.',
        'restricted' => 'Tu nevari sūtīt ziņas, kamēr esi klusināts, ierobežots vai bloķēts.',
        'silenced' => 'Tu nevari sūtīt ziņas, kamēr esi klusināts, ierobežots vai bloķēts.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Komentāri ir izslēgti',
        ],
        'update' => [
            'deleted' => "Nevar rediģēt izdzēstu rakstu.",
        ],
    ],

    'contest' => [
        'judging_not_active' => 'Tiesāšana šīm sacensībām nav aktīva.',
        'voting_over' => 'Tu nevari mainīt savu balsojumu pēc šī konkursa balsošanas perioda beigām.',

        'entry' => [
            'limit_reached' => 'Tu esi sasniedzis šī konkursa dalības limitu',
            'over' => 'Paldies par tavu pieteikumiem! Iesniegumi šim konkursam ir slēgti, un drīzumā sāksies balsošana.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Nav atļaujas moderēt šo forumu.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Izdzēst var tikai pēdējo ziņu.',
                'locked' => 'Nevar dzēst slēgtas tēmas rakstu.',
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'not_owner' => 'Tikai publicētājs var izdzēst rakstu.',
            ],

            'edit' => [
                'deleted' => 'Nevar rediģēt izdzēstu rakstu.',
                'locked' => 'Raksta rediģēšana ir slēgta.',
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'no_permission' => 'Nav atļauts rediģēt.',
                'not_owner' => 'Tikai publicētājs var rediģēt rakstu.',
                'topic_locked' => 'Nevar rediģēt ziņojumus slēgtā tēmā.',
            ],

            'store' => [
                'play_more' => 'Pamēģini paspēlēt spēli pirms raksti forumos, lūdzu! Ja rodas problēmas ar spēli, lūdzu, sūti ziņu palīdzības atbalsta forumam.',
                'too_many_help_posts' => "Tev vajag vairāk paspēlēt spēli, pirms tu vari izveidot papildu rakstus. Ja joprojām ir problēmas ar spēlēšanu, rakstiet uz support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Lūdzu, rediģē savu pēdējo rakstu, nevis publicē to vēlreiz.',
                'locked' => 'Nevar atbildēt uz slēgtu tematu.',
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'no_permission' => 'Nav atļauts atbildēt.',

                'user' => [
                    'require_login' => 'Lūdzu, pierakstieties, lai atbildētu.',
                    'restricted' => "Nevar atbildēt, kamēr esi ierobežots.",
                    'silenced' => "Nevarat atbildēt, kamēr esi apklusināts.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'no_permission' => 'Nav atļaujas izveidot jaunu tēmu.',
                'forum_closed' => 'Forums ir aizvērts, un tajā nevar neko publicēt.',
            ],

            'vote' => [
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'over' => 'Aptauja ir beigusies, un tajā vairs nevar balsot.',
                'play_more' => 'Tev vajag paspēlēt vairāk, pirms vari balsot forumā.',
                'voted' => 'Mainīt balsojumu nav atļauts.',

                'user' => [
                    'require_login' => 'Lūdzu, pierakstieties, lai balsotu.',
                    'restricted' => "Nevar balsot, kamēr esi ierobežots.",
                    'silenced' => "Nevar balsot, kamēr esi apklusināts.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Norādītais pārvalks nederīgs.',
                'not_owner' => 'Tikai īpašnieks var rediģēt pārvalku.',
            ],
            'store' => [
                'forum_not_allowed' => 'Šis forums nepieņem tēmu pārvalkus.',
            ],
        ],

        'view' => [
            'admin_only' => 'Tikai administrators var skatīt šo forumu.',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => 'Tikai izstabas īpašnieks var to aizvērt.',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "Nevar piespraust šāda veida rezultātu",
            'failed' => "Nevar piespraust izgāzušos rezultātu.",
            'not_owner' => 'Rezultātu var piespraust tikai rezultāta īpašnieks.',
            'too_many' => 'Piesprausti pārāk daudz rezultāti.',
        ],
    ],

    'team' => [
        'application' => [
            'store' => [
                'already_member' => "Tu jau esi komandā.",
                'already_other_member' => "Tu jau esi citā komandā.",
                'currently_applying' => 'Tev ir esošs komandas pievienošanās pieprasījums.',
                'team_closed' => 'Šī komanda pašlaik nepieņem vēl pievienošanās pieprasījumus.',
                'team_full' => "Komanda ir pilna un nevar pieņemt vēl vairāk dalībniekus.",
            ],
        ],
        'part' => [
            'is_leader' => "Komandas galvenais nevar pamest komandu.",
            'not_member' => 'Nav komandas dalībnieks.',
        ],
        'store' => [
            'require_supporter_tag' => 'osu!atbalsītājs ir nepieciešams, lai izveidotu komandu.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Lietotāja lapa ir slēgta.',
                'not_owner' => 'Rediģēt var tikai savu lietotāja lapu.',
                'require_supporter_tag' => 'osu!atbalsītājs ir nepieciešams.',
            ],
        ],
        'update_email' => [
            'locked' => 'e-pasta adrese ir slēgta',
        ],
    ],
];
