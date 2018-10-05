<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'deleted' => '',

    'beatmapset_activities' => [
        'title' => "",

        'discussions' => [
            'title_recent' => '',
        ],

        'events' => [
            'title_recent' => '',
        ],

        'posts' => [
            'title_recent' => '',
        ],

        'votes_received' => [
            'title_most' => '',
        ],

        'votes_made' => [
            'title_most' => '',
        ],
    ],

    'blocks' => [
        'banner_text' => '',
        'blocked_count' => '',
        'hide_profile' => '',
        'not_blocked' => '',
        'show_profile' => '',
        'too_many' => '',
        'button' => [
            'block' => '',
            'unblock' => '',
        ],
    ],

    'card' => [
        'loading' => '',
        'send_message' => '',
    ],

    'login' => [
        '_' => '',
        'locked_ip' => '',
        'username' => '',
        'password' => '',
        'button' => '',
        'button_posting' => '',
        'remember' => '',
        'title' => '',
        'failed' => '',
        'register' => "",
        'forgot' => '',
        'beta' => [
            'main' => '',
            'small' => '',
        ],

        'here' => '', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => '',
    ],

    'signup' => [
        '_' => '',
    ],
    'anonymous' => [
        'login_link' => '',
        'login_text' => '',
        'username' => '',
        'error' => '',
    ],
    'logout_confirm' => '',
    'report' => [
        'button_text' => '',
        'comments' => '',
        'placeholder' => '',
        'reason' => '',
        'thanks' => '',
        'title' => '',

        'actions' => [
            'send' => '',
            'cancel' => '',
        ],

        'options' => [
            'cheating' => '',
            'insults' => '',
            'spam' => '',
            'unwanted_content' => '',
            'nonsense' => '',
            'other' => '',
        ],
    ],
    'restricted_banner' => [
        'title' => '',
        'message' => '',
    ],
    'show' => [
        'age' => '',
        'change_avatar' => '',
        'first_members' => '',
        'is_developer' => '',
        'is_supporter' => '',
        'joined_at' => '',
        'lastvisit' => '',
        'missingtext' => '',
        'origin_country' => '',
        'page_description' => '',
        'previous_usernames' => '',
        'plays_with' => '',
        'title' => "",

        'edit' => [
            'cover' => [
                'button' => '',
                'defaults_info' => '',
                'upload' => [
                    'broken_file' => '',
                    'button' => '',
                    'dropzone' => '',
                    'dropzone_info' => '',
                    'restriction_info' => "".route('store.products.show', 'supporter-tag')."",
                    'size_info' => '',
                    'too_large' => '',
                    'unsupported_format' => '',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => '',
                'set' => '',
            ],
        ],

        'extra' => [
            'followers' => '',
            'unranked' => '',

            'achievements' => [
                'title' => '',
                'achieved-on' => '',
            ],
            'beatmaps' => [
                'none' => '',
                'title' => '',

                'favourite' => [
                    'title' => '',
                ],
                'graveyard' => [
                    'title' => '',
                ],
                'loved' => [
                    'title' => '',
                ],
                'ranked_and_approved' => [
                    'title' => '',
                ],
                'unranked' => [
                    'title' => '',
                ],
            ],
            'historical' => [
                'empty' => '',
                'title' => '',

                'monthly_playcounts' => [
                    'title' => '',
                ],
                'most_played' => [
                    'count' => '',
                    'title' => '',
                ],
                'recent_plays' => [
                    'accuracy' => '',
                    'title' => '',
                ],
                'replays_watched_counts' => [
                    'title' => '',
                ],
            ],
            'kudosu' => [
                'available' => '',
                'available_info' => "",
                'recent_entries' => '',
                'title' => '',
                'total' => '',
                'total_info' => ''.osu_url('user.kudosu').'',

                'entry' => [
                    'amount' => '',
                    'empty' => "",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => '',
                        ],

                        'deny_kudosu' => [
                            'reset' => '',
                        ],

                        'delete' => [
                            'reset' => '',
                        ],

                        'restore' => [
                            'give' => '',
                        ],

                        'vote' => [
                            'give' => '',
                            'reset' => '',
                        ],

                        'recalculate' => [
                            'give' => '',
                            'reset' => '',
                        ],
                    ],

                    'forum_post' => [
                        'give' => '',
                        'reset' => '',
                        'revoke' => '',
                    ],
                ],
            ],
            'me' => [
                'title' => '',
            ],
            'medals' => [
                'empty' => "",
                'title' => '',
            ],
            'recent_activity' => [
                'title' => '',
            ],
            'top_ranks' => [
                'empty' => '',
                'not_ranked' => '',
                'pp' => '',
                'title' => '',
                'weighted_pp' => '',

                'best' => [
                    'title' => '',
                ],
                'first' => [
                    'title' => '',
                ],
            ],
            'account_standing' => [
                'title' => '',
                'bad_standing' => "",
                'remaining_silence' => '',

                'recent_infringements' => [
                    'title' => '',
                    'date' => '',
                    'action' => '',
                    'length' => '',
                    'length_permanent' => '',
                    'description' => '',
                    'actor' => '',

                    'actions' => [
                        'restriction' => '',
                        'silence' => '',
                        'note' => '',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => '',
            'interests' => '',
            'lastfm' => '',
            'location' => '',
            'occupation' => '',
            'skype' => '',
            'twitter' => '',
            'website' => '',
        ],
        'not_found' => [
            'reason_1' => '',
            'reason_2' => '',
            'reason_3' => '',
            'reason_header' => '',
            'title' => '',
        ],
        'page' => [
            'description' => '',
            'edit_big' => '',
            'placeholder' => '',
            'restriction_info' => "".route('store.products.show', 'supporter-tag')."",
        ],
        'post_count' => [
            '_' => '',
            'count' => '',
        ],
        'rank' => [
            'country' => '',
            'global' => '',
        ],
        'stats' => [
            'hit_accuracy' => '',
            'level' => '',
            'maximum_combo' => '',
            'play_count' => '',
            'play_time' => '',
            'ranked_score' => '',
            'replays_watched_by_others' => '',
            'score_ranks' => '',
            'total_hits' => '',
            'total_score' => '',
        ],
    ],
    'status' => [
        'online' => '',
        'offline' => '',
    ],
    'store' => [
        'saved' => '',
    ],
    'verify' => [
        'title' => '',
    ],
];
