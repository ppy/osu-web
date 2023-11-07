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
        'beatmapset' => 'beatmapit',
        'build' => 'rakennuskerrat',
        'channel' => 'chat',
        'forum_topic' => 'foorumit',
        'news_post' => 'uutiset',
        'user' => 'profiili',
    ],

    'filters' => [
        '_' => 'kaikki',
        'user' => 'profiili',
        'beatmapset' => 'beatmapit',
        'forum_topic' => 'foorumi',
        'news_post' => 'uutiset',
        'build' => 'rakennukset',
        'channel' => 'chatti',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmappi',

            'beatmap_owner_change' => [
                '_' => 'Vieraan vaikeustaso',
                'beatmap_owner_change' => 'Omistat nyt vaikeustason ":beatmap" beatmapille ":title"',
                'beatmap_owner_change_compact' => 'Omistat nyt vaikeustason ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmap-keskustelut',
                'beatmapset_discussion_lock' => 'Keskustelu beatmapissa ":title" on lukittu',
                'beatmapset_discussion_lock_compact' => 'Keskustelu on lukittu',
                'beatmapset_discussion_post_new' => 'Uusi viesti beatmapissa ":title" käyttäjältä :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Uusi viesti beatmapissa ":title" käyttäjältä :username',
                'beatmapset_discussion_post_new_compact' => 'Uusi viesti käyttäjältä :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Uusi viesti käyttäjältä :username',
                'beatmapset_discussion_review_new' => 'Uusi arvostelu beatmapissa ":title" käyttäjältä :username sisältäen ongelmia: :problems, ehdotuksia: :suggestions, kehuja: :praises',
                'beatmapset_discussion_review_new_compact' => 'Uusi arvostelu käyttäjältä :username sisältäen ongelmia: :problems, ehdotuksia: :suggestions, kehuja: :praises',
                'beatmapset_discussion_unlock' => 'Keskustelun ":title" lukitus on avattu',
                'beatmapset_discussion_unlock_compact' => 'Keskustelu on avattu',
            ],

            'beatmapset_problem' => [
                '_' => 'Esihyväksytyn Beatmapin ongelma',
                'beatmapset_discussion_qualified_problem' => ':username ilmoitti kohteen ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => ':username ilmoitti kohteen ":title"',
                'beatmapset_discussion_qualified_problem_compact' => ':username ilmoitti kohteen: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => ':username:n Ilmiantama',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmapin tila muutettu',
                'beatmapset_disqualify' => '":title" on hylätty',
                'beatmapset_disqualify_compact' => 'Beatmappi hylättiin',
                'beatmapset_love' => '":title" ylennettiin rakastetuksi',
                'beatmapset_love_compact' => 'Beatmappi ylennettiin rakastetuksi',
                'beatmapset_nominate' => '":title" on hyväksytty',
                'beatmapset_nominate_compact' => 'Beatmap ehdollepantiin',
                'beatmapset_qualify' => '":title" sai riittävästi ehdollepanoja ja on siirtynyt rankkausjonoon',
                'beatmapset_qualify_compact' => 'Beatmap on siirtynyt ranking-jonoon',
                'beatmapset_rank' => '":title" on hyväksytty',
                'beatmapset_rank_compact' => 'Beatmap hyväksyttiin',
                'beatmapset_remove_from_loved' => '":title" poistettiin rakastetuista',
                'beatmapset_remove_from_loved_compact' => 'Beatmappi poistettiin rakastetuista',
                'beatmapset_reset_nominations' => '":title"n ehdollepanot on nollattu',
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
                    'channel_announcement_group' => 'Ilmoitus :username\'lta',
                ],
            ],

            'channel' => [
                '_' => 'Uusi viesti',

                'pm' => [
                    'channel_message' => ':username sanoo ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => ':username\'lta',
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

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Uusi beatmappi',

                'user_beatmapset_new' => 'Uusi beatmappi ":title" :username\'lta',
                'user_beatmapset_new_compact' => 'Uusi beatmap ":title"',
                'user_beatmapset_new_group' => 'Uusia beatmappeja :username\'lta',

                'user_beatmapset_revive' => ':username elvytti beatmapin ":title"',
                'user_beatmapset_revive_compact' => 'Beatmappi ":title" elvytetty',
            ],
        ],

        'user_achievement' => [
            '_' => 'Mitalit',

            'user_achievement_unlock' => [
                '_' => 'Uusi mitali',
                'user_achievement_unlock' => 'Ansaittu ":title"!',
                'user_achievement_unlock_compact' => 'Ansaittu ":title"!',
                'user_achievement_unlock_group' => 'Mitaleja saavutettu!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Olet nyt vieraana beatmapissa ":title"',
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
                'beatmapset_nominate' => '":title" on hyväksytty',
                'beatmapset_qualify' => '":title" sai riittävästi ehdollepanoja ja on siirtynyt rankkausjonoon',
                'beatmapset_rank' => '":title" on hyväksytty',
                'beatmapset_remove_from_loved' => '":title" poistettiin rakastetuista',
                'beatmapset_reset_nominations' => '":title"n ehdollepanot on nollattu',
            ],

            'comment' => [
                'comment_new' => 'Beatmapissa ":title" on uusia kommentteja',
            ],
        ],

        'channel' => [
            'announcement' => [
                'announce' => '":name" on saanut uuden ilmoituksen',
            ],

            'channel' => [
                'pm' => 'Olet saanut uuden viestin käyttäjältä :username',
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

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username on ansainnut uuden mitalin, ":title"!',
                'user_achievement_unlock_self' => 'Olet avannut uuden mitalin, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username on luonut uusia beatmappeja',
                'user_beatmapset_revive' => ':username on elvyttänyt beatmappeja',
            ],
        ],
    ],
];
