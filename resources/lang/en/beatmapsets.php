<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'This beatmap is currently not available for download.',
        'parts-removed' => 'Portions of this beatmap have been removed at the request of the creator or a third-party rights holder.',
        'more-info' => 'Check here for more information.',
        'rule_violation' => 'Some assets contained within this map have been removed after being judged as not being suitable for use in osu!.',
    ],

    'cover' => [
        'deleted' => 'Deleted beatmap',
    ],

    'download' => [
        'limit_exceeded' => 'Slow down, play more.',
        'no_mirrors' => 'No download servers available.',
    ],

    'featured_artist_badge' => [
        'label' => 'Featured Artist',
    ],

    'index' => [
        'title' => 'Beatmaps Listing',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'no beatmaps',

        'download' => [
            'all' => 'download',
            'video' => 'download with video',
            'no_video' => 'download without video',
            'direct' => 'open in osu!direct',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => 'Probationary nominators cannot nominate multiple rulesets.',
        'full_nomination_required' => 'You must be a full nominator to perform the final nomination of a ruleset.',
        'hybrid_requires_modes' => 'A hybrid beatmap requires you to select at least one playmode to nominate for.',
        'incorrect_mode' => 'You do not have permission to nominate for mode: :mode',
        'invalid_limited_nomination' => 'This beatmap has invalid nominations and cannot be qualified in this state.',
        'invalid_ruleset' => 'This nomination has invalid rulesets.',
        'too_many' => 'Nomination requirement already fulfilled.',
        'too_many_non_main_ruleset' => 'Nomination requirement for non-main ruleset already fulfilled.',

        'dialog' => [
            'confirmation' => 'Are you sure you want to nominate this beatmap?',
            'different_nominator_warning' => 'Qualifying this beatmap with different nominators will reset its qualification queue position.',
            'header' => 'Nominate Beatmap',
            'hybrid_warning' => 'note: you may only nominate once, so please ensure that you are nominating for all game modes you intend to',
            'current_main_ruleset' => 'The main ruleset is currently: :ruleset',
            'which_modes' => 'Nominate for which modes?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicit',
    ],

    'show' => [
        'discussion' => 'Discussion',

        'admin' => [
            'full_size_cover' => 'View full size cover image',
        ],

        'deleted_banner' => [
            'title' => 'This beatmap has been deleted.',
            'message' => '(only moderators can see this)',
        ],

        'details' => [
            'by_artist' => 'by :artist',
            'favourite' => 'favourite this beatmap',
            'favourite_login' => 'sign in to favourite this beatmap',
            'logged-out' => 'you need to sign in before downloading any beatmaps!',
            'mapped_by' => 'mapped by :mapper',
            'mapped_by_guest' => 'guest difficulty by :mapper',
            'unfavourite' => 'unfavourite this beatmap',
            'updated_timeago' => 'last updated :timeago',

            'download' => [
                '_' => 'Download',
                'direct' => 'osu!direct',
                'no-video' => 'without Video',
                'video' => 'with Video',
            ],

            'login_required' => [
                'bottom' => 'to access more features',
                'top' => 'Sign In',
            ],
        ],

        'details_date' => [
            'approved' => 'approved :timeago',
            'loved' => 'loved :timeago',
            'qualified' => 'qualified :timeago',
            'ranked' => 'ranked :timeago',
            'submitted' => 'submitted :timeago',
            'updated' => 'last updated :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'You have too many favourited beatmaps! Please unfavourite some before trying again.',
        ],

        'hype' => [
            'action' => 'Hype this map if you enjoyed playing it to help it progress to <strong>Ranked</strong> status.',

            'current' => [
                '_' => 'This map is currently :status.',

                'status' => [
                    'pending' => 'pending',
                    'qualified' => 'qualified',
                    'wip' => 'work in progress',
                ],
            ],

            'disqualify' => [
                '_' => 'If you find an issue with this beatmap, please disqualify it :link.',
            ],

            'report' => [
                '_' => 'If you find an issue with this beatmap, please report it :link to alert the team.',
                'button' => 'Report Problem',
                'link' => 'here',
            ],
        ],

        'info' => [
            'description' => 'Description',
            'genre' => 'Genre',
            'language' => 'Language',
            'no_scores' => 'Data still being calculated...',
            'nominators' => 'Nominators',
            'nsfw' => 'Explicit content',
            'offset' => 'Online offset',
            'points-of-failure' => 'Points of Failure',
            'source' => 'Source',
            'storyboard' => 'This beatmap contains storyboard',
            'success-rate' => 'Success Rate',
            'video' => 'This beatmap contains video',
            'user_tags' => 'User Tags',
            'mapper_tags' => 'Mapper Tags',
        ],

        'nsfw_warning' => [
            'details' => 'This beatmap contains explicit, offensive, or disturbing content. Would you like to view it anyway?',
            'title' => 'Explicit Content',

            'buttons' => [
                'disable' => 'Disable warning',
                'listing' => 'Beatmap listing',
                'show' => 'Show',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'achieved :when',
            'country' => 'Country Ranking',
            'error' => 'Failed loading ranking',
            'friend' => 'Friend Ranking',
            'global' => 'Global Ranking',
            'supporter-link' => 'Click <a href=":link">here</a> to see all the fancy features that you get!',
            'supporter-only' => 'You need to be an osu!supporter to access the friend, country, or mod-specific rankings!',
            'team' => 'Team Ranking',
            'title' => 'Scoreboard',

            'headers' => [
                'accuracy' => 'Accuracy',
                'combo' => 'Max Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'pin' => 'Pin',
                'player' => 'Player',
                'pp' => 'pp',
                'rank' => 'Rank',
                'score' => 'Score',
                'score_total' => 'Total Score',
                'time' => 'Time',
            ],

            'no_scores' => [
                'country' => 'No one from your country has set a score on this map yet!',
                'friend' => 'None of your friends have set a score on this map yet!',
                'global' => 'No scores yet. Maybe you should try setting some?',
                'loading' => 'Loading scores...',
                'team' => 'No one from your team has set a score on this map yet!',
                'unranked' => 'Unranked beatmap.',
            ],
            'score' => [
                'first' => 'In the Lead',
                'own' => 'Your Best',
            ],
            'supporter_link' => [
                '_' => 'Click :here to see all the fancy features that you get!',
                'here' => 'here',
            ],
        ],

        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => 'Key Count',
            'drain' => 'HP Drain',
            'accuracy' => 'Accuracy',
            'ar' => 'Approach Rate',
            'stars' => 'Star Rating',
            'total_length' => 'Length (Drain length: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Circle Count',
            'count_sliders' => 'Slider Count',
            'offset' => 'Online offset: :offset',
            'user-rating' => 'User Rating',
            'rating-spread' => 'Rating Spread',
            'nominations' => 'Nominations',
            'playcount' => 'Playcount',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Qualified',
            'wip' => 'WIP',
            'pending' => 'Pending',
            'graveyard' => 'Graveyard',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Spotlight',
    ],
];
