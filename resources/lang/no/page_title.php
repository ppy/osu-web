<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'admin',
    ],
    'error' => [
        'error' => [
            '400' => 'ugyldig forespørsel',
            '404' => 'mangler',
            '403' => 'forbudt',
            '401' => 'uautorisert',
            '401-verification' => 'kontobekreftelse',
            '405' => 'mangler',
            '422' => 'ugyldig forespørsel',
            '429' => 'for mange forespørsler',
            '500' => 'noe gikk i stykker',
            '503' => 'vedlikehold',
        ],
    ],
    'forum' => [
        '_' => 'forum',
        'topic_logs_controller' => [
            'index' => 'emnelogger',
        ],
    ],
    'main' => [
        'account_controller' => [
            'verify_link' => 'kontobekreftelse',
        ],
        'artists_controller' => [
            '_' => 'utvalgte artister',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'beatmapdiskusjonsinnlegg',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'beatmapdiskusjoner',
        ],
        'beatmap_packs_controller' => [
            '_' => 'beatmappakker',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'beatmapdiskusjonsstemmer',
        ],
        'beatmapset_events_controller' => [
            '_' => 'beatmaphistorie',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'beatmapdiskusjon',
            'index' => 'beatmapliste',
            'show' => 'beatmap info',
        ],
        'changelog_controller' => [
            '_' => 'endringslogg',
        ],
        'chat_controller' => [
            '_' => 'chat',
        ],
        'comments_controller' => [
            '_' => 'kommentarer',
        ],
        'contest_entries_controller' => [
            'judge_results' => 'konkurransedømmingsresultater',
        ],
        'contests_controller' => [
            '_' => 'konkurranser',
            'judge' => 'konkurransedømming',
        ],
        'groups_controller' => [
            'show' => 'grupper',
        ],
        'home_controller' => [
            'get_download' => 'last ned',
            'index' => 'dashbord',
            'search' => 'søk',
            'support_the_game' => 'støtt spillet',
            'testflight' => 'testflight',
        ],
        'legacy_matches_controller' => [
            '_' => '',
        ],
        'legal_controller' => [
            '_' => 'informasjon',
        ],
        'livestreams_controller' => [
            '_' => 'direktesendinger',
        ],
        'news_controller' => [
            '_' => 'nyheter',
        ],
        'notifications_controller' => [
            '_' => 'varslingshistorikk',
        ],
        'password_reset_controller' => [
            '_' => 'tilbakestill passord',
        ],
        'ranking_controller' => [
            '_' => 'rangering',
        ],
        'scores_controller' => [
            '_' => 'gjennomføring',
        ],
        'seasons_controller' => [
            '_' => 'rangeringer',
        ],
        'teams_controller' => [
            '_' => '',
            'create' => '',
            'edit' => '',
            'leaderboard' => '',
            'show' => '',
        ],
        'tournaments_controller' => [
            '_' => 'turneringer',
        ],
        'user_cover_presets_controller' => [
            '_' => '',
        ],
        'users_controller' => [
            '_' => 'spillerinfo',
            'create' => 'opprett konto',
            'disabled' => 'varsel',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            'events' => '',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'autoriser app',
        ],
    ],
    'store' => [
        '_' => 'butikk',
    ],
    'teams' => [
        'members_controller' => [
            'index' => '',
        ],
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'modder info',
        ],
        'multiplayer_controller' => [
            '_' => 'flerspillerlogg',
        ],
    ],
];
