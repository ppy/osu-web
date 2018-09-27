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
    'deleted' => '[deleted user]',

    'beatmapset_activities' => [
        'title' => ":user's Modding History",

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
        'hide_profile' => 'hide profile',
        'not_blocked' => 'That user is not blocked.',
        'show_profile' => 'show profile',
        'too_many' => 'Block limit reached.',
        'button' => [
            'block' => 'block',
            'unblock' => 'unblock',
        ],
    ],

    'card' => [
        'loading' => 'Loading...',
        'send_message' => 'send message',
    ],

    'login' => [
        '_' => 'Sign in',
        'locked_ip' => 'your IP address is locked. Please wait a few minutes.',
        'username' => 'Username',
        'password' => 'Password',
        'button' => 'Sign in',
        'button_posting' => 'Signing in...',
        'remember' => 'Remember this computer',
        'title' => 'Please sign in to proceed',
        'failed' => 'Incorrect sign in',
        'register' => "Don't have an osu! account? Make a new one",
        'forgot' => 'Forgotten your password?',
        'beta' => [
            'main' => 'Beta access is currently restricted to privileged users.',
            'small' => '(osu!supporters will get in soon)',
        ],

        'here' => 'here', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username\'s posts',
    ],

    'signup' => [
        '_' => 'Register',
    ],
    'anonymous' => [
        'login_link' => 'click to sign in',
        'login_text' => 'sign in',
        'username' => 'Guest',
        'error' => 'You need to be signed in to do this.',
    ],
    'logout_confirm' => 'Are you sure you want to sign out? :(',
    'report' => [
        'button_text' => 'report',
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
        'change_avatar' => 'change your avatar!',
        'first_members' => 'Here since the beginning',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Joined :date',
        'lastvisit' => 'Last seen :date',
        'missingtext' => 'You might have made a typo! (or the user may have been banned)',
        'origin_country' => 'From :country',
        'page_description' => 'osu! - Everything you ever wanted to know about :username!',
        'previous_usernames' => 'formerly known as',
        'plays_with' => 'Plays with :devices',
        'title' => ":username's profile",

        'edit' => [
            'cover' => [
                'button' => 'Change Profile Cover',
                'defaults_info' => 'More cover options will be available in the future',
                'upload' => [
                    'broken_file' => 'Failed processing image. Verify uploaded image and try again.',
                    'button' => 'Upload image',
                    'dropzone' => 'Drop here to upload',
                    'dropzone_info' => 'You can also drop your image here to upload',
                    'restriction_info' => "Upload available for <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a> only",
                    'size_info' => 'Cover size should be 2000x700',
                    'too_large' => 'Uploaded file is too large.',
                    'unsupported_format' => 'Unsupported format.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'default game mode',
                'set' => 'set :mode as profile default game mode',
            ],
        ],

        'extra' => [
            'followers' => '1 follower|:count followers',
            'unranked' => 'No recent plays',

            'achievements' => [
                'title' => 'Achievements',
                'achieved-on' => 'Achieved on :date',
            ],
            'beatmaps' => [
                'none' => 'None... yet.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favourite Beatmaps (:count)',
                ],
                'graveyard' => [
                    'title' => 'Graveyarded Beatmaps (:count)',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved Beatmaps (:count)',
                ],
                'unranked' => [
                    'title' => 'Pending Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'No performance records. :(',
                'title' => 'Historical',

                'monthly_playcounts' => [
                    'title' => 'Play History',
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
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Available',
                'available_info' => "Kudosu can be traded for kudosu stars, which will help your beatmap get more attention. This is the number of kudosu you haven't traded in yet.",
                'recent_entries' => 'Recent Kudosu History',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu Earned',
                'total_info' => 'Based on how much of a contribution the user has made to beatmap moderation. See <a href="'.osu_url('user.kudosu').'">this page</a> for more information.',

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
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "This user hasn't gotten any yet. ;_;",
                'title' => 'Medals',
            ],
            'recent_activity' => [
                'title' => 'Recent',
            ],
            'top_ranks' => [
                'download_replay' => 'Download Replay',
                'empty' => 'No awesome performance records yet. :(',
                'not_ranked' => 'Only ranked beatmaps give out pp.',
                'pp' => ':amountpp',
                'title' => 'Ranks',
                'weighted_pp' => 'weighted: :pp (:percentage)',

                'best' => [
                    'title' => 'Best Performance',
                ],
                'first' => [
                    'title' => 'First Place Ranks',
                ],
            ],
            'account_standing' => [
                'title' => 'Account Standing',
                'bad_standing' => "<strong>:username's</strong> account is not in a good standing :(",
                'remaining_silence' => '<strong>:username</strong> will be able to speak again in :duration.',

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
            'lastfm' => 'Last.fm',
            'location' => 'Current Location',
            'occupation' => 'Occupation',
            'skype' => 'Skype',
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
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',
            'restriction_info' => "You need to be an <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> to unlock this feature.",
        ],
        'post_count' => [
            '_' => 'Contributed :link',
            'count' => ':count forum post|:count forum posts',
        ],
        'rank' => [
            'country' => 'Country rank for :mode',
            'global' => 'Global rank for :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Hit Accuracy',
            'level' => 'Level :level',
            'maximum_combo' => 'Maximum Combo',
            'play_count' => 'Play Count',
            'play_time' => 'Total Play Time',
            'ranked_score' => 'Ranked Score',
            'replays_watched_by_others' => 'Replays Watched by Others',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Total Hits',
            'total_score' => 'Total Score',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'User created',
    ],
    'verify' => [
        'title' => 'Account Verification',
    ],
];
