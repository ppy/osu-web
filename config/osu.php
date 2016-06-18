<?php

// osu config~
return [
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
        'feature_forum_id' => get_int(env('FEATURE_FORUM_ID')),

        'slack_watch' => [
            'forum_ids' => array_map('intval', explode(' ', env('SLACK_WATCH_FORUM_IDS', '5 29 101 4 30 2'))),
            'topic_ids' => array_map('intval', explode(' ', env('SLACK_WATCH_TOPIC_IDS', '259747'))),
        ],
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
        'legal' => [
            'dmca' => 'https://osu.ppy.sh/p/copyright',
            'tos' => 'https://osu.ppy.sh/p/terms',
        ],
        'smilies' => 'https://osu.ppy.sh/forum/images/smilies',
        'social' => [
            'facebook' => 'https://facebook.com/osugame',
            'twitter' => 'https://osu.ppy.sh/p/twitter',
        ],
        'status' => [
            'osustatus' => 'https://twitter.com/osustatus',
            'server' => 'http://stat.ppy.sh/',
        ],
        'support-the-game' => 'https://osu.ppy.sh/p/support#transactionarea',
        'user' => [
            'kudosu' => 'https://osu.ppy.sh/wiki/Kudosu',
            'rules' => 'https://osu.ppy.sh/wiki/Osu!:Rules',
        ],
    ],
    'user' => [
        'user_page_forum_id' => intval(env('USER_PAGE_FORUM_ID', 70)),
    ],
];
