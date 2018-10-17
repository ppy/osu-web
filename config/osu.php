<?php

// osu config~
return [
    'avatar' => [
        'cache_purge_prefix' => env('AVATAR_CACHE_PURGE_PREFIX'),
        'default' => env('DEFAULT_AVATAR', '/images/layout/avatar-guest.png'),
        'storage' => env('AVATAR_STORAGE', 'local-avatar'),
    ],

    'assets' => [
        'base_url' => env('ASSETS_URL'),
        'mini_url' => env('MINI_ASSETS_URL'),
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
        'download_limit' => intval(env('BEATMAPSET_USER_DOWNLOAD_LIMIT_HOURLY', 10)),
        'download_limit_supporter' => intval(env('BEATMAPSET_USER_DOWNLOAD_LIMIT_HOURLY_SUPPORTER', 20)),
        'es_cache_duration' => get_float(env('BEATMAPSET_ES_CACHE_DURATION')) ?? 1.0,
        'required_hype' => get_int(env('BEATMAPSET_REQUIRED_HYPE')) ?? 5,
        'storage' => env('BEATMAPSET_STORAGE'),
        'user_daily_nominations' => get_int(env('BEATMAPSET_USER_DAILY_NOMINATIONS', 10)) ?? 10,
        'user_weekly_hype' => get_int(env('BEATMAPSET_USER_WEEKLY_HYPE')) ?? 3,
    ],
    'camo' => [
        'key' => env('CAMO_KEY'),
        'prefix' => env('CAMO_PREFIX', 'https://i.ppy.sh/'),
    ],
    'chat' => [
        'message_length_limit' => get_int(env('CHAT_MESSAGE_LENGTH_LIMIT')) ?? 100,
        'public_backlog_limit' => get_int(env('CHAT_PUBLIC_BACKLOG_LIMIT_HOURS')) ?? 24,
        'rate_limits' => [
            'public' => [
                'limit' => get_int(env('CHAT_PUBLIC_LIMIT')) ?? 1,
                'window' => get_int(env('CHAT_PUBLIC_WINDOW')) ?? 1,
            ],
            'private' => [
                'limit' => get_int(env('CHAT_PRIVATE_LIMIT')) ?? 1,
                'window' => get_int(env('CHAT_PRIVATE_WINDOW')) ?? 1,
            ],
        ],
    ],
    'client' => [
        'user_agent' => env('CLIENT_USER_AGENT', 'osu!'),
    ],
    'elasticsearch' => [
        'number_of_shards' => env('ES_DEFAULT_SHARDS', 1),
        'prefix' => env('ES_INDEX_PREFIX'),
        'index' => [
            'wiki_pages' => env('ES_INDEX_PREFIX').'osu:wiki_pages_20171130',
        ],
        'search_timeout' => env('ES_SEARCH_TIMEOUT', '5s'),
    ],
    'emails' => [
        'account' => 'accounts@ppy.sh',
    ],
    'forum' => [
        'admin_forum_id' => get_int(env('ADMIN_FORUM_ID')) ?? 28,
        'feature_forum_id' => get_int(env('FEATURE_FORUM_ID')),
        'help_forum_id' => get_int(env('HELP_FORUM_ID')) ?? 5,
        'initial_help_forum_ids' => array_map('intval', explode(' ', env('INITIAL_HELP_FORUM_IDS', '5 47 85'))),
        'issue_forum_ids' => array_map('intval', explode(' ', env('ISSUE_FORUM_IDS', '4 5 29 30 101'))),
        'minimum_plays' => get_int(env('FORUM_POST_MINIMUM_PLAYS')) ?? 200,

        'necropost_months' => 6,

        'double_post_time' => [
            'author' => 24,
            'normal' => 72,
        ],

        'slack_watch' => [
            'forum_ids' => array_map('intval', explode(' ', env('SLACK_WATCH_FORUM_IDS', '5 29 101 4 30 2'))),
            'topic_ids' => array_map('intval', explode(' ', env('SLACK_WATCH_TOPIC_IDS', '259747'))),
        ],
    ],
    'git-sha' => env('GIT_SHA', 'unknown-version'),
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
    'score_replays' => [
        'storage' => env('SCORE_REPLAYS_STORAGE', 'local'),
    ],
    'scores' => [
        'es_cache_duration' => get_float(env('SCORES_ES_CACHE_DURATION')) ?? 0.5,
    ],
    'site-switcher-js-hash' => env('SITE_SWITCHER_JS_HASH', ''),
    'static' => env('LEGACY_STATICS_HOST', ''),
    'support' => [
        'video_url' => env('SUPPORT_OSU_VIDEO_URL', 'https://assets.ppy.sh/media/osu-direct-demo.mp4'),
    ],
    'store' => [
        'delayed_shipping_order_threshold' => env('DELAYED_SHIPPING_ORDER_THRESHOLD', 100),
        'delayed_shipping_order_message' => env('DELAYED_SHIPPING_ORDER_MESSAGE'),
        'notice' => presence(str_replace('\n', "\n", env('STORE_NOTICE'))),
    ],
    'twitch_client_id' => env('TWITCH_CLIENT_ID'),
    'tournament_banner' => [
        'current' => [
            'id' => get_int(env('TOURNAMENT_BANNER_CURRENT_ID')),
            'prefix' => env('TOURNAMENT_BANNER_CURRENT_PREFIX'),
        ],
        'previous' => [
            'id' => get_int(env('TOURNAMENT_BANNER_PREVIOUS_ID')),
            'prefix' => env('TOURNAMENT_BANNER_PREVIOUS_PREFIX'),
            'winner_id' => env('TOURNAMENT_BANNER_PREVIOUS_WINNER_ID'),
        ],
    ],
    'urls' => [
        'base' => 'https://osu.ppy.sh',
        'dev' => 'https://discord.gg/ppy',
        'installer' => 'https://m1.ppy.sh/r/osu!install.exe',
        'installer-mirror' => 'https://m2.ppy.sh/r/osu!install.exe',
        'legacy-forum-thread-prefix' => '/forum/t/',
        'osx' => 'https://osx.ppy.sh',
        'server_status' => 'https://twitter.com/osustatus',
        'smilies' => '/forum/images/smilies',
        'source_code' => 'https://github.com/ppy',
        'support-the-game' => '/p/support#transactionarea',
        'youtube-tutorial-playlist' => 'PLmWVQsxi34bMYwAawZtzuptfMmszUa_tl',

        'social' => [
            'facebook' => 'https://facebook.com/osugame',
            'twitter' => '/help/wiki/Twitter',
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
        'ban_persist_days' => intval(env('BAN_PERSIST_DAYS', 14)),
    ],
    'changelog' => [
        'build_history_interval' => intval(env('CHANGELOG_BUILD_HISTORY_INTERVAL', 30)),
        'chart_days' => intval(env('CHANGELOG_CHART_DAYS', 7)),
        'featured_stream' => intval(env('FEATURED_UPDATE_STREAM', 5)),
        'github_token' => env('CHANGELOG_GITHUB_TOKEN'),
        'recent_weeks' => intval(env('CHANGELOG_RECENT_WEEKS', 6)),
        'update_streams' => array_map('intval', explode(' ', env('UPDATE_STREAMS', '5 1'))),
    ],
];
