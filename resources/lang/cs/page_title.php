<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'admin',
    ],
    'error' => [
        'error' => [
            '400' => 'neplatný požadavek',
            '404' => 'chybějící',
            '403' => 'zakázano',
            '401' => 'neoprávněný',
            '401-verification' => 'ověření účtu',
            '405' => 'chybějící',
            '422' => 'neplatný požadavek',
            '429' => 'příliš mnoho požadavků',
            '500' => 'něco se pokazilo',
            '503' => 'údržba',
        ],
    ],
    'forum' => [
        '_' => 'fórum',
        'topic_logs_controller' => [
            'index' => 'záznamy téma',
        ],
    ],
    'main' => [
        'account_controller' => [
            'verify_link' => 'ověření účtu',
        ],
        'artists_controller' => [
            '_' => 'oficiální umělci',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'příspěvky diskuze o beatmapě',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'diskuze o beatmapě',
        ],
        'beatmap_packs_controller' => [
            '_' => 'balíčky beatmap',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'diskuzní hlasy beatmapy',
        ],
        'beatmapset_events_controller' => [
            '_' => 'historie beatmap',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'diskuze o beatmapě',
            'index' => 'seznam beatmap',
            'show' => 'info o beatmapě',
            'versions' => '',
        ],
        'changelog_controller' => [
            '_' => 'seznam změn',
        ],
        'chat_controller' => [
            '_' => 'chat',
        ],
        'comments_controller' => [
            '_' => 'komentáře',
        ],
        'contest_entries_controller' => [
            'judge_results' => 'výsledky hodnocení soutěže',
        ],
        'contests_controller' => [
            '_' => 'soutěže',
            'judge' => 'hodnocení soutěže',
        ],
        'group_history_controller' => [
            '_' => '',
        ],
        'groups_controller' => [
            'show' => 'skupiny',
        ],
        'home_controller' => [
            'get_download' => 'ke stažení',
            'index' => 'nástěnka',
            'search' => 'hledat',
            'support_the_game' => 'podpoř hru',
            'testflight' => 'testflight',
        ],
        'legacy_matches_controller' => [
            '_' => 'zápasy',
        ],
        'legal_controller' => [
            '_' => 'informace',
        ],
        'livestreams_controller' => [
            '_' => 'živá vysílání',
        ],
        'news_controller' => [
            '_' => 'novinky',
        ],
        'notifications_controller' => [
            '_' => 'historie oznámení',
        ],
        'password_reset_controller' => [
            '_' => 'obnova hesla',
        ],
        'ranking_controller' => [
            '_' => 'žebříček',
        ],
        'scores_controller' => [
            '_' => 'výkon',
        ],
        'seasons_controller' => [
            '_' => 'hodnocení',
        ],
        'teams_controller' => [
            '_' => 'týmy',
            'create' => 'vytvořit tým',
            'edit' => 'nastavení týmu',
            'leaderboard' => 'žebříček týmu',
            'show' => 'informace o týmu',
        ],
        'tournaments_controller' => [
            '_' => 'turnaje',
        ],
        'user_cover_presets_controller' => [
            '_' => 'přednastavení uživatelského záhlaví',
        ],
        'user_totp_controller' => [
            '_' => '',
        ],
        'users_controller' => [
            '_' => 'informace o hráči',
            'create' => 'vytvořit účet',
            'disabled' => 'oznámení',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            'events' => 'historie místnosti',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'autorizovat aplikaci',
        ],
    ],
    'store' => [
        '_' => 'obchod',
    ],
    'teams' => [
        'members_controller' => [
            'index' => 'členové týmu',
        ],
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'modder info',
        ],
        'multiplayer_controller' => [
            '_' => 'historie her více hráčů',
        ],
    ],
];
