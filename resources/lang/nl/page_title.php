<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'beheerder',
    ],
    'admin_forum' => [
        '_' => 'beheerder',
    ],
    'admin_store' => [
        '_' => 'beheerder',
    ],
    'error' => [
        'error' => [
            '400' => 'ongeldige aanvraag',
            '404' => 'ontbrekend',
            '403' => 'verboden',
            '401' => 'ongeautoriseerd',
            '401-verification' => 'account verificatie',
            '405' => 'ontbrekend',
            '422' => 'ongeldige aanvraag',
            '429' => 'te veel aanvragen',
            '500' => 'iets gaat er mis',
            '503' => 'onderhoud',
        ],
    ],
    'forum' => [
        '_' => 'forum',
        'topic_watches_controller' => [
            'index' => 'dashboard',
        ],
    ],
    'main' => [
        'account_controller' => [
            'edit' => 'dashboard',
            'verify_link' => 'account verificatie',
        ],
        'artists_controller' => [
            '_' => 'aanbevolen artiesten',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'beatmap discussie berichten',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'beatmap discussies',
        ],
        'beatmap_packs_controller' => [
            '_' => 'beatmap pakketten',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'beatmap discussie stemmen',
        ],
        'beatmapset_events_controller' => [
            '_' => 'beatmap geschiedenis',
        ],
        'beatmapset_watches_controller' => [
            'index' => 'dashboard',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'beatmap discussie',
            'index' => 'beatmap listing',
            'show' => 'beatmap info',
        ],
        'changelog_controller' => [
            '_' => 'wijzigingslogboek',
        ],
        'chat_controller' => [
            '_' => 'chat',
        ],
        'comments_controller' => [
            '_' => 'opmerkingen',
        ],
        'contests_controller' => [
            '_' => 'wedstrijden',
        ],
        'follows_controller' => [
            'index' => 'dashboard',
        ],
        'friends_controller' => [
            'index' => 'dashboard',
        ],
        'groups_controller' => [
            'show' => 'groepen',
        ],
        'home_controller' => [
            'get_download' => 'download',
            'index' => 'dashboard',
            'search' => 'zoeken',
            'support_the_game' => 'ondersteun het spel',
            'testflight' => 'testflight',
        ],
        'legal_controller' => [
            '_' => 'informatie',
        ],
        'livestreams_controller' => [
            '_' => 'live streams',
        ],
        'matches_controller' => [
            '_' => 'matches',
        ],
        'news_controller' => [
            '_' => 'nieuws',
        ],
        'notifications_controller' => [
            '_' => 'meldingen geschiedenis',
        ],
        'password_reset_controller' => [
            '_' => 'wachtwoord opnieuw instellen',
        ],
        'ranking_controller' => [
            '_' => 'rankings',
        ],
        'scores_controller' => [
            '_' => 'prestatie',
        ],
        'store_controller' => [
            '_' => 'winkel',
        ],
        'tournaments_controller' => [
            '_' => 'toernooien',
        ],
        'users_controller' => [
            '_' => 'speler info',
            'disabled' => 'waarschuwing',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            '_' => 'ranglijst',
        ],
    ],
    'store' => [
        '_' => 'winkel',
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'modder info',
        ],
        'multiplayer_controller' => [
            '_' => 'multiplayer geschiedenis',
        ],
    ],
];
