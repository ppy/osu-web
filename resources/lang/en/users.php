<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
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
        'username' => 'Username',
        'password' => 'Password',
        'button' => 'Login',
        'remember' => 'Remember this computer',
        'title' => 'please login to continue',
        'failed' => 'incorrect login',
        'register' => "Don't have an account? Click :here!",
        'forgot' => 'Forgot your password? Reset it :here!',
        'beta' => [
            'main' => 'Beta access is currently restricted to privileged users.',
            'small' => '(supporters will get in soon)',
        ],

        'here' => 'here', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'anonymous' => [
        'login' => 'login',
        'username' => 'Guest',
    ],
    'logout' => [
        '_' => 'logout',
        'confirm' => 'Are you sure you want to log out? :(',
    ],

    'show' => [
        '404' => 'User not found! ;_;',
        'avatar' => ":username's avatar",
        'current_location' => 'Currently in :location.',
        'edit' => [
            'cover' => [
                'button' => 'Change Profile Cover',
                'defaults_info' => 'More cover options will be available in the future',
                'upload' => [
                    'button' => 'Upload image',
                    'restriction_info' => "Upload available for <a href='".config('osu.urls.support-the-game')."' target='_blank'>osu!supporters</a> only",
                    'size_info' => 'Cover size should be at 1800x500',
                    'too_large' => 'Uploaded file is too large.',
                    'unsupported_format' => 'Unsupported format.',
                ],
            ],
        ],
        'first_members' => 'here since the beginning',
        'is_supporter' => 'osu!supporter',
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
