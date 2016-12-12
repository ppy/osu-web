<?php

// osu config~
return [
    'avatar' => [
        'storage' => env('AVATAR_STORAGE', 'local-avatar'),
        'cache_purge_prefix' => env('AVATAR_CACHE_PURGE_PREFIX'),
    ],

    'bbcode' => [
        // this should be random or a config variable.
        // ...who am I kidding, this shouldn't even exist at all.
        'uid' => '1337',
    ],
    'beatmaps' => [
        'max' => 50,
        'max-scores' => 50,
    ],
    'beatmap_processor' => [
        'mirrors_to_use' => array_map('intval', explode(' ', env('BM_PROCESSOR_MIRRORS', '1'))),
        'thumbnailer' => env('BM_PROCESSOR_THUMBNAILER', 'http://localhost:4001'),
        'sentry' => env('BM_PROCESSOR_SENTRY'),
    ],
    'camo' => [
        'key' => env('CAMO_KEY'),
        'prefix' => env('CAMO_PREFIX', 'https://i.ppy.sh/'),
    ],
    'elasticsearch' => [
        'index' => env('ES_INDEX', 'osu'),
    ],
    'emails' => [
        'account' => 'accounts@ppy.sh',
    ],
    'forum' => [
        'admin_forum_id' => intval(env('ADMIN_FORUM_ID', 28)),
        'help_forum_ids' => array_map('intval', explode(' ', env('HELP_FORUM_IDS', '4 5 29 30 101'))),
        'double_post_time' => [
            'normal' => 72,
            'author' => 24,
        ],
        'feature_forum_id' => get_int(env('FEATURE_FORUM_ID')),

        'slack_watch' => [
            'forum_ids' => array_map('intval', explode(' ', env('SLACK_WATCH_FORUM_IDS', '5 29 101 4 30 2'))),
            'topic_ids' => array_map('intval', explode(' ', env('SLACK_WATCH_TOPIC_IDS', '259747'))),
        ],
    ],
    'mp-history' => [
        'event-count' => 500,
    ],
    'legacy' => [
        'shared_cookie_secret' => env('SHARED_COOKIE_SECRET', ''),
    ],
    'store' => [
        'delayed_shipping_order_threshold' => env('DELAYED_SHIPPING_ORDER_THRESHOLD', 100),
        'delayed_shipping_order_message' => env('DELAYED_SHIPPING_ORDER_MESSAGE'),
        'notice' => presence(str_replace('\n', "\n", env('STORE_NOTICE'))),
    ],
    'twitch_client_id' => env('TWITCH_CLIENT_ID'),
    'urls' => [
        'base' => 'https://osu.ppy.sh',
        'smilies' => '/forum/images/smilies',
        'support-the-game' => '/p/support#transactionarea',

        'legal' => [
            'dmca' => '/p/copyright',
            'tos' => '/p/terms',
        ],
        'social' => [
            'facebook' => 'https://facebook.com/osugame',
            'twitter' => '/p/twitter',
        ],
        'status' => [
            'osustatus' => 'https://twitter.com/osustatus',
            'server' => 'http://stat.ppy.sh/',
        ],
        'user' => [
            'kudosu' => '/wiki/Kudosu',
            'recover' => '/p/forgot-email',
            'rules' => '/wiki/Osu!:Rules',
            'signup' => '/p/register',
        ],
        'ranking' => [
            'overall' => '/p/pp',
             'charts' => '/p/chart',
            'country' => '/p/countryranking',
            'mapper' => '/p/kudosu',
        ],
        'home' => [
            'changelog' => '/p/changelog',
            'download' => '/p/download',
            'news' => '/p/news',
        ],
        'help' => [
            'wiki' => '/wiki/Main_Page',
            'faq' => '/wiki/FAQ',
            'support' => 'http://help.ppy.sh/',
        ],
    ],
    'user' => [
        'user_page_forum_id' => intval(env('USER_PAGE_FORUM_ID', 70)),
        'verification_key_length_hex' => 8,
        'verification_key_tries_limit' => 8,
    ],
];
