<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Paano kung maglaro ng ilang osu! sa halip?',
    'require_login' => 'Paki-sign-in para tumuloy.',
    'require_verification' => 'Paki-verify para tumuloy.',
    'restricted' => "Hindi magagawa iyon habang pinaghihigpitan.",
    'silenced' => "Hindi magagawa iyon habang naka-silenced.",
    'unauthorized' => 'Ang pag-access ay tinanggihan.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Hindi ma-undo ang hyping.',
            'has_reply' => 'Hindi matanggal ang talakayan na may mga tugon',
        ],
        'nominate' => [
            'exhausted' => 'Naabot mo na ang iyong limitasyon sa paghahalal ngayong araw na ito, subukan mo ulit bukas.',
            'incorrect_state' => 'Hindi maitupad ang aksyon na ito, subukang i-refresh ang pahina.',
            'owner' => "Hindi pwedeng hirangin ang sariling beatmap.",
            'set_metadata' => 'Dapat mong itakda ang genre at wika bago magnomina.',
        ],
        'resolve' => [
            'not_owner' => 'Tanging ang thread starter at may-ari ng beatmap lang ang makakapagresolba ng talakayan.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Tanging ang may-ari ng beatmap o nominator/miyembro ng grupong NAT ang maaaring mag-post ng mga tala ng mapper.',
        ],

        'vote' => [
            'bot' => "Hindi makaboto sa talakayang ginawa ng bot",
            'limit_exceeded' => 'Pakihintay ng ilang sandali bago magsumite ng higit pang mga boto',
            'owner' => "Hindi makaboto sa sariling talakayan.",
            'wrong_beatmapset_state' => 'Maaari lamang bumoto sa mga talakayan tungkol sa mga pending na beatmap.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Ikaw lang ang makapagtanggal ng sarili mong mga post.',
            'resolved' => 'Hindi mo maaaring tanggalin ang isang post ng isang naresolbang talakayan.',
            'system_generated' => 'Ang awtomatikong post na nabuo ay hindi maaaring tanggalin.',
        ],

        'edit' => [
            'not_owner' => 'Ang poster lang ang makakapag-edit ng post.',
            'resolved' => 'Hindi mo maaaring i-edit ang isang post ng naresolbang talakayan.',
            'system_generated' => 'Ang awtomatikong post na nabuo ay hindi maaaring i-edit.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Naka-lock ang beatmap na ito para sa talakayan.',

        'metadata' => [
            'nominated' => 'Hindi maaaring baguhin ang metadata ng isang nominadong beatmap. Makipag-ugnayan sa isang miyembro ng BN o NAT kung sa palagay mo ay mali ang pagkakatakda nito.',
        ],
    ],

    'chat' => [
        'annnonce_only' => 'Ang channel na ito ay para sa mga anunsyo lamang.',
        'blocked' => 'Hindi makapag-mensahe sa isang user na humaharang sa iyo o hinarang mo.',
        'friends_only' => 'Hinaharang ng user ang mga mensahe mula sa mga taong wala sa listahan ng kanilang mga kaibigan.',
        'moderated' => 'Ang channel na ito ay kasalukuyang naka-moderate.',
        'no_access' => 'Wala kang access sa channel na iyon.',
        'receive_friends_only' => 'Ang user ay maaaring hindi makatugon dahil tumatanggap ka lang ng mga mensahe mula sa mga tao sa listahan ng iyong mga kaibigan.',
        'restricted' => 'Hindi ka maaaring magpadala ng mga mensahe habang pinatahimik, pinaghihigpitan o pinagbawalan.',
        'silenced' => 'Hindi ka maaaring magpadala ng mga mensahe habang pinatahimik, pinaghihigpitan o pinagbawalan.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Ang mga comment ay naka-disable',
        ],
        'update' => [
            'deleted' => "Hindi ma-edit ang natanggal na post.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Hindi mo maaaring baguhin ang iyong boto pagkatapos ng panahon ng pagboto para sa paligsahang ito ay natapos na.',

        'entry' => [
            'limit_reached' => 'Naabot mo na ang limitasyon sa pagpasok para sa paligsahang ito',
            'over' => 'Salamat sa iyong mga entry! Ang mga pagsusumite ay sarado na para sa paligsahang ito at ang pagboto ay magbukas sa lalong madaling panahon.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Walang pahintulot na mag-moderate ng forum na ito.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Ang huling post lang ang maaaring tanggalin.',
                'locked' => 'Hindi matanggal ang post ng isang naka-lock na paksa.',
                'no_forum_access' => 'Ang pag-access sa hiniling na forum ay kinakailangan.',
                'not_owner' => 'Tanging poster lang ang makakapagtanggal sa post.',
            ],

            'edit' => [
                'deleted' => 'Hindi ma-edit ang natangal na post.',
                'locked' => 'Ang post ay naka-lock mula sa pag-edit.',
                'no_forum_access' => 'Ang pag-access sa hiniling na forum ay kinakailangan.',
                'not_owner' => 'Ang poster lang ang makakapag-edit ng post.',
                'topic_locked' => 'Hindi ma-edit ang post ng isang naka-lock na paksa.',
            ],

            'store' => [
                'play_more' => 'Pakisubukang maglaro bago mag-post sa mga forum! Kung mayroon kang problema sa paglalaro, pakipost sa Help and Support forum.',
                'too_many_help_posts' => "Kailangan mo pang laruin ang laro bago ka makagawa ng mga karagdagang post. Kung nahihirapan ka pa rin sa paglalaro, mag-email sa support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Paki-edit ng iyong huling post sa halip na mag-post muli.',
                'locked' => 'Hindi makatugon sa isang naka-lock na thread.',
                'no_forum_access' => 'Ang pag-access sa hiniling na forum ay kinakailangan.',
                'no_permission' => 'Walang pahintulot na tumugon.',

                'user' => [
                    'require_login' => 'Paki-sign-in upang upang tumugon.',
                    'restricted' => "Hindi makatugon habang pinaghihigpitan.",
                    'silenced' => "Hindi makatugon habang pinatahimik.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Ang pag-access sa hiniling na forum ay kinakailangan.',
                'no_permission' => 'Walang pahintulot na gumawa ng bagong paksa.',
                'forum_closed' => 'Ang forum ay sarado at hindi mai-post.',
            ],

            'vote' => [
                'no_forum_access' => 'Ang pag-access sa hiniling na forum ay kinakailangan.',
                'over' => 'Ang botohan ay tapos na at hindi na maaaring pagbotohan.',
                'play_more' => 'Kailangan mo pang maglaro ng higit pa bago bumoto sa forum.',
                'voted' => 'Ang pagpapalit ng boto ay hindi pinapayagan.',

                'user' => [
                    'require_login' => 'Paki-sign-in upang bumoto.',
                    'restricted' => "Hindi makaboto habang pinaghihigpitan.",
                    'silenced' => "Hindi makaboto habang pinatahimik.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Ang pag-access sa hiniling na forum ay kinakailangan.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Hindi wastong cover ang natukoy.',
                'not_owner' => 'Tanging ang may-ari lang ang makakapag-edit ng cover.',
            ],
            'store' => [
                'forum_not_allowed' => 'Ang forum na ito ay hindi tumatanggap ng mga cover ng paksa.',
            ],
        ],

        'view' => [
            'admin_only' => 'Tanging admin lamang ang makakatingin sa forum na ito.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => 'Tanging ang may-ari ng iskor ang maaaring mag-pin ng iskor.',
            'too_many' => 'Nag-pin ng masyadong maraming mga iskor.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Naka-lock ang pahina ng user.',
                'not_owner' => 'Maaari lamang i-edit ang sariling pahina ng user.',
                'require_supporter_tag' => 'osu!supporter tag ay kinakailangan.',
            ],
        ],
    ],
];
