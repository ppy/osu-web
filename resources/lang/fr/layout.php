<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Jouer automatiquement le titre suivant',
    ],

    'defaults' => [
        'page_description' => 'osu ! - Le rythme n\'est plus qu\'à un *clic* !  Avec les modes de jeu Ouendan/EBA, Taiko et original, ainsi qu\'un éditeur de niveaux entièrement fonctionnel.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'couvertures du beatmapset',
            'contest' => 'concours',
            'contests' => 'concours',
            'root' => 'console',
            'store_orders' => 'administration de la boutique',
        ],

        'artists' => [
            'index' => 'liste',
        ],

        'changelog' => [
            'index' => 'liste',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => 'Aide à la navigation',
        ],

        'store' => [
            'cart' => 'panier',
            'orders' => 'historique des commandes',
            'products' => 'produits',
        ],

        'tournaments' => [
            'index' => 'liste',
        ],

        'users' => [
            'modding' => 'modding',
            'multiplayer' => '',
            'show' => 'infos',
        ],
    ],

    'gallery' => [
        'close' => 'Fermer (Échap)',
        'fullscreen' => 'Basculer en plein écran',
        'zoom' => 'Zoom avant/arrière',
        'previous' => 'Précédent (flèche gauche)',
        'next' => 'Suivant (flèche droite)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'artistes en vedette',
            'index' => 'liste',
            'packs' => 'collections',
        ],
        'community' => [
            '_' => 'communauté',
            'chat' => 'tchat',
            'contests' => 'concours',
            'dev' => 'développement',
            'forum-forums-index' => 'forums',
            'getLive' => 'direct',
            'tournaments' => 'tournois',
        ],
        'help' => [
            '_' => 'aide',
            'getAbuse' => 'signaler un abus',
            'getFaq' => 'faq',
            'getRules' => 'règles',
            'getSupport' => 'non, vraiment, j\'ai besoin d\'aide !',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'accueil',
            'changelog-index' => 'changelog',
            'getDownload' => 'télécharger',
            'news-index' => 'actualités',
            'search' => 'rechercher',
            'team' => 'équipe',
        ],
        'rankings' => [
            '_' => 'classements',
            'charts' => 'mise en avant',
            'country' => 'pays',
            'index' => 'performance',
            'kudosu' => 'kudosu',
            'multiplayer' => 'multijoueur',
            'score' => 'score',
        ],
        'store' => [
            '_' => 'magasin',
            'cart-show' => 'panier',
            'getListing' => 'liste',
            'orders-index' => 'historique des commandes',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Général',
            'home' => 'Accueil',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Liste des beatmaps',
            'download' => 'Télécharger osu!',
        ],
        'help' => [
            '_' => 'Aide & Communauté',
            'faq' => 'Questions fréquemment posées',
            'forum' => 'Forums communautaire',
            'livestreams' => 'Streams en direct',
            'report' => 'Signaler une erreur',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Statut & Légal',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Confidentialité',
            'server_status' => 'Statut du serveur',
            'source_code' => 'Code source',
            'terms' => 'Conditions du service',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Paramètre de requête invalide',
            'description' => '',
        ],
        '404' => [
            'error' => 'Page manquante',
            'description' => "Désolé, mais la page demandée n'est pas ici !",
        ],
        '403' => [
            'error' => "Vous ne devriez pas être ici.",
            'description' => 'Vous pouvez essayer de revenir en arrière.',
        ],
        '401' => [
            'error' => "Vous ne devriez pas être ici.",
            'description' => 'Vous pouvez essayer de revenir en arrière. Ou peut-être vous connecter.',
        ],
        '405' => [
            'error' => 'Page manquante',
            'description' => "Désolé, mais la page demandée n'est pas ici !",
        ],
        '422' => [
            'error' => 'Paramètre de requête invalide',
            'description' => '',
        ],
        '429' => [
            'error' => 'Limite de tentatives atteinte',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh non ! Quelque chose s\'est cassé ! ;_;',
            'description' => "Nous avons automatiquement été notifié de cette erreur.",
        ],
        'fatal' => [
            'error' => 'Oh non ! Quelque chose s\'est cassé ! (gravement) ;_;',
            'description' => "Nous avons été automatiquement notifié de cette erreur.",
        ],
        '503' => [
            'error' => 'Maintenance en cours!',
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
        'button' => 'connexion / inscription',

        'login' => [
            'forgot' => "J'ai oublié mes identifiants",
            'password' => 'mot de passe',
            'title' => 'Se connecter pour continuer',
            'username' => 'nom d\'utilisateur',

            'error' => [
                'email' => "Le nom d'utilisateur ou l'e-mail ne correspond pas",
                'password' => 'Mot de passe incorrect',
            ],
        ],

        'register' => [
            'download' => 'Télécharger',
            'info' => 'Téléchargez osu! pour créer votre propre compte !',
            'title' => "Vous n'avez pas de compte ?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Paramètres',
            'follows' => 'Listes de suivi',
            'friends' => 'Amis',
            'logout' => 'Se déconnecter',
            'profile' => 'Mon profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Écrivez pour rechercher !',
        'retry' => 'La recherche a échouée. Cliquez pour réessayer.',
    ],
];
