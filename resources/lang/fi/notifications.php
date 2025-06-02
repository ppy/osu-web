<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Kaikki ilmoitukset luettu!',
    'delete' => 'Poista :type',
    'loading' => 'Ladataan lukemattomia ilmoituksia...',
    'mark_read' => 'Tyhjennä :type',
    'none' => 'Ei ilmoituksia',
    'see_all' => 'näytä kaikki ilmoitukset',
    'see_channel' => 'siirry keskusteluun',
    'verifying' => 'Vahvista istuntosi nähdäksesi ilmoitukset',

    'action_type' => [
        '_' => 'kaikki',
        'beatmapset' => 'rytmikartat',
        'build' => 'rakennuskerrat',
        'channel' => 'chat',
        'forum_topic' => 'foorumit',
        'news_post' => 'uutiset',
        'team' => 'tiimi',
        'user' => 'profiili',
    ],

    'filters' => [
        '_' => 'kaikki',
        'beatmapset' => 'rytmikartat',
        'build' => 'rakennukset',
        'channel' => 'chatti',
        'forum_topic' => 'foorumi',
        'news_post' => 'uutiset',
        'team' => 'tiimi',
        'user' => 'profiili',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Rytmikartta',

            'beatmap_owner_change' => [
                '_' => 'Vieraan vaikeustaso',
                'beatmap_owner_change' => 'Omistat nyt vaikeustason ":beatmap" rytmikartassa ":title"',
                'beatmap_owner_change_compact' => 'Omistat nyt vaikeustason ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Rytmikartan keskustelu',
                'beatmapset_discussion_lock' => 'Keskustelu kohteessa ":title" on lukittu',
                'beatmapset_discussion_lock_compact' => 'Keskustelu on lukittu',
                'beatmapset_discussion_post_new' => 'Uusi viesti kohteessa ":title" käyttäjältä :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Uusi viesti kohteessa ":title" käyttäjältä :username',
                'beatmapset_discussion_post_new_compact' => 'Uusi viesti käyttäjältä :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Uusi viesti käyttäjältä :username',
                'beatmapset_discussion_review_new' => 'Uusi arvostelu rytmikartassa ":title" käyttäjältä :username sisältäen ongelmia: :problems, ehdotuksia: :suggestions, kehuja: :praises',
                'beatmapset_discussion_review_new_compact' => 'Uusi arvostelu käyttäjältä :username sisältäen ongelmia: :problems, ehdotuksia: :suggestions, kehuja: :praises',
                'beatmapset_discussion_unlock' => 'Keskustelun ":title" lukitus on avattu',
                'beatmapset_discussion_unlock_compact' => 'Keskustelu on avattu',

                'review_count' => [
                    'praises' => ':count_delimited kehu|:count_delimited kehua',
                    'problems' => ':count_delimited ongelma|:count_delimited ongelmaa',
                    'suggestions' => ':count_delimited ehdotus|:count_delimited ehdotusta',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Kelpuutetun rytmikartan ongelma',
                'beatmapset_discussion_qualified_problem' => ':username ilmiantoi kohteen ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => ':username ilmiantoi kohteen ":title"',
                'beatmapset_discussion_qualified_problem_compact' => ':username ilmiantoi kohteen: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Ilmiantanut: :username',
            ],

            'beatmapset_state' => [
                '_' => 'Rytmikartan tilanne muuttui',
                'beatmapset_disqualify' => '":title" on hylätty',
                'beatmapset_disqualify_compact' => 'Rytmikartta hylättiin',
                'beatmapset_love' => '":title" ylennettiin rakastetuksi',
                'beatmapset_love_compact' => 'Rytmikartta ylennettiin rakastetuksi',
                'beatmapset_nominate' => '":title" on asetettu ehdolle',
                'beatmapset_nominate_compact' => 'Rytmikartta asetettiin ehdolle',
                'beatmapset_qualify' => '":title" sai riittävästi ehdollepanoja ja on siirtynyt rankkausjonoon',
                'beatmapset_qualify_compact' => 'Rytmikartta on siirtynyt rankkausjonoon',
                'beatmapset_rank' => '":title" on hyväksytty',
                'beatmapset_rank_compact' => 'Rytmikartta rankattiin',
                'beatmapset_remove_from_loved' => '":title" poistettiin rakastetuista',
                'beatmapset_remove_from_loved_compact' => 'Rytmikartta poistettiin rakastetuista',
                'beatmapset_reset_nominations' => '":title": ehdollepano on nollattu',
                'beatmapset_reset_nominations_compact' => 'Ehdollepano nollattiin',
            ],

            'comment' => [
                '_' => 'Uusi kommentti',

                'comment_new' => ':username kommentoi ":content" ":title"ssa',
                'comment_new_compact' => ':username kommentoi ":content"',
                'comment_reply' => ':username vastasi ":content" ":title"ssa',
                'comment_reply_compact' => ':username vastasi ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chatti',

            'announcement' => [
                '_' => 'Uusi ilmoitus',

                'announce' => [
                    'channel_announcement' => ':username sanoo ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Tiedote käyttäjältä :username',
                ],
            ],

            'channel' => [
                '_' => 'Uusi viesti',

                'pm' => [
                    'channel_message' => ':username sanoo ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'käyttäjältä :username',
                ],
            ],

            'channel_team' => [
                '_' => '',

                'team' => [
                    'channel_team' => '',
                    'channel_team_compact' => '',
                    'channel_team_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => 'Muutosloki',

            'comment' => [
                '_' => 'Uusi kommentti',

                'comment_new' => ':username kommentoi ":content" ":title"ssa',
                'comment_new_compact' => ':username kommentoi ":content"',
                'comment_reply' => ':username vastasi ":content" ":title"ssa',
                'comment_reply_compact' => ':username vastasi ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Uutiset',

            'comment' => [
                '_' => 'Uusi kommentti',

                'comment_new' => ':username kommentoi ":content" ":title"ssa',
                'comment_new_compact' => ':username kommentoi":content"',
                'comment_reply' => ':username vastasi ":content" ":title"ssa',
                'comment_reply_compact' => ':username vastasi ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Foorumin aihe',

            'forum_topic_reply' => [
                '_' => 'Uusi foorumivastaus',
                'forum_topic_reply' => ':username vastasi foorumi aiheeseen ":title".',
                'forum_topic_reply_compact' => ':username vastasi',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Tiimiin liittymispyyntö',

                'team_application_accept' => "Olet nyt tiimin :title jäsen",
                'team_application_accept_compact' => "Olet nyt tiimin :title jäsen",

                'team_application_group' => '',

                'team_application_reject' => 'Sinun pyyntösi tiimiin :title on hylätty',
                'team_application_reject_compact' => 'Sinun pyyntösi tiimiin :title on hylätty',
                'team_application_store' => '',
                'team_application_store_compact' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Uusi rytmikartta',

                'user_beatmapset_new' => 'Uusi rytmikartta ":title" kartoittajalta :username',
                'user_beatmapset_new_compact' => 'Uusi rytmikartta ":title"',
                'user_beatmapset_new_group' => 'Uusia rytmikarttoja kartoittajalta :username',

                'user_beatmapset_revive' => ':username elvytti rytmikartan ":title"',
                'user_beatmapset_revive_compact' => 'Rytmikartta ":title" elvytetty',
            ],
        ],

        'user_achievement' => [
            '_' => 'Mitalit',

            'user_achievement_unlock' => [
                '_' => 'Uusi mitali',
                'user_achievement_unlock' => 'Ansaittu ":title"!',
                'user_achievement_unlock_compact' => 'Ansaittu ":title"!',
                'user_achievement_unlock_group' => 'Mitaleja ansaittu!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Olet nyt vieraana rytmikartassa ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Keskustelu aiheesta ":title" on lukittu',
                'beatmapset_discussion_post_new' => 'Keskustelu aiheesta ":title" on saanut uusia päivityksiä',
                'beatmapset_discussion_unlock' => 'Aiheen ":title" lukitus on avattu',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Uusi ongelma ilmoitettiin aiheessa ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" on hylätty',
                'beatmapset_love' => '":title" ylennettiin rakastetuksi',
                'beatmapset_nominate' => '":title" on asetettu ehdolle',
                'beatmapset_qualify' => '":title" sai riittävästi ehdollepanoja ja on siirtynyt rankkausjonoon',
                'beatmapset_rank' => '":title" on hyväksytty',
                'beatmapset_remove_from_loved' => '":title" poistettiin rakastetuista',
                'beatmapset_reset_nominations' => '":title": ehdollepano on nollattu',
            ],

            'comment' => [
                'comment_new' => 'Rytmikartassa ":title" on uusia kommentteja',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => '',
            ],
            'channel' => [
                'channel_message' => '',
            ],
            'channel_team' => [
                'channel_team' => '',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Muutosloki ":title" on saanut uusia kommentteja',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Uutinen ":title" on saanut uusia kommentteja',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Aihe ":title" on saanut uusia vastauksia',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "Olet nyt tiimin :title jäsen",
                'team_application_reject' => 'Pyyntösi tiimiin :title on hylätty',
                'team_application_store' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username on luonut uusia rytmikarttoja',
                'user_beatmapset_revive' => ':username on elvyttänyt rytmikarttoja',
            ],
        ],
    ],
];
