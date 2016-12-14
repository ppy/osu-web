<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'page_description' => 'osu! - Le rythme est seulement à un seul *clic*!  Avec Ouendan/EBA, Taiko et les modes originaux de gameplay, avec un éditeur de niveau complet.',
    ],

    'menu' => [
        'home' => [
            '_' => 'accueil',
                        'index' => 'osu!',
            'getChangelog' => 'notes de MàJ',
            'getDownload' => 'télécharger',
            'getIcons' => 'icônes',
            'getNews' => 'nouvelles',
            'supportTheGame' => 'supporter le jeu',
        ],
        'help' => [
            '_' => 'aide',
            'getWiki' => 'wiki',
            'getFaq' => 'faq',
            'getSupport' => 'support',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'show' => 'info',
            'index' => 'liste',
            'artists' => 'artistes plébiscités',
            // 'getPacks' => 'packs',
            // 'getCharts' => 'graphiques',
        ],
        'beatmapsets' => [
            '_' => 'sets de beatmap',
            'discussion' => 'modding',
        ],
        'ranking' => [
            '_' => 'classement',
            'getOverall' => 'général',
            'getCountry' => 'national',
            'getCharts' => 'graphiques',
            'getMapper' => 'mappeur',
            'index' => 'général',
        ],
        'community' => [
            '_' => 'communauté',
            'getForum' => 'forum',
            'getChat' => 'chat',
            'getSupport' => 'support',
            'getLive' => 'direct',
            'getSlack' => 'osu!dev',
            'contests' => 'concours',
            'profile' => 'profil',
            'tournaments' => 'tournois',
            'tournaments-index' => 'tournois',
            'tournaments-show' => 'infos des tournois',
            'forum-topic-watches-index' => 'Abonnements aux sujets',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
        ],
        'multiplayer' => [
            '_' => 'multijoueur',
            'show' => 'match',
        ],
        'error' => [
            '_' => 'erreur',
            '404' => 'manquant',
            '403' => 'interdit',
            '401' => 'non autorisé',
            '405' => 'manquant',
            '500' => 'quelquechose est cassé',
            '503' => 'maintenance',
        ],
        'user' => [
            '_' => 'utilisateur',
            'getLogin' => 'se connecter',
            'disabled' => 'désactivé',

            'register' => 's\'inscrire',
            'reset' => 'récupérer',
            'new' => 'nouveau',

            'messages' => 'Messages',
            'settings' => 'Paramètres',
            'logout' => 'Se déconnecter',
            'help' => 'Aide',
        ],
        'store' => [
            '_' => 'Magasin',
            'getListing' => 'liste',
            'getCart' => 'panier',

            'getCheckout' => 'acheter',
            'getInvoice' => 'facture',
            'getProduct' => 'produit',

            'new' => 'nouveau',
            'home' => 'accueil',
            'index' => 'accueil',
            'thanks' => 'merci',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'bannières de forum',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'Commandes',
            'orders-show' => 'Commande',
        ],
        'admin' => [
            '_' => 'admin',
                        'root' => 'index',
            'logs-index' => 'log',
            'beatmapsets' => [
                '_' => 'sets de beatmaps',
                'covers' => 'bannières',
                'show' => 'détail',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Général',
            'home' => 'Accueil',
            'changelog' => 'Notes de MàJ',
            'beatmaps' => 'Liste des beatmaps',
            'download' => 'Télécharger osu!',
            'wiki' => 'Wiki',
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
            'tos' => 'Conditions du service',
            'copyright' => 'Copyright (DMCA)',
            'serverStatus' => 'Statut du serveur',
            'osuStatus' => '@osustatus',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Page manquante',
            'description' => "Désolé, mais la page demandée n'est pas ici!",
            'link' => false,
        ],
        '403' => [
            'error' => 'Vous ne devriez pas être ici',
            'description' => 'Vous pouvez essayer de revenir en arrière.',
            'link' => false,
        ],
        '401' => [
            'error' => 'Vous ne devriez pas être ici',
            'description' => 'Vous pouvez essayer de revenir en arrière. Ou peut-être vous connecter.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Page manquante',
            'description' => "Désolé, mais la page demandée n'est pas ici!",
            'link' => false,
        ],
        '500' => [
            'error' => 'Oh non! Quelquechose a cassé! ;_;',
            'description' => 'Nous avons été notifié automatiquement de cette erreur.',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'Oh non! Quelquechose a cassé! (gravement) ;_;',
            'description' => 'Nous avons été notifié automatiquement de cette erreur.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Maitenance en cours!',
            'description' => "Les maitenances prennent en général 5 à 10 minutes. Si c'est plus long, regardez :link pour plus d'informations.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Juste au cas où, voici un code que vous pourrez retourner au support!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'adresse e-mail',
            'forgot' => "J'ai oublié mes détails de connexion",
            'password' => 'mot de passe',
            'title' => 'Se connecter pour continuer',

            'error' => [
                'email' => "Le nom d'utilisateur ou l'e-mail ne correspond pas",
                'password' => 'Mot de passe incorrect',
            ],
        ],

        'register' => [
            'info' => "Vous avez besoin d'un compte, monsieur. Pourquoi vous en avez pas?",
            'title' => "Vous n'avez pas de compte?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'profile' => 'Mon profil',
            'logout' => 'Se déconnecter',
        ],
    ],
];
