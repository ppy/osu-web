<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'defaults' => [
        'page_description' => 'osu! - Le rythme est à un seul *clic* !  Avec Ouendan/EBA, Taiko et les modes originaux de gameplay, avec un éditeur de niveau complet.',
    ],

    'menu' => [
        'home' => [
            '_' => 'accueil',
            'account-edit' => 'paramètres',
            'friends-index' => 'amis',
            'changelog-index' => 'notes de MàJ',
            'changelog-show' => '',
            'getDownload' => 'télécharger',
            'getIcons' => 'icônes',
            'groups-show' => 'groupes',
            'index' => 'tableau de bord',
            'legal-show' => '',
            'news-index' => 'actualités',
            'news-show' => 'actualités',
            'password-reset-index' => 'réinitialiser le mot de passe',
            'search' => 'rechercher',
            'supportTheGame' => 'supporter le jeu',
            'team' => 'équipe',
        ],
        'help' => [
            '_' => 'aide',
            'getFaq' => '',
            'getRules' => 'règles',
            'getSupport' => 'non, vraiment, j\'ai besoin d\'aide !',
            'getWiki' => '',
            'wiki-show' => '',
        ],
        'beatmaps' => [
            '_' => '',
            'artists' => 'artistes plébiscités',
            'beatmap_discussion_posts-index' => 'posts de la discussion beatmap',
            'beatmap_discussions-index' => 'discussions sur la beatmap',
            'beatmapset-watches-index' => 'liste d\'abonnement des modifications',
            'beatmapset_discussion_votes-index' => 'votes de la discussion beatmap',
            'beatmapset_events-index' => 'évènements de la collection',
            'index' => 'index',
            'packs' => 'collections',
            'show' => '',
        ],
        'beatmapsets' => [
            '_' => '',
            'discussion' => '',
        ],
        'rankings' => [
            '_' => '',
            'index' => '',
            'performance' => '',
            'charts' => 'classements',
            'score' => '',
            'country' => 'pays',
            'kudosu' => '',
        ],
        'community' => [
            '_' => 'communauté',
            'dev' => '',
            'getForum' => '',
            'getChat' => '',
            'getLive' => 'direct',
            'contests' => 'concours',
            'profile' => 'profil',
            'tournaments' => 'tournois',
            'tournaments-index' => 'tournois',
            'tournaments-show' => 'infos des tournois',
            'forum-topic-watches-index' => 'abonnements aux sujets',
            'forum-topics-create' => '',
            'forum-topics-show' => '',
            'forum-forums-index' => '',
            'forum-forums-show' => '',
        ],
        'multiplayer' => [
            '_' => 'multijoueur',
            'show' => '',
        ],
        'error' => [
            '_' => 'erreur',
            '404' => 'manquant',
            '403' => 'interdit',
            '401' => 'non autorisé',
            '405' => 'manquant',
            '500' => 'quelque chose est cassé',
            '503' => '',
        ],
        'user' => [
            '_' => 'utilisateur',
            'getLogin' => 'se connecter',
            'disabled' => 'désactivé',

            'register' => 's\'inscrire',
            'reset' => 'récupérer',
            'new' => 'nouveau',

            'messages' => '',
            'settings' => 'Paramètres',
            'logout' => 'Se déconnecter',
            'help' => 'Aide',
            'modding-history-discussions' => '',
            'modding-history-events' => '',
            'modding-history-index' => 'activités utilisateur du beatmapset',
            'modding-history-posts' => '',
            'modding-history-votesGiven' => '',
            'modding-history-votesReceived' => '',
        ],
        'store' => [
            '_' => 'magasin',
            'checkout-show' => 'acheter',
            'getListing' => 'liste',
            'cart-show' => 'panier',

            'getCheckout' => 'acheter',
            'getInvoice' => 'facture',
            'products-show' => 'produit',

            'new' => 'nouveau',
            'home' => 'accueil',
            'index' => 'accueil',
            'thanks' => 'merci',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => 'bannières de forum',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => 'Commandes',
            'orders-show' => 'Commande',
        ],
        'admin' => [
            '_' => '',
            'beatmapsets-covers' => 'couvertures des beatmapsets',
            'logs-index' => 'journal',
            'root' => '',

            'beatmapsets' => [
                '_' => 'sets de beatmaps',
                'show' => 'détail',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Général',
            'home' => 'Accueil',
            'changelog-index' => 'Notes de MàJ',
            'beatmaps' => 'Liste des beatmaps',
            'download' => 'Télécharger osu!',
            'wiki' => '',
        ],
        'help' => [
            '_' => 'Aide & Communauté',
            'faq' => 'Foire aux Questions',
            'forum' => 'Forums',
            'livestreams' => 'Streams en direct',
            'report' => 'Signaler une erreur',
        ],
        'support' => [
            '_' => 'Supporter osu!',
            'tags' => 'Tags de Supporter',
            'merchandise' => 'Marchandise',
        ],
        'legal' => [
            '_' => 'Statut & Légal',
            'copyright' => '',
            'server_status' => 'Statut du serveur',
            'terms' => 'Conditions du service',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Page manquante',
            'description' => "Désolé, mais la page demandée n'est pas ici !",
        ],
        '403' => [
            'error' => "Vous ne devriez pas être ici",
            'description' => 'Vous pouvez essayer de revenir en arrière.',
        ],
        '401' => [
            'error' => "Vous ne devriez pas être ici",
            'description' => 'Vous pouvez essayer de revenir en arrière. Ou peut-être vous connecter.',
        ],
        '405' => [
            'error' => 'Page manquante',
            'description' => "Désolé, mais la page demandée n'est pas ici !",
        ],
        '500' => [
            'error' => 'Oh non ! Quelque chose s\'est cassé ! ;_;',
            'description' => "Nous avons été notifié automatiquement de cette erreur.",
        ],
        'fatal' => [
            'error' => 'Oh non ! Quelque chose s\'est cassé ! (gravement) ;_;',
            'description' => "Nous avons été notifié automatiquement de cette erreur.",
        ],
        '503' => [
            'error' => 'Maitenance en cours!',
            'description' => "Les maintenances prennent en général 5 à 10 minutes. Si c'est plus long, regardez :link pour plus d'informations.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Juste au cas où, voici un code que vous pourrez retourner au support !",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'adresse e-mail',
            'forgot' => "J'ai oublié mes identifiants",
            'password' => 'mot de passe',
            'title' => 'Se connecter pour continuer',

            'error' => [
                'email' => "Le nom d'utilisateur ou l'e-mail ne correspond pas",
                'password' => 'Mot de passe incorrect',
            ],
        ],

        'register' => [
            'info' => "Vous avez besoin d'un compte, mon cher. Pourquoi n'en avez vous pas ?",
            'title' => "Vous n'avez pas de compte ?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Paramètres',
            'friends' => 'Amis',
            'logout' => 'Se déconnecter',
            'profile' => 'Mon profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Écrivez pour rechercher!',
        'retry' => 'La recherche a échouée. Cliquez pour réessayer.',
    ],
];
