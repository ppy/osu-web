<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'amministratore',
    ],
    'error' => [
        'error' => [
            '400' => 'richiesta non valida',
            '404' => 'mancante',
            '403' => 'proibito',
            '401' => 'non autorizzato',
            '401-verification' => 'verifica account',
            '405' => 'mancante',
            '422' => 'richiesta non valida',
            '429' => 'troppe richieste',
            '500' => 'qualcosa è andato storto',
            '503' => 'manutenzione',
        ],
    ],
    'forum' => [
        '_' => 'forum',
        'topic_logs_controller' => [
            'index' => 'log dei topic',
        ],
    ],
    'main' => [
        'account_controller' => [
            'verify_link' => 'verifica account',
        ],
        'artists_controller' => [
            '_' => 'artisti in primo piano',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'post di discussione beatmap',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'discussioni beatmap',
        ],
        'beatmap_packs_controller' => [
            '_' => 'pacchetti beatmap',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'voti di discussione beatmap',
        ],
        'beatmapset_events_controller' => [
            '_' => 'cronologia beatmap',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'discussione beatmap',
            'index' => 'lista beatmap',
            'show' => 'informazioni beatmap',
            'versions' => 'cronologia versioni beatmap',
        ],
        'changelog_controller' => [
            '_' => 'note di rilascio',
        ],
        'chat_controller' => [
            '_' => 'chat',
        ],
        'comments_controller' => [
            '_' => 'commenti',
        ],
        'contest_entries_controller' => [
            'judge_results' => 'risultati della valutazione di concorso',
        ],
        'contests_controller' => [
            '_' => 'concorsi',
            'judge' => 'valutazione di concorso',
        ],
        'group_history_controller' => [
            '_' => 'storico gruppi',
        ],
        'groups_controller' => [
            'show' => 'gruppi',
        ],
        'home_controller' => [
            'get_download' => 'scarica',
            'index' => 'dashboard',
            'search' => 'cerca',
            'support_the_game' => 'supporta il gioco',
            'testflight' => 'testflight',
        ],
        'legacy_matches_controller' => [
            '_' => 'partite',
        ],
        'legal_controller' => [
            '_' => 'informazioni',
        ],
        'livestreams_controller' => [
            '_' => 'dirette streaming',
        ],
        'news_controller' => [
            '_' => 'notizie',
        ],
        'notifications_controller' => [
            '_' => 'cronologia notifiche',
        ],
        'password_reset_controller' => [
            '_' => 'reset password',
        ],
        'ranking_controller' => [
            '_' => 'classifiche',
        ],
        'scores_controller' => [
            '_' => 'performance',
        ],
        'seasons_controller' => [
            '_' => 'classifiche',
        ],
        'teams_controller' => [
            '_' => 'squadre',
            'create' => 'creazione squadra',
            'edit' => 'impostazioni squadra',
            'leaderboard' => 'classifica della squadra',
            'show' => 'dettagli squadra',
        ],
        'tournaments_controller' => [
            '_' => 'tornei',
        ],
        'user_cover_presets_controller' => [
            '_' => 'copertine predefinite dall\'utente',
        ],
        'user_totp_controller' => [
            '_' => 'autenticatore',
        ],
        'users_controller' => [
            '_' => 'dettagli giocatore',
            'create' => 'crea account',
            'disabled' => 'avviso',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            'events' => 'cronologia stanze',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'autorizza app',
        ],
    ],
    'store' => [
        '_' => 'osu!store',
    ],
    'teams' => [
        'members_controller' => [
            'index' => 'membri della squadra',
        ],
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'dettagli modder',
        ],
        'multiplayer_controller' => [
            '_' => 'cronologia multigiocatore',
        ],
    ],
];
