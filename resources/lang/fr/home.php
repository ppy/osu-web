<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'landing' => [
        'download' => 'Télécharger maintenant',
        'online' => '<strong>:players</strong> connectés en ce moment dans <strong>:games</strong> parties',
        'peak' => 'Pic, :count joueurs connectés',
        'players' => '<strong>:count</strong> joueurs inscrits',

        'slogan' => [
            'main' => 'jeu de rythme free-to-play',
            'sub' => 'Le rythme est juste à un seul clic',
        ],
    ],

    'search' => [
        'advanced_link' => 'Recherche avancée',
        'button' => 'rechercher',
        'empty_result' => 'Aucun Résultat !',
        'missing_query' => 'Les mots clés doivent être de :n caractères minimum',
        'title' => 'Résultats de la Recherche',

        'beatmapset' => [
            'more' => ':count résultats de recherche de beatmap en plus',
            'more_simple' => 'Voir plus de résultats de la recherche de beatmaps',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Tous les forums',
            'link' => 'Rechercher sur le forum',
            'more_simple' => 'Voir plus de résultats de la recherche du forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'Rechercher dans les forums',
                'forum_children' => 'inclure les sous-forums',
                'topic_id' => 'sujet #',
                'username' => 'auteur',
            ],
        ],

        'mode' => [
            'all' => 'tout',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'joueur',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count résultats de la recherche de joueur',
            'more_simple' => 'Voir plus de résultats de la recherche de joueurs',
            'more_hidden' => "La recherche de joueurs est limité à :max joueurs. Essayez d'affiner votre recherche",
            'title' => 'Joueurs',
        ],

        'wiki_page' => [
            'link' => 'Rechercher sur le wiki',
            'more_simple' => 'Voir plus de résultats de la recherche sur le wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => 'Commençons<br>avec vous !',
        'action' => 'Téléchargez osu!',
        'os' => [
            'windows' => 'pour Windows',
            'macos' => 'pour macOS',
            'linux' => 'pour Linux',
        ],
        'mirror' => 'mirroirs',
        'macos-fallback' => 'utilisateurs de macOS',
        'steps' => [
            'register' => [
                'title' => 'se faire un compte',
                'description' => 'cuivez les instructions lorsque vous avez démarré le jeu pour se connecter ou faire se faire un compte',
            ],
            'download' => [
                'title' => 'télécharger le jeu',
                'description' => "cliquez sur le bouton ci-dessus pour télécharger l'installateur, puis lancez-le !",
            ],
            'beatmaps' => [
                'title' => 'obtenir des beatmaps',
                'description' => [
                    '_' => ':browse sur la vaste bibliothèque de betmaps créées par les utilisateurs et commencez à jouer !',
                    'browse' => 'naviguez',
                ],
            ],
        ],
        'video-guide' => 'guide vidéo',
    ],

    'user' => [
        'title' => 'nouvelles',
        'news' => [
            'title' => 'Nouvelles',
            'error' => 'Erreur lors du chargement des nouvelles, essayez de recharger la page ?...',
        ],
        'header' => [
            'welcome' => 'Bonjour, <strong>:username</strong> !',
            'messages' => 'Vous avez 1 nouveau message|Vous avez :count nouveaux messages',
            'stats' => [
                'friends' => 'Amis en ligne',
                'games' => 'Jeux',
                'online' => 'Utilisateurs en ligne',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nouvelles Beatmaps Approuvées',
            'popular' => 'Beatmaps Populaires',
            'by' => 'par',
            'plays' => ':count fois jouée',
        ],
        'buttons' => [
            'download' => 'Télécharger osu!',
            'support' => 'Supporter osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow !',
        'subtitle' => 'Vous semblez avoir du bon temps ! :D',
        'body' => [
            'part-1' => "Savez-vous qu'osu! fonctionne sans publicités, et repose sur les joueurs pour les coûts de fonctionnement ?",
            'part-2' => "Savez-vous aussi que supporter osu! vous donnera toute une liste de fonctionnalités utiles, comme le <strong>téléchargement en-jeu</strong> qui s'active tout seul lorsque que vous êtes spectateur de quelqu'un ou que vous jouez en multijoueur ?",
        ],
        'find-out-more' => 'Cliquez ici pour en savoir plus !',
        'download-starting' => 'Oh, et ne vous inquiétez pas - votre téléchargement à déjà commencé ;)',
    ],
];
