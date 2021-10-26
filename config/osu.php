<?php

// osu config~
return [
    'achievement' => [
        'icon_prefix' => env('USER_ACHIEVEMENT_ICON_PREFIX', 'https://assets.ppy.sh/user-achievements/'),
    ],

    'api' => [
        // changing the throttle rate doesn't reset any existing timers,
        // changing the prefix key is the only way to invalidate them.
        'throttle' => [
            'global' => env('API_THROTTLE_GLOBAL', '1200,1,api'),
            'scores_download' => env('API_THROTTLE_SCORES_DOWNLOAD', '10,1,api-scores-download'),
        ],
    ],

    'avatar' => [
        'cache_purge_prefix' => env('AVATAR_CACHE_PURGE_PREFIX'),
        'default' => env('DEFAULT_AVATAR', env('APP_URL', 'http://localhost').'/images/layout/avatar-guest.png'),
        'storage' => env('AVATAR_STORAGE', 'local-avatar'),
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
        'discussion_kudosu_per_user' => get_int(env('BEATMAPSET_DISCUSSION_KUDOSU_PER_USER')) ?? 10,
        'discussion_review_max_blocks' => get_int(env('BEATMAPSET_DISCUSSION_REVIEW_MAXIMUM_BLOCKS', 10)),
        'discussion_review_min_issues' => get_int(env('BEATMAPSET_DISCUSSION_REVIEW_MINIMUM_ISSUES', 1)),
        'download_limit' => intval(env('BEATMAPSET_USER_DOWNLOAD_LIMIT_HOURLY', 10)),
        'download_limit_supporter' => intval(env('BEATMAPSET_USER_DOWNLOAD_LIMIT_HOURLY_SUPPORTER', 20)),
        'es_cache_duration' => 60 * (get_float(env('BEATMAPSET_ES_CACHE_DURATION')) ?? 1.0), // in minutes, converted to seconds
        'favourite_limit' => intval(env('BEATMAPSET_USER_FAVOURITE_LIMIT', 100)),
        'favourite_limit_supporter' => intval(env('BEATMAPSET_USER_FAVOURITE_LIMIT_SUPPORTER', 1000)),
        'guest_advanced_search' => get_bool(env('BEATMAPSET_GUEST_ADVANCED_SEARCH')) ?? false,
        'minimum_days_for_rank' => get_int(env('BEATMAPSET_MINIMUM_DAYS_FOR_RANK')) ?? 7,
        'rank_per_day' => get_int(env('BEATMAPSET_RANK_PER_DAY')) ?? 8,
        'rank_per_run' => get_int(env('BEATMAPSET_RANK_PER_RUN')) ?? 2,
        'required_hype' => get_int(env('BEATMAPSET_REQUIRED_HYPE')) ?? 5,
        'required_nominations' => get_int(env('BEATMAPSET_REQUIRED_NOMINATIONS')) ?? 2,
        'required_nominations_hybrid' => get_int(env('BEATMAPSET_REQUIRED_NOMINATIONS_HYBRID')) ?? 2,
        'upload_allowed' => get_int(env('BEATMAPSET_UPLOAD_ALLOWED')) ?? 4,
        'upload_allowed_supporter' => get_int(env('BEATMAPSET_UPLOAD_ALLOWED_SUPPORTER')) ?? 8,
        'upload_bonus_per_ranked' => get_int(env('BEATMAPSET_UPLOAD_BONUS_PER_RANKED')) ?? 1,
        'upload_bonus_per_ranked_max' => get_int(env('BEATMAPSET_UPLOAD_BONUS_PER_RANKED_MAX')) ?? 2,
        'upload_bonus_per_ranked_max_supporter' => get_int(env('BEATMAPSET_UPLOAD_BONUS_PER_RANKED_MAX_SUPPORTER')) ?? 12,
        'upload_bonus_per_ranked_supporter' => get_int(env('BEATMAPSET_UPLOAD_BONUS_PER_RANKED_SUPPORTER')) ?? 1,
        'user_daily_nominations' => get_int(env('BEATMAPSET_USER_DAILY_NOMINATIONS', 10)) ?? 10,
        'user_weekly_hype' => get_int(env('BEATMAPSET_USER_WEEKLY_HYPE')) ?? 3,
    ],
    'camo' => [
        'key' => presence(env('CAMO_KEY')),
        'prefix' => env('CAMO_PREFIX', 'https://i.ppy.sh/'),
    ],
    'chat' => [
        'channel_limit' => get_int(env('CHAT_CHANNEL_LIMIT')) ?? 10000,
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
        'check_version' => get_bool(env('CLIENT_CHECK_VERSION')) ?? true,
        'user_agent' => env('CLIENT_USER_AGENT', 'osu!'),
    ],
    'elasticsearch' => [
        'prefix' => env('ES_INDEX_PREFIX'),
        'search_timeout' => env('ES_SEARCH_TIMEOUT', '5s'),
    ],
    'emails' => [
        'account' => 'accounts@ppy.sh',
    ],
    'forum' => [
        'admin_forum_id' => get_int(env('ADMIN_FORUM_ID')) ?? 28,
        'double_post_allowed_forum_ids' => array_map('intval', explode(' ', env('DOUBLE_POST_ALLOWED_FORUM_IDS', '52 68 84 114'))),
        'feature_forum_id' => get_int(env('FEATURE_FORUM_ID')) ?? 4,
        'feature_topic_small_star_min' => get_int(env('FEATURE_TOPIC_SMALL_STAR_MIN')) ?? 1000,
        'help_forum_id' => get_int(env('HELP_FORUM_ID')) ?? 5,
        'initial_help_forum_ids' => array_map('intval', explode(' ', env('INITIAL_HELP_FORUM_IDS', '5 47 85'))),
        'issue_forum_ids' => array_map('intval', explode(' ', env('ISSUE_FORUM_IDS', '4 5 29 30 101'))),
        'max_post_length' => get_int(env('FORUM_POST_MAX_LENGTH')) ?? 60000,
        'minimum_plays' => get_int(env('FORUM_POST_MINIMUM_PLAYS')) ?? 200,
        'necropost_months' => 6,
        'poll_edit_hours' => get_int(env('FORUM_POLL_EDIT_HOURS')) ?? 1,

        'double_post_time' => [
            'author' => 24,
            'normal' => 72,
        ],
    ],
    'git-sha' => presence(env('GIT_SHA'))
        ?? (file_exists(__DIR__.'/../version') ? trim(file_get_contents(__DIR__.'/../version')) : null)
        ?? 'unknown-version',
    'is_development_deploy' => get_bool(env('IS_DEVELOPMENT_DEPLOY')) ?? true,
    'landing' => [
        'video_url' => env('LANDING_VIDEO_URL', 'https://assets.ppy.sh/media/landing.mp4'),
    ],
    'legacy' => [
        'bancho_bot_user_id' => get_int(env('BANCHO_BOT_USER_ID')) ?? 3,
        'shared_interop_secret' => env('SHARED_INTEROP_SECRET', ''),
    ],
    'multiplayer' => [
        'max_attempts_limit' => get_int(env('MULTIPLAYER_MAX_ATTEMPTS_LIMIT')) ?? 128,
    ],
    'notification' => [
        'endpoint' => presence(env('NOTIFICATION_ENDPOINT'), '/home/notifications/feed'),
        'queue_name' => presence(env('NOTIFICATION_QUEUE'), 'notification'),

        'cleanup' => [
            'keep_days' => get_int(env('NOTIFICATION_CLEANUP_KEEP_DAYS')) ?? 180,
            'max_delete_per_run' => get_int(env('NOTIFICATION_CLEANUP_MAX_DELETE')) ?? 50000,
        ],
    ],
    'oauth' => [
        'retain_expired_tokens_days' => abs(get_int(env('OAUTH_RETAIN_EXPIRED_TOKENS_DAYS'))) ?? 30,
        'max_user_clients' => get_int(env('OAUTH_MAX_USER_CLIENTS')) ?? 1,
    ],
    'octane' => [
        'local_cache_reset_requests' => get_int(env('OCTANE_LOCAL_CACHE_RESET_REQUESTS')) ?? 100,
    ],
    'pagination' => [
        'max_count' => get_int(env('PAGINATION_MAX_COUNT')) ?? 10000,
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
        'es_cache_duration' => 60 * (get_float(env('SCORES_ES_CACHE_DURATION')) ?? 0.5), // in minutes, converted to seconds
        'rank_cache' => [
            'local_server' => get_bool(env('SCORES_RANK_CACHE_LOCAL_SERVER')) ?? false,
            'min_users' => get_int(env('SCORES_RANK_CACHE_MIN_USERS')) ?? 35000,
            'server_url' => presence(env('SCORES_RANK_CACHE_SERVER_URL')),
            'timeout' => get_int(env('SCORES_RANK_CACHE_TIMEOUT')) ?? 10,
        ],
    ],

    'seasonal' => [
        'contest_id' => get_int(env('SEASONAL_CONTEST_ID')),
        'ends_at' => env('SEASONAL_ENDS_AT'),
    ],

    'store' => [
        'notice' => presence(str_replace('\n', "\n", env('STORE_NOTICE'))),
    ],
    'twitch_client_id' => env('TWITCH_CLIENT_ID'),
    'twitch_client_secret' => env('TWITCH_CLIENT_SECRET'),
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
        'bounty-form' => env('OS_BOUNTY_URL'),
        'dev' => 'https://discord.gg/ppy',
        'installer' => 'https://m1.ppy.sh/r/osu!install.exe',
        'installer-mirror' => 'https://m2.ppy.sh/r/osu!install.exe',
        'osx' => 'https://osx.ppy.sh',
        'server_status' => 'https://twitter.com/osustatus',
        'smilies' => '/forum/images/smilies',
        'source_code' => 'https://github.com/ppy',
        'youtube-tutorial-playlist' => 'PLmWVQsxi34bMYwAawZtzuptfMmszUa_tl',

        'social' => [
            'twitter' => '/wiki/Twitter',
        ],
        'user' => [
            'recover' => '/p/forgot-email',
            'rules' => '/wiki/Osu!:Rules',
        ],
        'rankings' => [
            'kudosu' => '/p/kudosu',
        ],
        'testflight' => [
            'public' => env('TESTFLIGHT_LINK'),
            'supporter' => env('TESTFLIGHT_LINK_SUPPORTER'),
        ],
    ],
    'user' => [
        'allow_email_login' => get_bool(env('USER_ALLOW_EMAIL_LOGIN')) ?? true,
        'allow_registration' => get_bool(env('ALLOW_REGISTRATION')) ?? true,
        'allowed_rename_groups' => explode(' ', env('USER_ALLOWED_RENAME_GROUPS', 'default')),
        'bypass_verification' => get_bool(env('USER_BYPASS_VERIFICATION')) ?? false,
        'inactive_days_verification' => get_int(env('USER_INACTIVE_DAYS_VERIFICATION')) ?? 180,
        'min_plays_for_posting' => get_int(env('USER_MIN_PLAYS_FOR_POSTING')) ?? 10,
        'min_plays_allow_verified_bypass' => get_bool(env('USER_MIN_PLAYS_ALLOW_VERIFIED_BYPASS')) ?? true,
        'post_action_verification' => get_bool(env('USER_POST_ACTION_VERIFICATION')) ?? true,
        'user_page_forum_id' => intval(env('USER_PAGE_FORUM_ID', 70)),
        'verification_key_length_hex' => 8,
        'verification_key_tries_limit' => 8,
        'max_friends' => 250,
        'max_friends_supporter' => 500,
        'max_login_attempts' => get_int(env('USER_MAX_LOGIN_ATTEMPTS')) ?? 10,
        'max_multiplayer_rooms' => get_int(env('USER_MAX_MULTIPLAYER_ROOMS')) ?? 1,
        'max_multiplayer_rooms_supporter' => get_int(env('USER_MAX_MULTIPLAYER_ROOMS_SUPPORTER')) ?? 5,
        'online_window' => intval(env('USER_ONLINE_WINDOW', 10)),
        'password_reset' => [
            'expires_hour' => 2,
            'key_length' => 8,
            'tries' => 8,
        ],
        'super_friendly' => array_map('intval', explode(' ', env('SUPER_FRIENDLY', '3'))),
        'ban_persist_days' => get_int(env('BAN_PERSIST_DAYS')) ?? 28,
    ],
    'user_report_notification' => [
        'endpoint_moderation' => presence(env('USER_REPORT_NOTIFICATION_ENDPOINT_MODERATION')),
        'endpoint_cheating' => presence(env('USER_REPORT_NOTIFICATION_ENDPOINT_CHEATING')),
    ],
    'wiki' => [
        'branch' => presence(env('WIKI_BRANCH'), 'master'),
        'repository' => presence(env('WIKI_REPOSITORY'), 'osu-wiki'),
        'user' => presence(env('WIKI_USER'), 'ppy'),
    ],
    'changelog' => [
        'build_history_interval' => 60 * intval(env('CHANGELOG_BUILD_HISTORY_INTERVAL', 30)), // in minutes, converted to seconds
        'chart_days' => intval(env('CHANGELOG_CHART_DAYS', 7)),
        'featured_stream' => intval(env('FEATURED_UPDATE_STREAM', 5)),
        'github_token' => env('CHANGELOG_GITHUB_TOKEN'),
        'update_streams' => array_map('intval', explode(' ', env('UPDATE_STREAMS', '5 1'))),
    ],
];
