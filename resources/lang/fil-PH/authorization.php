<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Paano kung maglaro nalang ng osu?',
    'require_login' => 'Paki-sign-in para tumuloy.',
    'require_verification' => 'Paki-beripika para tumuloy.',
    'restricted' => "Hindi pwedeng gawin habang naka-restricted.",
    'silenced' => "Hindi pwedeng gawin habang naka-silenced.",
    'unauthorized' => 'Hindi tinangap ang iyong pag-access.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Bawal ibalik ang hyping.',
            'has_reply' => 'Hindi pwede tanggalin ang talakayan na may kasamang mga sagot',
        ],
        'nominate' => [
            'exhausted' => 'Naabot mo na ang iyong limitasyon sa paghahalal ngayong araw na ito, subukan mo ulit bukas.',
            'incorrect_state' => 'Hindi maitupad ang aksyon na ito, subukang i-refresh ang pahina.',
            'owner' => "Hindi pwedeng hirangin ang sariling beatmap.",
            'set_metadata' => 'Kailangan mong itakda ang genre at wika bago i-nominate.',
        ],
        'resolve' => [
            'not_owner' => 'Ang nagsimula ng thread at ang may-ari ng beatmap lamang ang pwedeng lumutas ng talakayan.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Tanging ang may-ari ng beatmap o nominator/miyembro ng grupong QAT ang maaaring mag-lagay ng mapper tala.',
        ],

        'vote' => [
            'bot' => "Hindi maaaring bumoto sa talakayan na gawa ng bot",
            'limit_exceeded' => 'Maghintay nang sandali bago magsumite ng higit pang mga boto',
            'owner' => "Hindi pwedeng magboto sa sariling talakayan.",
            'wrong_beatmapset_state' => 'Pwede lang magboto sa mga talakayan ng mga pending beatmap.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Ikaw lamang ang makaka-delete ng iyong posts.',
            'resolved' => 'Hindi mo maaring ma-delete ang post na na-resolbang diskusyon.',
            'system_generated' => 'Mga awtomatikong poste na nagawa na ay hindi na maaring tanggalin.',
        ],

        'edit' => [
            'not_owner' => 'Ang poster lamang ang pwedeng mag-edit ng post.',
            'resolved' => 'Hindi mo maaring ma-edit ang post na na-resolbang diskusyon.',
            'system_generated' => 'Awtomatikong Pinagagana kapag post ay hindi maaaring i-edit.',
        ],

        'store' => [
            'beatmapset_locked' => 'Ang beatmap na ito ay sarado na para sa diskusyon.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'Hindi mo maaaring baguhin ang metadata ng nominadong na mapa. Makipag-ugnay sa mga miyembro ng BN o NAT kung sa tingin mo ay hindi siya naka-ayos mabuti.',
        ],
    ],

    'chat' => [
        'blocked' => 'Hindi maaaring i-message ang user na naka-block ka o na-block mo.',
        'friends_only' => 'Ang user na ito ay nagbo-block ng mga messages mula sa mga user na hindi parte ng kanyang friend list.',
        'moderated' => 'Kasalukuyang naka-moderate ang channel na ito.',
        'no_access' => 'Wala kang access sa channel na iyon.',
        'restricted' => 'Hindi ka maaaring maka-send ng mga mensahe habang naka-silence, restricted o banned.',
        'silenced' => 'Hindi ka maaaring maka-send ng mga mensahe habang naka-silence, restricted o banned.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Hindi maaaring i-edit ang mga tinanggal na post.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Hindi mo maaaring baguhin ang iyong boto kapag natapos na ang panahon ng pagboto para sa paligsahang ito.',

        'entry' => [
            'limit_reached' => 'Naabot mo na ang iyong limitasyon sa pagsumite para sa paligsahan na ito',
            'over' => 'Salamat sa iyong pagsumite! Ang pagsusumite ay nagsara na para sa paligsahan na ito at ang botohan ay magsisimula na.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Walang pahintulot na mag-moderate ng forum na ito.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Ang huling post lamang ang pwedeng tanggalin.',
                'locked' => 'Hindi pwedeng tanggalin ang post ng isang naka-lock na paksa.',
                'no_forum_access' => 'Access sa hiniling na forum ay kinakailangan.',
                'not_owner' => 'Ang poster lamang ang pwedeng magtanggal ng post.',
            ],

            'edit' => [
                'deleted' => 'Hindi pwedeng mag-edit ang tinanggal na post.',
                'locked' => 'Naka-lock ang post na ito sa pag-e-edit.',
                'no_forum_access' => 'Ang poster lamang ang pwedeng mag-edit ang post na ito.',
                'not_owner' => 'Ang poster lamang ang pwedeng mag-edit ng post.',
                'topic_locked' => 'Hindi pwedeng i-edit ang post ng isang naka-lock na paksa.',
            ],

            'store' => [
                'play_more' => 'Pakisubukang maglaro muna bago mag-post sa mga forum! Kung ikaw ay may problema sa paglalaro, pwede mong i-post sa Help and Support na forum.',
                'too_many_help_posts' => "Kailangan mo pang maglaro bago ka makagawa ng karagdagang mga post. Kung meron pa kayong problema sa paglalaro, mag-email sa support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Paki-edit ang huli mong post sa halip na mag-post muli.',
                'locked' => 'Hindi pwedeng sumagot sa isang naka-lock na thread.',
                'no_forum_access' => 'Access sa hiniling na forum ay kinakailangan.',
                'no_permission' => 'Walang pahintulot para sumagot.',

                'user' => [
                    'require_login' => 'Mangyaring mag-sign in sa sumagot.',
                    'restricted' => "Hindi pwedeng sumagot habang naka-restricted.",
                    'silenced' => "Hindi pwedeng sumagot habang naka-silenced.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Access sa hiniling na forum ay kinakailangan.',
                'no_permission' => 'Walang pahintulot upang gumawa ng bagong paksa.',
                'forum_closed' => 'Nakasarado ang forum at hindi pwedeng mag-post.',
            ],

            'vote' => [
                'no_forum_access' => 'Access sa hiniling na forum ay kinakailangan.',
                'over' => 'Tapos ang botohan at ay hindi na maaaring bumoto.',
                'play_more' => 'Kailangan mong maglaro pa ng marami bago ka maka-boto sa forum.',
                'voted' => 'Hindi pwedeng pumalit ng boto.',

                'user' => [
                    'require_login' => 'Mangyaring mag-sign in sa sumagot.',
                    'restricted' => "Hindi pwedeng bumoto habang naka-restricted.",
                    'silenced' => "Hindi pwedeng bumoto habang naka-silence.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Access sa hiniling na forum ay kinakailangan.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Maling cover ang naka-specify.',
                'not_owner' => 'Ang may-ari lamang ang maaaring mag edit ng cover.',
            ],
            'store' => [
                'forum_not_allowed' => 'Ang pagpupulong na ito ay hindi nagtatanggap ng panakip na paksa.',
            ],
        ],

        'view' => [
            'admin_only' => 'Ang admin lamang ang pwedeng tumingin ng forum na ito.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Naka-lock ang user page.',
                'not_owner' => 'Pwede lang i-edit ang sariling user page.',
                'require_supporter_tag' => 'Kailangan ng osu!supporter tag.',
            ],
        ],
    ],
];
