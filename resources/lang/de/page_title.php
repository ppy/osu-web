<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'admin',
    ],
    'admin_forum' => [
        '_' => 'admin',
    ],
    'admin_store' => [
        '_' => 'admin',
    ],
    'error' => [
        'error' => [
            '400' => 'ungültige Anfrage',
            '404' => 'nicht gefunden',
            '403' => 'verboten',
            '401' => 'nicht authorisiert',
            '401-verification' => 'accountverifizierung',
            '405' => 'nicht gefunden',
            '422' => 'ungültige Anfrage',
            '429' => 'zu viele anfragen',
            '500' => 'unerwarteter fehler',
            '503' => 'wartung',
        ],
    ],
    'forum' => [
        '_' => 'forum',
        'topic_logs_controller' => [
            'index' => 'thread-protokolle',
        ],
        'topic_watches_controller' => [
            'index' => 'dashboard',
        ],
    ],
    'main' => [
        'account_controller' => [
            'edit' => 'dashboard',
            'verify_link' => 'accountverifizierung',
        ],
        'artist_tracks_controller' => [
            '_' => 'featured artists',
        ],
        'artists_controller' => [
            '_' => 'featured artists',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'beatmap-diskussion-beiträge',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'beatmap-diskussionen',
        ],
        'beatmap_packs_controller' => [
            '_' => 'beatmap-pakete',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'beatmap-diskussion-stimmen',
        ],
        'beatmapset_events_controller' => [
            '_' => 'beatmap-verlauf',
        ],
        'beatmapset_watches_controller' => [
            'index' => 'dashboard',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'beatmap-diskussion',
            'index' => 'beatmap-auflistung',
            'show' => 'beatmap-info',
        ],
        'changelog_controller' => [
            '_' => 'änderungsprotokoll',
        ],
        'chat_controller' => [
            '_' => 'chat',
        ],
        'comments_controller' => [
            '_' => 'kommentare',
        ],
        'contests_controller' => [
            '_' => 'wettbewerbe',
        ],
        'follows_controller' => [
            'index' => 'dashboard',
        ],
        'friends_controller' => [
            'index' => 'dashboard',
        ],
        'groups_controller' => [
            'show' => 'gruppen',
        ],
        'home_controller' => [
            'get_download' => 'herunterladen',
            'index' => 'dashboard',
            'search' => 'suchen',
            'support_the_game' => 'Das Spiel unterstützen',
            'testflight' => 'testflight',
        ],
        'legal_controller' => [
            '_' => 'informationen',
        ],
        'livestreams_controller' => [
            '_' => 'liveübertragung',
        ],
        'matches_controller' => [
            '_' => 'spiele',
        ],
        'news_controller' => [
            '_' => 'neuigkeiten',
        ],
        'notifications_controller' => [
            '_' => 'benachrichtigungsverlauf',
        ],
        'password_reset_controller' => [
            '_' => 'passwort zurücksetzen',
        ],
        'ranking_controller' => [
            '_' => 'ranglisten',
        ],
        'scores_controller' => [
            '_' => 'performance',
        ],
        'store_controller' => [
            '_' => 'shop',
        ],
        'tournaments_controller' => [
            '_' => 'turniere',
        ],
        'users_controller' => [
            '_' => 'spieler-info',
            'disabled' => 'notiz',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            '_' => 'rangliste',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'App authorisieren',
        ],
    ],
    'store' => [
        '_' => 'shop',
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'modder info',
        ],
        'multiplayer_controller' => [
            '_' => 'mehrspielerverlauf',
        ],
    ],
];
