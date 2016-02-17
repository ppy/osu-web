<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'login' => [
        '_' => 'Login',
        'username' => 'Username',
        'password' => 'Password',
        'button' => 'Login',
        'remember' => 'Remember this computer',
        'title' => 'Please login to proceed',
        'failed' => 'Incorrect login',
        'register' => "Don't have an osu! account? Make a new one",
        'forgot' => 'Forgotten your password?',
        'beta' => [
            'main' => 'Beta access is currently restricted to privileged users.',
            'small' => '(supporters will get in soon)',
        ],

        'here' => 'here', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'anonymous' => [
        'login_link' => 'click to login',
        'username' => 'Guest',
    ],
    'logout_confirm' => 'Are you sure you want to log out? :(',
    'show' => [
        '404' => 'User not found! ;_;',
        'current_location' => 'Currently in :location.',
        'edit' => [
            'cover' => [
                'button' => 'Change Profile Cover',
                'defaults_info' => 'More cover options will be available in the future',
                'upload' => [
                    'broken_file' => 'Failed processing image. Verify uploaded image and try again.',
                    'button' => 'Upload image',
                    'dropzone' => 'Drop here to upload',
                    'dropzone_info' => 'You can also drop your image here to upload',
                    'restriction_info' => "Upload available for <a href='".config('osu.urls.support-the-game')."' target='_blank'>osu!supporters</a> only",
                    'size_info' => 'Cover size should be at 2700x500',
                    'too_large' => 'Uploaded file is too large.',
                    'unsupported_format' => 'Unsupported format.',
                ],
            ],
        ],
        'extra' => [
            'achievements' => [
                'title' => 'Achievements',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
            ],
            'historical' => [
                'empty' => 'No performance records. :(',
                'most_played' => [
                    'count' => 'times played',
                    'title' => 'Most Played Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'accuracy: :percentage',
                    'title' => 'Recent Plays',
                ],
                'title' => 'Historical',
            ],
            'performance' => [
                'title' => 'Performance',
            ],
            'kudosu' => [
                'available' => 'Kudosu Available',
                'available_info' => "Kudosu can be traded for kudosu stars, which will help your beatmap get more attention. This is the number of kudosu you haven't traded in yet.",
                'entry' => [
                    'empty' => "This user hasn't received any kudosu!",
                    'give' => 'Received <strong class="kudosu-entries__amount">:amount kudosu</strong> from :giver for a post at :post',
                    'revoke' => 'Denied kudosu by :giver for the post :post',
                ],
                'recent_entries' => 'Recent Kudosu History',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu Earned',
                'total_info' => 'Based on how much of a contribution the user has made to beatmap moderation. See <a href="'.config('osu.urls.user.kudosu').'">this page</a> for more information.',
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'title' => 'Medals',
            ],
            'recent_activities' => [
                'title' => 'Recent',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Best Performance',
                ],
                'empty' => 'No awesome performance records yet. :(',
                'first' => [
                    'title' => 'First Place Ranks',
                ],
                'pp' => ':amountpp',
                'title' => 'Ranks',
                'weighted_pp' => 'weighted: :pp (:percentage)',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
                'favourite' => [
                    'title' => 'Favourite Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved Beatmaps (:count)',
                ],
                'none' => 'None... yet.',
            ],
        ],
        'first_members' => 'here since the beginning',
        'is_supporter' => 'osu!supporter',
        'is_developer' => 'osu!developer',
        'lastvisit' => 'Last seen :date.',
        'joined_at' => 'joined :date',
        'more_achievements' => 'and :count more',
        'origin' => [
            'age' => ':age years old.',
            'country' => 'From :country.',
            'country_age' => ':age years old from :country.',
        ],
        'page' => [
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',
            'restriction_info' => "You need to be an <a href='".config('osu.urls.support-the-game')."' target='_blank'>osu!supporter</a> to unlock this feature.",
        ],
        'plays_with' => [
            '_' => 'Plays with',
            'keyboard' => 'Keyboard',
            'mouse' => 'Mouse',
            'tablet' => 'Tablet',
            'touch' => 'Touch Screen',
        ],
        'missingtext' => 'You might have made a typo! (or the user may have been banned)',
        'page_description' => 'osu! - Everything you ever wanted to know about :username!',
        'rank' => [
            'country' => 'Country rank for :mode',
            'global' => 'Global rank for :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Hit Accuracy',
            'level' => 'Level :level',
            'maximum_combo' => 'Maximum Combo',
            'play_count' => 'Play Count',
            'ranked_score' => 'Ranked Score',
            'replays_watched_by_others' => 'Replays Watched by Others',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Total Hits',
            'total_score' => 'Total Score',
        ],
        'title' => 'profile / :username',
    ],

];
