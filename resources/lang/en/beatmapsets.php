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
    ],

    'featured_artist_badge' => [
        'label' => 'Featured artist',
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
        'hybrid_requires_modes' => 'A hybrid beatmap requires you to select at least one playmode to nominate for.',
        'incorrect_mode' => 'You do not have permission to nominate for mode: :mode',
        'full_bn_required' => 'You must be a full nominator to perform this qualifying nomination.',
        'too_many' => 'Nomination requirement already fulfilled.',

        'dialog' => [
            'confirmation' => 'Are you sure you want to nominate this beatmap?',
            'header' => 'Nominate Beatmap',
            'hybrid_warning' => 'note: you may only nominate once, so please ensure that you are nominating for all game modes you intend to',
            'which_modes' => 'Nominate for which modes?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicit',
    ],

    'show' => [
        'discussion' => 'Discussion',

        'details' => [
            'by_artist' => 'by :artist',
            'favourite' => 'Favourite this beatmap',
            'favourite_login' => 'Sign in to favourite this beatmap',
            'logged-out' => 'You need to sign in before downloading any beatmaps!',
            'mapped_by' => 'mapped by :mapper',
            'unfavourite' => 'Unfavourite this beatmap',
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
            'nsfw' => 'Explicit content',
            'offset' => 'Online offset',
            'points-of-failure' => 'Points of Failure',
            'source' => 'Source',
            'storyboard' => 'This beatmap contains storyboard',
            'success-rate' => 'Success Rate',
            'tags' => 'Tags',
            'video' => 'This beatmap contains video',
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

        'loved_poll' => [
            'description_header' => "Captain's description by :author",
            'description_header_no_author' => "Captain's description",
            'header' => 'Project Loved voting',

            'info' => [
                'excluded_beatmaps' => 'Note that the following difficulties will not be moved to the Loved category, even if this poll passes:',
                'failed' => 'This beatmap recently failed voting in :project_loved. It will not be moved to :loved_category.',
                'in_progress' => 'This beatmap is up for voting in :project_loved! If it receives :percent approval from the community, it will be moved to :loved_category!',
                'passed' => 'This beatmap passed voting in :project_loved! It will be moved to :loved_category soon!',
                'passed_and_loved' => 'This beatmap passed voting in :project_loved!',

                'loved_category' => 'the Loved category',
                'project_loved' => 'Project Loved',
            ],

            'poll' => [
                'header' => 'Poll results',
                'header_question' => 'Should this beatmap be Loved?',
                'no' => 'No',
                'no_result' => 'No: :percent',
                'threshold' => 'Approval threshold: :percent',
                'view_topic' => 'View forum topic',
                'yes' => 'Yes',
                'yes_result' => 'Yes: :percent',
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
