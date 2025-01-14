<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'admin',
    ],
    'error' => [
        'error' => [
            '400' => 'requête invalide',
            '404' => 'introuvable',
            '403' => 'interdit',
            '401' => 'non autorisé',
            '401-verification' => 'vérification du compte',
            '405' => 'introuvable',
            '422' => 'requête invalide',
            '429' => 'trop de requêtes',
            '500' => 'quelque chose s\'est mal passé',
            '503' => 'maintenance',
        ],
    ],
    'forum' => [
        '_' => 'forum',
        'topic_logs_controller' => [
            'index' => 'historique du sujet',
        ],
    ],
    'main' => [
        'account_controller' => [
            'verify_link' => 'vérification du compte',
        ],
        'artists_controller' => [
            '_' => 'featured artists',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'posts de discussion sur la beatmap',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'discussions sur la beatmap',
        ],
        'beatmap_packs_controller' => [
            '_' => 'beatmap packs',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'votes de discussion de la beatmap',
        ],
        'beatmapset_events_controller' => [
            '_' => 'historique des beatmaps',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'discussion sur la beatmap',
            'index' => 'liste des beatmaps',
            'show' => 'informations sur la beatmap',
        ],
        'changelog_controller' => [
            '_' => 'changelog',
        ],
        'chat_controller' => [
            '_' => 'tchat',
        ],
        'comments_controller' => [
            '_' => 'commentaires',
        ],
        'contest_entries_controller' => [
            'judge_results' => 'résultats du jugement du concours',
        ],
        'contests_controller' => [
            '_' => 'concours',
            'judge' => 'jugement du concours',
        ],
        'groups_controller' => [
            'show' => 'groupes',
        ],
        'home_controller' => [
            'get_download' => 'télécharger',
            'index' => 'tableau de bord',
            'search' => 'recherche',
            'support_the_game' => 'soutenir le jeu',
            'testflight' => 'testflight',
        ],
        'legal_controller' => [
            '_' => 'information',
        ],
        'livestreams_controller' => [
            '_' => 'streams en direct',
        ],
        'matches_controller' => [
            '_' => 'matchs',
        ],
        'news_controller' => [
            '_' => 'news',
        ],
        'notifications_controller' => [
            '_' => 'historique des notifications',
        ],
        'password_reset_controller' => [
            '_' => 'réinitialisation du mot de passe',
        ],
        'ranking_controller' => [
            '_' => 'classements',
        ],
        'scores_controller' => [
            '_' => 'performance',
        ],
        'seasons_controller' => [
            '_' => 'classements',
        ],
        'teams_controller' => [
            '_' => '',
            'show' => '',
        ],
        'tournaments_controller' => [
            '_' => 'tournois',
        ],
        'user_cover_presets_controller' => [
            '_' => 'préréglages de bannières',
        ],
        'users_controller' => [
            '_' => 'informations du joueur',
            'create' => 'créer un compte',
            'disabled' => 'remarque',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'autoriser l\'application',
        ],
    ],
    'store' => [
        '_' => 'magasin',
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'informations sur le moddeur',
        ],
        'multiplayer_controller' => [
            '_' => 'historique multijoueur',
        ],
    ],
];
