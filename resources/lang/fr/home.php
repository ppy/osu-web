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
        'online' => '<strong>:players</strong> connectés en ce moment dans <strong>:games</strong> parties',
        'peak' => 'Pic, :count joueurs connectés',
        'players' => '<strong>:count</strong> joueurs inscrits',

        'download' => [
            '_' => 'Télécharger maintenant',
            'soon' => "osu! sera bientôt disponible sur d'autres plateformes",
            'for' => 'pour :os',
            'other' => 'cliquez ici pour :os1 ou :os2',
        ],

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
            'title' => 'Joueurs',
        ],

        'wiki_page' => [
            'link' => 'Rechercher sur le wiki',
            'more_simple' => 'Voir plus de résultats de la recherche sur le wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
      'header' => [
          '1' => "C'est parti",
          '2' => 'pour vous',
          '3' => 'télécharger le client osu! pour Windows',
      ],
      'steps' => [
          '1' => [
              'name' => 'Étape 1',
              'content' => 'Télécharger le client osu!',
          ],
          '2' => [
              'name' => 'Étape 2',
              'content' => 'Créer un compte osu!',
          ],
          '3' => [
              'name' => 'Étape 3',
              'content' => '???',
          ],
      ],
      'more' => 'Vous en voulez plus ?',
      'more_text' => "Passez un coup d'oeil <a href=\"https://www.youtube.com/user/osuacademy/\">sur la chaîne osu!academy</a> pour des tutoriels et des astuces à jour pour profiter au maximum d'osu!",
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
];
