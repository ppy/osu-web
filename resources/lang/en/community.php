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
            'gift' => 'or gift supporter to other players',
            'instructions' => 'click the heart button to proceed to the osu!store',
        ],
        'why-support' => [
            'title' => 'Why should I support osu!? Where does the money go?',

            'team' => [
                'title' => 'Support the Team',
                'description' => 'A small team develops and runs osu!. Your support helps them to, you know... live.',
            ],
            'infra' => [
                'title' => 'Server Infrastructure',
                'description' => 'Contributions go towards the servers for running the website, multiplayer services, online leaderboards, etc.',
            ],
            'featured-artists' => [
                'title' => 'Featured Artists',
                'description' => 'With your support, we can approach even more awesome artists and license more great music for use in osu!',
                'link_text' => 'View the current roster &raquo;',
            ],
            'ads' => [
                'title' => 'Keep osu! self-sustaining',
                'description' => 'Your contributions help keep the game independent and completely free from ads and outside sponsors.',
            ],
            'tournaments' => [
                'title' => 'Official Tournaments',
                'description' => 'Help fund the running of (and the prizes for) the official osu! World Cup tournaments.',
                'link_text' => 'Explore tournaments &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Open Source Bounty Program',
                'description' => 'Support the community contributors that have given their time and effort to help make osu! better.',
                'link_text' => 'Find out more &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Cool! What perks do I get?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Gain quick and easy access to search for and download beatmaps without having to leave the game.',
            ],

            'friend_ranking' => [
                'title' => 'Friend Ranking',
                'description' => "See how you stack up against your friends on a beatmap's leaderboard, both in-game and on the website.",
            ],

            'country_ranking' => [
                'title' => 'Country Ranking',
                'description' => 'Conquer your country before you conquer the world.',
            ],

            'mod_filtering' => [
                'title' => 'Filter by Mods',
                'description' => 'Associate only with people who play HDHR? No problem!',
            ],

            'auto_downloads' => [
                'title' => 'Automatic Downloads',
                'description' => 'Beatmaps will automatically download in multiplayer games, while spectating others, or when clicking relevant links in chat!',
            ],

            'upload_more' => [
                'title' => 'Upload More',
                'description' => 'Additional pending beatmap slots (per ranked beatmap) up to a max of 10.',
            ],

            'early_access' => [
                'title' => 'Early Access',
                'description' => 'Gain early access to new releases with new features before they go public!<br/><br/>This includes early access to new features on the website too!',
            ],

            'customisation' => [
                'title' => 'Customisation',
                'description' => "Stand out by uploading a custom cover image or by creating a fully customizable 'me!' section within your user profile.",
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Filters',
                'description' => 'Filter beatmap searches by played and unplayed maps, or by rank achieved.',
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
                'description' => 'One free name change is included with your first supporter purchase.',
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
                'description' => 'The maximum number of beatmaps you can favourite is increased from :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'More Friends',
                'description' => 'The maximum number of friends you can have is increased from :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Upload More Beatmaps',
                'description' => 'How many non-ranked beatmaps you can have at once is calculated from a base value plus an additional bonus for each ranked beatmap you currently have (up to a limit).<br/><br/>Normally this is 4 plus 1 per ranked beatmap (up to 2). With supporter, this increases to 8 plus 1 per ranked beatmap (up to 12).',
            ],
            'friend_filtering' => [
                'title' => 'Friend Leaderboards',
                'description' => 'Compete with your friends and see how you rank up against them!*<br/><br/><small>* not yet available on new site, comingsoon(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Thanks for your support so far! You have contributed :dollars over :tags tag purchases!',
            'gifted' => "You have given away :giftedTags of your purchases as gifts (that's :giftedDollars worth), how generous!",
            'not_yet' => "You haven't ever had an osu!supporter tag :(",
            'valid_until' => 'Your current osu!supporter tag is valid until :date!',
            'was_valid_until' => 'Your osu!supporter tag was valid until :date.',
        ],
    ],
];
