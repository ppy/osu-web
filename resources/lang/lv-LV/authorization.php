<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '',
    'require_login' => 'Lūdzu pierakstieties, lai turpinātu.',
    'require_verification' => '',
    'restricted' => "Nevar izpildīt darbību, kamēr esiet ierobežots.",
    'silenced' => "Nevar izpildīt darbību, kamēr esiet apklusināts.",
    'unauthorized' => 'Piekļuve liegta.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Nevar atsaukt publicizēšanu.',
            'has_reply' => 'Nevar izdzēst diskusijas ar atbildēm',
        ],
        'nominate' => [
            'exhausted' => 'Jūs esat sasniedzis savu šodienas nominēšanas limitu. Lūdzu mēģiniet atkal rītdien.',
            'incorrect_state' => 'Kļūda, veicot šo darbību, mēģiniet atsvaidzināt lapu.',
            'owner' => "Nevar nominēt savu bītkarti.",
            'set_metadata' => '',
        ],
        'resolve' => [
            'not_owner' => 'Tikai diskusijas sācējs un bītmapes īpašnieks var atrisināt diskusiju.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Tikai bītmapes īpašnieks vai tās izvirzītais/NAT grupas loceklis var publicēt veidotāja piezīmes.',
        ],

        'vote' => [
            'bot' => "",
            'limit_exceeded' => 'Lūdzu, uzgaidiet, pirms vēlreiz balsojat',
            'owner' => "Nevarat balsot paša diskusijā.",
            'wrong_beatmapset_state' => 'Diskusijās var vērtēt tikai vēl nepabeigtās bītmapēs.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Tu vari dzēst tikai savus rakstus.',
            'resolved' => 'Tu nevari izdzēst atrisināto diskusiju rakstus.',
            'system_generated' => 'Automātiski ģenerētie raksti nevar tikt dzēsti.',
        ],

        'edit' => [
            'not_owner' => 'Tikai publicētājs var rediģēt ziņojumu.',
            'resolved' => 'Tu nevari rediģēt atrisināto diskusiju rakstu.',
            'system_generated' => 'Automātiski ģenerēts ziņojums nevar tikt izmainīts.',
        ],

        'store' => [
            'beatmapset_locked' => 'Šī bītmape ir aizslēgta diskusiju pēc.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => '',
        ],
    ],

    'chat' => [
        'annnonce_only' => '',
        'blocked' => 'Nevar nosūtīt ziņojumu lietotājam, kas jūs ir nobloķējis vai kuru jūs esiet nobloķējis.',
        'friends_only' => 'Lietotājs ir bloķējis ziņojumus no cilvēkiem, kas nav viņa draugu sarakstā.',
        'moderated' => 'Šis kanāls pašlaik tiek regulēts.',
        'no_access' => 'Jums nav piekļuves tiesības uz šo kanālu.',
        'receive_friends_only' => '',
        'restricted' => 'Jūs nevarat sūtīt ziņas, kamēr jūs esat apklusināts, ierobežots vai zem aizlieguma.',
        'silenced' => '',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Nevar rediģēt izdzēstās ziņas.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Jūs nevarat nomainīt savu balsojumu pēc šī konkursa balsošanas perioda beigām.',

        'entry' => [
            'limit_reached' => '',
            'over' => '',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Nav atļaujas vadīt šo forumu.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Var izdzēst tikai pēdējo ziņu.',
                'locked' => 'Nevar dzēst ziņojumus slēgtā tēmā.',
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'not_owner' => 'Tikai publicētājs var izdzēst rakstu.',
            ],

            'edit' => [
                'deleted' => 'Nevar rediģēt izdzēsto rakstu.',
                'locked' => 'Ziņai ir bloķēta rediģēšana.',
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'not_owner' => 'Tikai publicētājs var rediģēt rakstu.',
                'topic_locked' => 'Nevar rediģēt ziņojumus slēgtā tēmā.',
            ],

            'store' => [
                'play_more' => 'Pamēģiniet uzspēlēt spēli pirms rakstāt forumos, lūdzu! Ja rodas problēmas ar spēli, lūdzu, sūtiet ziņu palīdzības in atbalsta forumam.',
                'too_many_help_posts' => "Jums nepieciešams izspēlēt vairāk spēles pirms jūs varat izveidot papildus ziņojumus. Ja joprojām ir problēmas spēlējot spēli, rakstiet e-pastam support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Lūdzu, rediģējiet jūsu pēdējo rakstu nevis publicējat vēlreiz.',
                'locked' => 'Nevar atbildēt uz slēgtu tematu.',
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'no_permission' => 'Nav atļauts atbildēt.',

                'user' => [
                    'require_login' => 'Lūdzu, pierakstieties, lai atbildētu.',
                    'restricted' => "Nevar atbildēt, kamēr esiet ierobežots.",
                    'silenced' => "Nevarat atbildēt, kamēr apklusināts.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'no_permission' => 'Nav atļauts veidot jaunas tēmas.',
                'forum_closed' => 'Forums ir slēgts, un tajā nevar rakstīt ziņas.',
            ],

            'vote' => [
                'no_forum_access' => 'Nepieciešama noteikta piekļuve uz izvēlēto forumu.',
                'over' => 'Aptauja ir beigusies un vairs nav iespējams balsot.',
                'play_more' => 'Jums vēl ir nepieciešams spēlēt vairāk, pirms variet balsot forumā.',
                'voted' => 'Mainīt balsojumu nav atļauts.',

                'user' => [
                    'require_login' => 'Lūdzu pierakstieties lai balsotu.',
                    'restricted' => "Nav iespējams balsot, kamēr esiet ierobežots.",
                    'silenced' => "Nevariet balsot, kamēr esiet apklusināts.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Nepieciešama noteikta piekļuve uz izvēlēto forumu.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Norādītā metode ir nederīga.',
                'not_owner' => 'Tikai īpašnieks var rediģēt metodi.',
            ],
            'store' => [
                'forum_not_allowed' => 'Šis forums nepieņem tēmu aizsegšanu.',
            ],
        ],

        'view' => [
            'admin_only' => 'Tikai admins var skatīt šo forumu.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => '',
            'too_many' => '',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Lietotāja profila lapa ir bloķēta.',
                'not_owner' => 'Rediģēt var tikai savu lietotāja profila lapu.',
                'require_supporter_tag' => 'ir nepieciešams osu!supporter.',
            ],
        ],
    ],
];
