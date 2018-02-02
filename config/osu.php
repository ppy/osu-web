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
    'beatmapset' => [
        'required_hype' => get_int(env('BEATMAPSET_REQUIRED_HYPE')) ?? 5,
        'user_daily_nominations' => get_int(env('BEATMAPSET_USER_DAILY_NOMINATIONS', 10)) ?? 10,
        'user_weekly_hype' => get_int(env('BEATMAPSET_USER_WEEKLY_HYPE')) ?? 3,
    ],
    'camo' => [
        'key' => env('CAMO_KEY'),
        'prefix' => env('CAMO_PREFIX', 'https://i.ppy.sh/'),
    ],
    'client' => [
        'user_agent' => env('CLIENT_USER_AGENT', 'osu!'),
    ],
    'elasticsearch' => [
        'prefix' => env('ES_INDEX_PREFIX'),
        'index' => [
            'wiki_pages' => env('ES_INDEX_PREFIX').'osu:wiki_pages_20171130',
        ],
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
    'git-sha' => env('GIT_SHA', 'unknown-version'),
    'mp-history' => [
        'event-count' => 500,
    ],
    'landing' => [
        'video_url' => env('LANDING_VIDEO_URL', 'https://assets.ppy.sh/media/landing.mp4'),
    ],
    'legacy' => [
        'shared_interop_secret' => env('SHARED_INTEROP_SECRET', ''),
    ],
    'search' => [
        'minimum_length' => get_int(env('SEARCH_MINIMUM_LENGTH', 2)),

        'max' => [
            'user' => 100,
        ],
    ],
    'support' => [
        'video_url' => env('SUPPORT_OSU_VIDEO_URL', 'https://assets.ppy.sh/media/osu-direct-demo.mp4'),
    ],
    'store' => [
        'delayed_shipping_order_threshold' => env('DELAYED_SHIPPING_ORDER_THRESHOLD', 100),
        'delayed_shipping_order_message' => env('DELAYED_SHIPPING_ORDER_MESSAGE'),
        'notice' => presence(str_replace('\n', "\n", env('STORE_NOTICE'))),
    ],
    'twitch_client_id' => env('TWITCH_CLIENT_ID'),
    'urls' => [
        'base' => 'https://osu.ppy.sh',
        'dev' => 'https://discord.gg/ppy',
        'installer' => 'https://m1.ppy.sh/r/osu!install.exe',
        'installer-mirror' => 'https://m2.ppy.sh/r/osu!install.exe',
        'osx' => 'https://osx.ppy.sh',
        'youtube-tutorial-playlist' => 'PLmWVQsxi34bMYwAawZtzuptfMmszUa_tl',
        'legacy-forum-thread-prefix' => '/forum/t/',
        'smilies' => '/forum/images/smilies',
        'support-the-game' => '/p/support#transactionarea',

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
            'inbox' => '/forum/ucp.php?i=pm&folder=inbox',
        ],
        'rankings' => [
            'charts' => '/p/chart',
            'country' => '/p/countryranking',
            'kudosu' => '/p/kudosu',
        ],
        'home' => [
            'news' => '/p/news',
        ],
        'help' => [
            'support' => 'http://help.ppy.sh/',
        ],
    ],
    'user' => [
        'user_page_forum_id' => intval(env('USER_PAGE_FORUM_ID', 70)),
        'verification_key_length_hex' => 8,
        'verification_key_tries_limit' => 8,
        'max_friends' => 250,
        'max_friends_supporter' => 500,
        'online_window' => intval(env('USER_ONLINE_WINDOW', 10)),
        'password_reset' => [
            'expires_hour' => 2,
            'key_length' => 8,
            'tries' => 8,
        ],
        'super_friendly' => array_map('intval', explode(' ', env('SUPER_FRIENDLY', '3'))),
    ],
    'changelog' => [
        'update_streams' => array_map('intval', explode(' ', env('UPDATE_STREAMS', '5 1'))),
        'featured_stream' => intval(env('FEATURED_UPDATE_STREAM', 5)),
        'recent_weeks' => intval(env('CHANGELOG_RECENT_WEEKS', 6)),
        'chart_days' => intval(env('CHANGELOG_CHART_DAYS', 7)),
        'build_history_interval' => intval(env('CHANGELOG_BUILD_HISTORY_INTERVAL', 30)),
    ],
];
