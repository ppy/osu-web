<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[deleted user]',

    'beatmapset_activities' => [
        'title' => ":user's Modding History",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Recently started discussions',
        ],

        'events' => [
            'title_recent' => 'Recent events',
        ],

        'posts' => [
            'title_recent' => 'Recent posts',
        ],

        'votes_received' => [
            'title_most' => 'Most upvoted by (last 3 months)',
        ],

        'votes_made' => [
            'title_most' => 'Most upvoted (last 3 months)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'You have blocked this user.',
        'blocked_count' => 'blocked users (:count)',
        'hide_profile' => 'Hide profile',
        'not_blocked' => 'That user is not blocked.',
        'show_profile' => 'Show profile',
        'too_many' => 'Block limit reached.',
        'button' => [
            'block' => 'Block',
            'unblock' => 'Unblock',
        ],
    ],

    'card' => [
        'loading' => 'Loading...',
        'send_message' => 'Send message',
    ],

    'disabled' => [
        'title' => 'Uh-oh! It looks like your account has been disabled.',
        'warning' => "In the case you have broken a rule, please note that there is generally a cool-down period of one month during which we will not consider any amnesty requests. After this period, you are free to contact us should you deem it necessary. Please note that creating new accounts after you have had one disabled will result in an <strong>extension of this one month cool-down</strong>. Please also note that for <strong>every account you create, you are further breaking rules</strong>. We highly suggest you don't go down this path!",

        'if_mistake' => [
            '_' => 'If you feel this is a mistake, you are welcome to contact us (via :email or by clicking the "?" in the bottom-right-hand corner of this page). Please note that we are always fully confident with our actions, as they are based on very solid data. We reserve the right to disregard your request should we feel you are being intentionally dishonest.',
            'email' => 'email',
        ],

        'reasons' => [
            'compromised' => 'Your account has deemed to be compromised. It may be disabled temporarily while its identity is confirmed.',
            'opening' => 'There are a number of reasons that can result in your account being disabled:',

            'tos' => [
                '_' => 'You have broken one or more of our :community_rules or :tos.',
                'community_rules' => 'community rules',
                'tos' => 'terms of service',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Members by game mode',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Your account hasn't been used in a long time.",
        ],
    ],

    'login' => [
        '_' => 'Sign in',
        'button' => 'Sign in',
        'button_posting' => 'Signing in...',
        'email_login_disabled' => 'Signing in with email is currently disabled. Please use username instead.',
        'failed' => 'Incorrect sign in',
        'forgot' => 'Forgotten your password?',
        'info' => 'Please sign in to continue',
        'invalid_captcha' => 'Too many failed login attempts, please complete the captcha and try again. (Refresh page if captcha is not visible)',
        'locked_ip' => 'your IP address is locked. Please wait a few minutes.',
        'password' => 'Password',
        'register' => "Don't have an osu! account? Make a new one",
        'remember' => 'Remember this computer',
        'title' => 'Please sign in to proceed',
        'username' => 'Username',

        'beta' => [
            'main' => 'Beta access is currently restricted to privileged users.',
            'small' => '(osu!supporters will get in soon)',
        ],
    ],

    'posts' => [
        'title' => ':username\'s posts',
    ],

    'anonymous' => [
        'login_link' => 'click to sign in',
        'login_text' => 'sign in',
        'username' => 'Guest',
        'error' => 'You need to be signed in to do this.',
    ],
    'logout_confirm' => 'Are you sure you want to sign out? :(',
    'report' => [
        'button_text' => 'Report',
        'comments' => 'Additional Comments',
        'placeholder' => 'Please provide any information you believe could be useful.',
        'reason' => 'Reason',
        'thanks' => 'Thanks for your report!',
        'title' => 'Report :username?',

        'actions' => [
            'send' => 'Send Report',
            'cancel' => 'Cancel',
        ],

        'options' => [
            'cheating' => 'Foul play / Cheating',
            'insults' => 'Insulting me / others',
            'spam' => 'Spamming',
            'unwanted_content' => 'Linking inappropriate content',
            'nonsense' => 'Nonsense',
            'other' => 'Other (type below)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Your account has been restricted!',
        'message' => 'While restricted, you will be unable to interact with other players and your scores will only be visible to you. This is usually the result of an automated process and will usually be lifted within 24 hours. If you wish to appeal your restriction, please <a href="mailto:accounts@ppy.sh">contact support</a>.',
    ],
    'show' => [
        'age' => ':age years old',
        'rank_summary' => ':username is rank :global worldwide and rank :local in :country.',
        'change_avatar' => 'change your avatar!',
        'first_members' => 'Here since the beginning',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Joined :date',
        'lastvisit' => 'Last seen :date',
        'lastvisit_online' => 'Currently online',
        'missingtext' => 'You might have made a typo! (or the user may have been banned)',
        'origin_country' => 'From :country',
        'previous_usernames' => 'formerly known as',
        'plays_with' => 'Plays with :devices',
        'title' => ":username's profile",

        'comments_count' => [
            '_' => 'Posted :link',
            'count' => ':count_delimited comment|:count_delimited comments',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Change Profile Cover',
                'defaults_info' => 'More cover options will be available in the future',
                'upload' => [
                    'broken_file' => 'Failed processing image. Verify uploaded image and try again.',
                    'button' => 'Upload image',
                    'dropzone' => 'Drop here to upload',
                    'dropzone_info' => 'You can also drop your image here to upload',
                    'size_info' => 'Cover size should be 2400x640',
                    'too_large' => 'Uploaded file is too large.',
                    'unsupported_format' => 'Unsupported format.',

                    'restriction_info' => [
                        '_' => 'Upload available for :link only',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'default game mode',
                'set' => 'set :mode as profile default game mode',
            ],
        ],

        'extra' => [
            'none' => 'none',
            'unranked' => 'No recent plays',

            'achievements' => [
                'achieved-on' => 'Achieved on :date',
                'locked' => 'Locked',
                'title' => 'Achievements',
            ],
            'beatmaps' => [
                'by_artist' => 'by :artist',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favourite Beatmaps',
                ],
                'graveyard' => [
                    'title' => 'Graveyarded Beatmaps',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved Beatmaps',
                ],
                'unranked' => [
                    'title' => 'Pending Beatmaps',
                ],
            ],
            'discussions' => [
                'title' => 'Discussions',
                'title_longer' => 'Recent Discussions',
                'show_more' => 'see more discussions',
            ],
            'events' => [
                'title' => 'Events',
                'title_longer' => 'Recent Events',
                'show_more' => 'see more events',
            ],
            'historical' => [
                'title' => 'Historical',

                'monthly_playcounts' => [
                    'title' => 'Play History',
                    'count_label' => 'Plays',
                ],
                'most_played' => [
                    'count' => 'times played',
                    'title' => 'Most Played Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'accuracy: :percentage',
                    'title' => 'Recent Plays (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Replays Watched History',
                    'count_label' => 'Replays Watched',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Recent Kudosu History',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu Earned',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "This user hasn't received any kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Received :amount from kudosu deny repeal of modding post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Denied :amount from modding post :post',
                        ],

                        'delete' => [
                            'reset' => 'Lost :amount from modding post deletion of :post',
                        ],

                        'restore' => [
                            'give' => 'Received :amount from modding post restoration of :post',
                        ],

                        'vote' => [
                            'give' => 'Received :amount from obtaining votes in modding post of :post',
                            'reset' => 'Lost :amount from losing votes in modding post of :post',
                        ],

                        'recalculate' => [
                            'give' => 'Received :amount from votes recalculation in modding post of :post',
                            'reset' => 'Lost :amount from votes recalculation in modding post of :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Received :amount from :giver for a post at :post',
                        'reset' => 'Kudosu reset by :giver for the post :post',
                        'revoke' => 'Denied kudosu by :giver for the post :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Based on how much of a contribution the user has made to beatmap moderation. See :link for more information.',
                    'link' => 'this page',
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "This user hasn't gotten any yet. ;_;",
                'recent' => 'Latest',
                'title' => 'Medals',
            ],
            'posts' => [
                'title' => 'Posts',
                'title_longer' => 'Recent Posts',
                'show_more' => 'see more posts',
            ],
            'recent_activity' => [
                'title' => 'Recent',
            ],
            'top_ranks' => [
                'download_replay' => 'Download Replay',
                'not_ranked' => 'Only ranked beatmaps award pp',
                'pp_weight' => 'weighted :percentage',
                'view_details' => 'View Details',
                'title' => 'Ranks',

                'best' => [
                    'title' => 'Best Performance',
                ],
                'first' => [
                    'title' => 'First Place Ranks',
                ],
            ],
            'votes' => [
                'given' => 'Votes Given (last 3 months)',
                'received' => 'Votes Received (last 3 months)',
                'title' => 'Votes',
                'title_longer' => 'Recent Votes',
                'vote_count' => ':count_delimited vote|:count_delimited votes',
            ],
            'account_standing' => [
                'title' => 'Account Standing',
                'bad_standing' => "<strong>:username's</strong> account is not in a good standing :(",
                'remaining_silence' => '<strong>:username</strong> will be able to speak again :duration.',

                'recent_infringements' => [
                    'title' => 'Recent Infringements',
                    'date' => 'date',
                    'action' => 'action',
                    'length' => 'length',
                    'length_permanent' => 'Permanent',
                    'description' => 'description',
                    'actor' => 'by :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Silence',
                        'note' => 'Note',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => 'Discord',
            'interests' => 'Interests',
            'location' => 'Current Location',
            'occupation' => 'Occupation',
            'twitter' => 'Twitter',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'They may have changed their username.',
            'reason_2' => 'The account may be temporarily unavailable due to security or abuse issues.',
            'reason_3' => 'You may have made a typo!',
            'reason_header' => 'There are a few possible reasons for this:',
            'title' => 'User not found! ;_;',
        ],
        'page' => [
            'button' => 'Edit profile page',
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',

            'restriction_info' => [
                '_' => 'You need to be an :link to unlock this feature.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Contributed :link',
            'count' => ':count_delimited forum post|:count_delimited forum posts',
        ],
        'rank' => [
            'country' => 'Country rank for :mode',
            'country_simple' => 'Country Ranking',
            'global' => 'Global rank for :mode',
            'global_simple' => 'Global Ranking',
        ],
        'stats' => [
            'hit_accuracy' => 'Hit Accuracy',
            'level' => 'Level :level',
            'level_progress' => 'Progress to next level',
            'maximum_combo' => 'Maximum Combo',
            'medals' => 'Medals',
            'play_count' => 'Play Count',
            'play_time' => 'Total Play Time',
            'ranked_score' => 'Ranked Score',
            'replays_watched_by_others' => 'Replays Watched by Others',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Total Hits',
            'total_score' => 'Total Score',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Ranked & Approved Beatmaps',
            'loved_beatmapset_count' => 'Loved Beatmaps',
            'unranked_beatmapset_count' => 'Pending Beatmaps',
            'graveyard_beatmapset_count' => 'Graveyarded Beatmaps',
        ],
    ],

    'silenced_banner' => [
        'title' => 'You are currently silenced.',
        'message' => 'Some actions may be unavailable.',
    ],

    'status' => [
        'all' => 'All',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'User created',
    ],
    'verify' => [
        'title' => 'Account Verification',
    ],

    'view_mode' => [
        'brick' => 'Brick view',
        'card' => 'Card view',
        'list' => 'List view',
    ],
];
