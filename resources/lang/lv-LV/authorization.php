<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Kā tā vietā nedaudz paspēlēt osu!?',
    'require_login' => 'Lūdzu, pierakstieties, lai turpinātu.',
    'require_verification' => 'Lūdzu, verificēt, lai turpinātu.',
    'restricted' => "Nevar veikt darbību, kamēr esat ierobežots.",
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
            'owner' => "Nevar nominēt savu bītmapi.",
            'set_metadata' => 'Jums pirms nominēšanas ir jānosaka žanrs un valoda.',
        ],
        'resolve' => [
            'not_owner' => 'Tikai diskusijas sācējs un bītmapes īpašnieks var atrisināt diskusiju.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Tikai bītmapes īpašnieks vai tās nominētājs/NAT grupas loceklis var publicēt veidotāja piezīmes.',
        ],

        'vote' => [
            'bot' => "Nevar balsot par diskusiju, ko izveidojis bots",
            'limit_exceeded' => 'Lūdzu, uzgaidiet kādu laiku, pirms balsojat vēlreiz',
            'owner' => "Nevar balsot par savu diskusiju.",
            'wrong_beatmapset_state' => 'Var balsot tikai par gaidāmajām bītmapju diskusijām.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Jūs varat dzēst tikai savus rakstus.',
            'resolved' => 'Jūs nevarat dzēst atrisināto diskusiju rakstus.',
            'system_generated' => 'Automātiski ģenerēto rakstu nevar dzēst.',
        ],

        'edit' => [
            'not_owner' => 'Tikai publicētājs var rediģēt rakstu.',
            'resolved' => 'Jūs nevarat rediģēt atrisinātas diskusijas rakstu.',
            'system_generated' => 'Automātiski ģenerētu rakstu nevar rediģēt.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => '',

        'metadata' => [
            'nominated' => 'Nominētas mapes metadatus mainīt nevar. Sazinieties ar BN vai NAT locekli, ja uzskatāt, ka tā ir iestatīta nepareizi.',
        ],
    ],

    'chat' => [
        'annnonce_only' => 'Šis kanāls ir paredzēts tikai paziņojumiem.',
        'blocked' => 'Nevar nosūtīt ziņu lietotājam, kurš nobloķējis jūs vai kuru jūs esat nobloķējis.',
        'friends_only' => 'Lietotājs bloķē ziņas no cilvēkiem, kas nav viņa draugu sarakstā.',
        'moderated' => 'Šis kanāls pašlaik tiek moderēts.',
        'no_access' => 'Jums nav piekļuves tiesības uz šo kanālu.',
        'receive_friends_only' => 'Lietotājs nevarēs atbildēt, jo jūs pieņemat ziņas tikai no cilvēkiem, kas ir jūsu draugu sarakstā.',
        'restricted' => 'Jūs nevarat sūtīt ziņas, kamēr esat klusināts, ierobežots vai bloķēts.',
        'silenced' => 'Jūs nevarat sūtīt ziņas, kamēr esat klusināts, ierobežots vai bloķēts.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Komentāri ir atspējoti',
        ],
        'update' => [
            'deleted' => "Nevar rediģēt izdzēstu rakstu.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Jūs nevarat mainīt savu balsojumu pēc šī konkursa balsošanas perioda beigām.',

        'entry' => [
            'limit_reached' => 'Jūs esat sasniedzis šī konkursa dalības limitu',
            'over' => 'Paldies par jūsu pieteikumiem! Iesniegumi šim konkursam ir slēgti, un drīzumā sāksies balsošana.',
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
                'locked' => 'Ziņai ir bloķēta rediģēšana.',
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'not_owner' => 'Tikai publicētājs var rediģēt rakstu.',
                'topic_locked' => 'Nevar rediģēt ziņojumus slēgtā tēmā.',
            ],

            'store' => [
                'play_more' => 'Pamēģiniet uzspēlēt spēli pirms rakstāt forumos, lūdzu! Ja rodas problēmas ar spēli, lūdzu, sūtiet ziņu palīdzības in atbalsta forumam.',
                'too_many_help_posts' => "Jums nepieciešams izspēlēt vairāk spēles pirms jūs varat publicēt papildus rakstus. Ja joprojām ir problēmas ar spēlēšanu, rakstiet uz support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Lūdzu, rediģējiet savu pēdējo rakstu, nevis publicējiet to vēlreiz.',
                'locked' => 'Nevar atbildēt uz slēgtu tematu.',
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'no_permission' => 'Nav atļauts atbildēt.',

                'user' => [
                    'require_login' => 'Lūdzu, pierakstieties, lai atbildētu.',
                    'restricted' => "Nevar atbildēt, kamēr esat ierobežots.",
                    'silenced' => "Nevarat atbildēt, kamēr esat apklusināts.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'no_permission' => 'Nav atļaujas izveidot jaunu tēmu.',
                'forum_closed' => 'Forums ir aizvērts, un tajā nevar publicēt.',
            ],

            'vote' => [
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
                'over' => 'Aptauja ir beigusies, un tajā vairs nevar balsot.',
                'play_more' => 'Jums ir nepieciešams spēlēt vairāk, pirms varat balsot forumā.',
                'voted' => 'Mainīt balsojumu nav atļauts.',

                'user' => [
                    'require_login' => 'Lūdzu, pierakstieties, lai balsotu.',
                    'restricted' => "Nevar balsot, kamēr esat ierobežots.",
                    'silenced' => "Nevar balsot, kamēr esat apklusināts.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Ir nepieciešama piekļuve pieprasītajam forumam.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Norādītais vāks ir nederīgs.',
                'not_owner' => 'Tikai īpašnieks var rediģēt vāku.',
            ],
            'store' => [
                'forum_not_allowed' => 'Šis forums nepieņem tēmu vākus.',
            ],
        ],

        'view' => [
            'admin_only' => 'Tikai administrators var skatīt šo forumu.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => 'Rezultātu var piespraust tikai rezultāta īpašnieks.',
            'too_many' => 'Piesprausti pārāk daudz rezultāti.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Lietotāja lapa ir slēgta.',
                'not_owner' => 'Rediģēt var tikai savu lietotāja lapu.',
                'require_supporter_tag' => 'Ir nepieciešams osu!supporter.',
            ],
        ],
    ],
];
