<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'title' => 'bienvenue',
        'see_more_news' => 'voir plus de nouvelles',

        'slogan' => [
            'main' => 'le meilleur jeu de rythme free-to-win',
            'sub' => 'Le rythme est juste à un seul clic',
        ],
    ],

    'search' => [
        'advanced_link' => 'Recherche avancée',
        'button' => 'Rechercher',
        'empty_result' => 'Aucun résultat !',
        'keyword_required' => 'Un mot clé de recherche est requis',
        'placeholder' => 'tapez pour rechercher',
        'title' => 'Rechercher',

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
            'more_hidden' => 'La recherche de joueurs est limitée à :max joueurs. Essayez d\'affiner votre recherche.',
            'title' => 'Joueurs',
        ],

        'wiki_page' => [
            'link' => 'Rechercher sur le wiki',
            'more_simple' => 'Voir plus de résultats de la recherche sur le wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "c'est parti<br>lancez-vous !",
        'action' => 'Télécharger osu!',
        'os' => [
            'windows' => 'pour Windows',
            'macos' => 'pour macOS',
            'linux' => 'pour Linux',
        ],
        'mirror' => 'miroir',
        'macos-fallback' => 'utilisateurs macOS',
        'steps' => [
            'register' => [
                'title' => 'créer un compte',
                'description' => 'suivez les indications lorsque vous démarrerez le jeu pour vous connecter ou créer un nouveau compte',
            ],
            'download' => [
                'title' => 'télécharger le jeu',
                'description' => 'cliquez sur le bouton au-dessus pour télécharger l\'installateur, lancez-le ensuite !',
            ],
            'beatmaps' => [
                'title' => 'obtenir des beatmaps',
                'description' => [
                    '_' => ':browse dans la vaste librairie des beatmaps créées par la communauté et commencez à jouer !',
                    'browse' => 'Naviguez',
                ],
            ],
        ],
        'video-guide' => 'Guide vidéo',
    ],

    'user' => [
        'title' => 'tableau de bord',
        'news' => [
            'title' => 'Nouvelles',
            'error' => 'Erreur lors du chargement des nouvelles, essayez de recharger la page ?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Amis en ligne',
                'games' => 'Parties',
                'online' => 'Utilisateurs en ligne',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nouvelles Beatmaps Approuvées',
            'popular' => 'Beatmaps Populaires',
            'by_user' => 'par :user',
        ],
        'buttons' => [
            'download' => 'Télécharger osu!',
            'support' => 'Supporter osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow !',
        'subtitle' => 'Vous semblez passer un bon moment ! :D',
        'body' => [
            'part-1' => 'Saviez-vous que osu! fonctionne sans publicité et compte sur les joueurs pour supporter son développement et ses coûts ?',
            'part-2' => 'Saviez-vous aussi que supporter osu! permet d\'obtenir une poignée de fonctions utiles, comme le <strong>téléchargement de beatmaps en jeu</strong> qui est automatique en mode spectateur et dans les parties multijoueur ?',
        ],
        'find-out-more' => 'Cliquez ici pour en savoir plus !',
        'download-starting' => "Oh, et ne vous inquiétez pas - votre téléchargement a déjà commencé pour vous ;)",
    ],
];
