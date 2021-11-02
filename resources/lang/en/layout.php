<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Play next track automatically',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rhythm is just a *click* away!  With Ouendan/EBA, Taiko and original gameplay modes, as well as a fully functional level editor.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'beatmapset covers',
            'contest' => 'contest',
            'contests' => 'contests',
            'root' => 'console',
        ],

        'artists' => [
            'index' => 'listing',
        ],

        'changelog' => [
            'index' => 'listing',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => 'Sitemap',
        ],

        'store' => [
            'cart' => 'cart',
            'orders' => 'order history',
            'products' => 'products',
        ],

        'tournaments' => [
            'index' => 'listing',
        ],

        'users' => [
            'modding' => 'modding',
            'multiplayer' => 'multiplayer',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Close (Esc)',
        'fullscreen' => 'Toggle fullscreen',
        'zoom' => 'Zoom in/out',
        'previous' => 'Previous (arrow left)',
        'next' => 'Next (arrow right)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
        ],
        'community' => [
            '_' => 'community',
            'dev' => 'development',
        ],
        'help' => [
            '_' => 'help',
            'getAbuse' => 'report abuse',
            'getFaq' => 'faq',
            'getRules' => 'rules',
            'getSupport' => 'no, really, i need help!',
        ],
        'home' => [
            '_' => 'home',
            'team' => 'team',
        ],
        'rankings' => [
            '_' => 'rankings',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'store',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
            'home' => 'Home',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Beatmap Listing',
            'download' => 'Download osu!',
        ],
        'help' => [
            '_' => 'Help & Community',
            'faq' => 'Frequently Asked Questions',
            'forum' => 'Community Forums',
            'livestreams' => 'Live Streams',
            'report' => 'Report an Issue',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legal & Status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Privacy',
            'server_status' => 'Server Status',
            'source_code' => 'Source Code',
            'terms' => 'Terms',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Invalid request parameter',
            'description' => '',
        ],
        '404' => [
            'error' => 'Page Missing',
            'description' => "Sorry, but the page you requested isn't here!",
        ],
        '403' => [
            'error' => "You shouldn't be here.",
            'description' => 'You could try going back, though.',
        ],
        '401' => [
            'error' => "You shouldn't be here.",
            'description' => 'You could try going back, though. Or maybe signing in.',
        ],
        '405' => [
            'error' => 'Page Missing',
            'description' => "Sorry, but the page you requested isn't here!",
        ],
        '422' => [
            'error' => 'Invalid request parameter',
            'description' => '',
        ],
        '429' => [
            'error' => 'Rate limit exceeded',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh no! Something broke! ;_;',
            'description' => "We're automatically notified of every error.",
        ],
        'fatal' => [
            'error' => 'Oh no! Something broke (badly)! ;_;',
            'description' => "We're automatically notified of every error.",
        ],
        '503' => [
            'error' => 'Down for maintenance!',
            'description' => "Maintenance usually takes anywhere from 5 seconds to 10 minutes. If we're down for longer, see :link for more information.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Just in case, here's a code you can give to support!",
    ],

    'popup_login' => [
        'button' => 'sign in / register',

        'login' => [
            'forgot' => "I've forgotten my details",
            'password' => 'password',
            'title' => 'Sign In To Proceed',
            'username' => 'username',

            'error' => [
                'email' => "Username or email address doesn't exist",
                'password' => 'Incorrect password',
            ],
        ],

        'register' => [
            'download' => 'Download',
            'info' => 'Download osu! to create your own account!',
            'title' => "Don't have an account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Settings',
            'follows' => 'Watchlists',
            'friends' => 'Friends',
            'logout' => 'Sign Out',
            'profile' => 'My Profile',
        ],
    ],

    'popup_search' => [
        'initial' => 'Type to search!',
        'retry' => 'Search failed. Click to retry.',
    ],
];
