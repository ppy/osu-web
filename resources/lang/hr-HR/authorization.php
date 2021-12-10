<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '',
    'require_login' => '',
    'require_verification' => '',
    'restricted' => "",
    'silenced' => "",
    'unauthorized' => 'Zabranjen pristup.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => '',
            'has_reply' => 'Ne može se obrisati rasprava sa komentarima',
        ],
        'nominate' => [
            'exhausted' => 'Dostigli ste svoje dnevno ograničenje za nominiranje, molim vas pokušajte ponovo sutra.',
            'incorrect_state' => 'Greška u izvođenju tog zadatka, pokušajte osvježiti stranicu.',
            'owner' => "Ne može se nominirati vlastita beatmapa.",
            'set_metadata' => '',
        ],
        'resolve' => [
            'not_owner' => 'Samo začetnik rasprave i vlasnik beatmape mogu riješiti raspravu.',
        ],

        'store' => [
            'mapper_note_wrong_user' => '',
        ],

        'vote' => [
            'bot' => "",
            'limit_exceeded' => 'Molim vas sačekajte trenutak prije glasanja',
            'owner' => "Ne može se glasati na vlastitu raspravu.",
            'wrong_beatmapset_state' => 'Može se samo glasati na raspravama beatmapa u tijeku.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '',
            'resolved' => '',
            'system_generated' => '',
        ],

        'edit' => [
            'not_owner' => 'Samo objavljivač može urediti objavu.',
            'resolved' => '',
            'system_generated' => 'Automatski generirana objava se ne može uređivati.',
        ],

        'store' => [
            'beatmapset_locked' => '',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => '',
        ],
    ],

    'chat' => [
        'blocked' => '',
        'friends_only' => '',
        'moderated' => '',
        'no_access' => '',
        'restricted' => '',
        'silenced' => '',
    ],

    'comment' => [
        'update' => [
            'deleted' => "",
        ],
    ],

    'contest' => [
        'voting_over' => '',

        'entry' => [
            'limit_reached' => '',
            'over' => '',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => '',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => '',
                'locked' => '',
                'no_forum_access' => '',
                'not_owner' => '',
            ],

            'edit' => [
                'deleted' => '',
                'locked' => '',
                'no_forum_access' => '',
                'not_owner' => '',
                'topic_locked' => '',
            ],

            'store' => [
                'play_more' => '',
                'too_many_help_posts' => "", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '',
                'locked' => '',
                'no_forum_access' => '',
                'no_permission' => '',

                'user' => [
                    'require_login' => '',
                    'restricted' => "",
                    'silenced' => "",
                ],
            ],

            'store' => [
                'no_forum_access' => '',
                'no_permission' => '',
                'forum_closed' => '',
            ],

            'vote' => [
                'no_forum_access' => '',
                'over' => '',
                'play_more' => '',
                'voted' => '',

                'user' => [
                    'require_login' => '',
                    'restricted' => "",
                    'silenced' => "",
                ],
            ],

            'watch' => [
                'no_forum_access' => '',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '',
                'not_owner' => '',
            ],
            'store' => [
                'forum_not_allowed' => '',
            ],
        ],

        'view' => [
            'admin_only' => '',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => '',
                'not_owner' => '',
                'require_supporter_tag' => '',
            ],
        ],
    ],
];
