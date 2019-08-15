<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'support' => [
        'convinced' => [
            'title' => 'I\'m convinced! :D',
            'support' => 'support osu!',
            'gift' => 'or gift support to other players',
            'instructions' => 'click the heart button to proceed to the osu!store',
        ],
        'money_goes_where' => [
            'title' => 'Why should I support osu!? Where does the money go?',
            'blocks' => [
                'team' => [
                    'title' => 'Support the Team',
                    'body' => 'A small team develops and runs osu!. Your support helps them, you know... live.',
                ],
                'infra' => [
                    'title' => 'Server Infrastructure',
                    'body' => 'Contributions go towards servers for running the website, multiplayer services, online leaderboards, etc.',
                ],
                'featured-artists' => [
                    'title' => 'Featured Artists',
                    'body' => 'With your support, we can approach even more awesome artists and license great music for use in osu!',
                ],
                'ads' => [
                    'title' => 'Keep osu! self-sustaining',
                    'body' => 'Your contributions help keep the game independent and completely free from ads and outside sponsors.',
                ],
                'tournaments' => [
                    'title' => 'Official Tournaments',
                    'body' => 'Help fund the running of, and the prizes for, the official osu! World Cup tournaments.',
                ],
                'bounty-program' => [
                    'title' => 'Open Source Bounty Program',
                    'body' => 'Support community contributors that have given their time and effort to help make osu! better.',
                ],
            ],
        ],
        'perks' => [
            'title' => 'Cool, but do I get any perks?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Quick and easy access to searching and downloading of beatmaps without leaving the game.',
            ],

            'auto_downloads' => [
                'title' => 'Auto Downloads',
                'description' => 'Automatic downloads when playing multiplayer, spectating others, or clicking links in chat!',
            ],

            'upload_more' => [
                'title' => 'Upload More',
                'description' => 'Additional pending beatmap slots (per ranked beatmap) up to a max of 10.',
            ],

            'early_access' => [
                'title' => 'Early Access',
                'description' => 'Access to early releases, where you can try new features before they go public!',
            ],

            'customisation' => [
                'title' => 'Customisation',
                'description' => 'Customise your profile by adding a fully customisable user page.',
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Filters',
                'description' => 'Filter beatmap searches by played and unplayed maps and rank achieved (if any).',
            ],

            'yellow_fellow' => [
                'title' => 'Yellow Fellow',
                'description' => 'Be recognised in-game with your new bright yellow chat username colour.',
            ],

            'speedy_downloads' => [
                'title' => 'Speedy Downloads',
                'description' => 'More lenient download restrictions, especially when using osu!direct.',
            ],

            'change_username' => [
                'title' => 'Change Username',
                'description' => 'The ability to change your username without additional costs. (once max)',
            ],

            'skinnables' => [
                'title' => 'Skinnables',
                'description' => 'Extra in-game skinnables, like the main menu background.',
            ],

            'feature_votes' => [
                'title' => 'Feature Votes',
                'description' => 'Votes for feature requests. (2 per month)',
            ],

            'sort_options' => [
                'title' => 'Sort Options',
                'description' => 'The ability to view beatmap country / friend / mod-specific rankings in-game.',
            ],

            'more_favourites' => [
                'title' => 'More Favourites',
                'description' => 'The maximum number of beatmaps you can favourite is increased from 99 &rarr; 1024',
            ],
            'more_friends' => [
                'title' => 'More Friends',
                'description' => 'The maximum number of friends you can have is increased from 250 &rarr; 500',
            ],
            'more_beatmaps' => [
                'title' => 'Upload More Beatmaps',
                'description' => 'How many non-ranked beatmaps you can have at once is calculated from a base value plus an additional bonus for each ranked beatmap you currently have (up to a limit).<br/><br/>Normally this is 4 plus 1 per ranked beatmap (up to 2). With supporter, this increases to 8 plus 1 per ranked beatmap (up to 12).',
            ],
            'friend_filtering' => [
                'title' => 'Friend Leaderboards',
                'description' => 'Compete with your friends and see how you rank up against them!*<br/><br/><small>* not yet available on new site, comingsoonlol(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Thanks for your support so far! You have contributed a total of :dollars over :tags tag purchases!',
            'gifted' => ':giftedTags of your tag purchases were gifted (for a total of :giftedDollars gifted), how generous!',
            'not_yet' => "You don't have an osu!supporter tag yet :(",
            'title' => 'Current osu!supporter status',
            'valid_until' => 'Your current osu!supporter tag is valid until :date!',
            'was_valid_until' => 'Your osu!supporter tag was valid until :date.',
        ],
    ],
];
