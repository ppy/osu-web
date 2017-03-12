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
    'defaults' => [
        'page_description' => 'osu! - Le rythme est à un *clic*!  Avec Ouendan/EBA, Taiko et les modes originaux de gameplay, avec un éditeur de niveau complet.',
    ],

    'menu' => [
        'home' => [
            '_' => 'Accueil',
            'index' => 'osu!',
            'getChangelog' => 'Historique de mises à jour ',
            'getDownload' => 'Téléchargement',
            'getIcons' => 'icônes',
            'getNews' => 'Nouveautés',
            'supportTheGame' => 'supporter le jeu',
        ],
        'help' => [
            '_' => 'Aide',
            'getWiki' => 'Wiki',
            'getFaq' => 'Foire aux Questions',
            'getSupport' => 'Support',
        ],
        'beatmaps' => [
            '_' => 'Beatmaps',
            'show' => 'Info',
            'index' => 'Liste',
            'artists' => 'Artistes plébiscités',
            // 'getPacks' => 'packs',
            // 'getCharts' => 'graphiques',
        ],
        'beatmapsets' => [
            '_' => 'Lots de beatmaps',
            'discussion' => 'Modding',
        ],
        'ranking' => [
            '_' => 'Classement',
            'getOverall' => 'Général',
            'getCountry' => 'National',
            'getCharts' => 'Chartes',
            'getMapper' => 'Kudosu',
            'index' => 'Général',
        ],
        'community' => [
            '_' => 'Communauté',
            'getForum' => 'Forum',
            'getChat' => 'Chat',
            'getSupport' => 'Support',
            'getLive' => 'Direct',
            'contests' => 'Concours',
            'profile' => 'Profil',
            'tournaments' => 'Tournois',
            'tournaments-index' => 'Tournois',
            'tournaments-show' => 'Infos des tournois',
            'forum-topic-watches-index' => 'Abonnements aux sujets',
            'forum-topics-create' => 'Forum',
            'forum-topics-show' => 'Forum',
            'forum-forums-index' => 'Forum',
            'forum-forums-show' => 'Forum',
        ],
        'multiplayer' => [
            '_' => 'Multijoueur',
            'show' => 'Match',
        ],
        'error' => [
            '_' => 'Erreur',
            '404' => 'Manquant',
            '403' => 'Interdit',
            '401' => 'Non autorisé',
            '405' => 'Manquant',
            '500' => "Quelque chose s'est cassé",
            '503' => 'Maintenance',
        ],
        'user' => [
            '_' => 'Utilisateur',
            'getLogin' => 'Se connecter',
            'disabled' => 'Désactivé',

            'register' => "S'inscrire",
            'reset' => 'Récupérer',
            'new' => 'Nouveau',

            'messages' => 'Messages',
            'settings' => 'Paramètres',
            'logout' => 'Se déconnecter',
            'help' => 'Aide',
        ],
        'store' => [
            '_' => 'Magasin',
            'getListing' => 'Liste',
            'getCart' => 'Panier',

            'getCheckout' => 'Acheter',
            'getInvoice' => 'Facture',
            'getProduct' => 'Produit',

            'new' => 'Nouveau',
            'home' => 'Accueil',
            'index' => 'Accueil',
            'thanks' => 'Merci',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'Bannières de forum',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'Commandes',
            'orders-show' => 'Commande',
        ],
        'admin' => [
            '_' => 'Admin',
            'root' => 'Index',
            'logs-index' => 'Logs',
            'beatmapsets' => [
                '_' => 'Lots de beatmaps',
                'covers' => 'Bannières',
                'show' => 'Détails',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Général',
            'home' => 'Accueil',
            'changelog' => 'Historique de mises à jour',
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
            'tos' => 'Conditions de service',
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
            'error' => "Oh non! Quelque chose s'est cassé! ;_;",
            'description' => 'Nous avons été notifié automatiquement de cette erreur.',
            'link' => false,
        ],
        'fatal' => [
            'error' => "Oh non! Quelquechose s'est cassé! (gravement) ;_;",
            'description' => 'Nous avons été notifié automatiquement de cette erreur.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Maintenance en cours!',
            'description' => "Les maintenances prennent en général de 5 à 10 minutes. Si c'est plus long, regardez :link pour plus d'informations.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Juste au cas où, voici un code que vous pourrez donner au support!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'Adresse e-mail',
            'forgot' => "J'ai oublié mes détails de connexion",
            'password' => 'Mot de passe',
            'title' => 'Se connecter pour continuer',

            'error' => [
                'email' => "Le nom d'utilisateur ou l'e-mail ne correspond pas",
                'password' => 'Mot de passe incorrect',
            ],
        ],

        'register' => [
            'info' => "Vous avez besoin d'un compte. Pourquoi n'en-avez vous pas déjà un?",
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
