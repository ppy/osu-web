<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Je suis convaincu! :D',
            'support' => 'soutenez osu!',
            'gift' => 'ou offrez osu!supporter à un autre joueur',
            'instructions' => 'cliquez sur le cœur pour vous rendre dans l\'osu!store',
        ],
        'why-support' => [
            'title' => 'Pourquoi devrais-je soutenir osu! ? Où va l\'argent ?',

            'team' => [
                'title' => 'Soutenir l\'équipe',
                'description' => 'Une petite équipe développe et fait fonctionner osu!. Votre soutien les aide à, vous savez... vivre.',
            ],
            'infra' => [
                'title' => 'Infrastructure du serveur',
                'description' => 'Les contributions vont vers les serveurs pour l\'exécution du site, des services multijoueurs, des classements en ligne, etc.',
            ],
            'featured-artists' => [
                'title' => 'Artistes mis en avant',
                'description' => 'Avec votre soutien, nous pouvons approcher encore plus d\'artistes géniaux et obtenir les licences de plus de musique pour l\'utilisation de osu!',
                'link_text' => 'Voir la liste courante &raquo;',
            ],
            'ads' => [
                'title' => 'Garder osu ! auto-soutenant',
                'description' => 'Vos contributions aident à garder le jeu indépendant et totalement exempt des annonces et des sponsors extérieurs.',
            ],
            'tournaments' => [
                'title' => 'Tournois officiels',
                'description' => 'Aidez à financer le fonctionnement (et les prix pour) des tournois officiels de la Coupe du Monde.',
                'link_text' => 'Explorer les tournois &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Programme de Bounty Open Source',
                'description' => 'Soutenez les contributeurs communautaires qui ont donné leur temps et leurs efforts pour rendre osu! meilleur.',
                'link_text' => 'En savoir plus &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Ah ? Qu\'est-ce que j\'aurais en plus ?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'accès rapide à la recherche et au téléchargement de beatmap sans quitter le jeu.',
            ],

            'friend_ranking' => [
                'title' => 'Classement des amis',
                'description' => "Voyez comment vous vous accumulez contre vos amis sur le classement d'une beatmap, tant en jeu que sur le site web.",
            ],

            'country_ranking' => [
                'title' => 'Classement national',
                'description' => 'Conquérez votre pays avant de conquérir le monde.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrer par Mods',
                'description' => 'Associez seulement les personnes qui jouent sur HDHR ? Pas de problème !',
            ],

            'auto_downloads' => [
                'title' => 'Téléchargements automatiques',
                'description' => 'Téléchargements automatiques en multijoueur, lorsque vous observez ou dans le chat!',
            ],

            'upload_more' => [
                'title' => 'Plus de slots d\'upload',
                'description' => 'Slots de beatmaps additionnels jusqu\'à 10.',
            ],

            'early_access' => [
                'title' => 'Accès anticipé',
                'description' => 'Accès aux versions anticipées, vous obtiendrez les nouvelles fonctions avant tout le monde!',
            ],

            'customisation' => [
                'title' => 'Personnalisation',
                'description' => "Personnalisez votre profil avec une page utilisateur complètement changeable.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtres de beatmaps',
                'description' => 'Filtrez les recherches de beatmaps par les jouées et les non-jouées et les notes obtenues (si une).',
            ],

            'yellow_fellow' => [
                'title' => 'Compagnon jaune',
                'description' => 'Soyez reconnu en jeu avec un pseudo couleur or.',
            ],

            'speedy_downloads' => [
                'title' => 'Téléchargements rapides',
                'description' => 'Moins de restrictions de téléchargements, surtout grâce à osu!direct.',
            ],

            'change_username' => [
                'title' => 'Changez de pseudo',
                'description' => 'Vous pouvez changer votre pseudo sans coûts. (une fois seulement)',
            ],

            'skinnables' => [
                'title' => 'Skin',
                'description' => 'Plus d\'options de skin, comme le fond du menu principal.',
            ],

            'feature_votes' => [
                'title' => 'Votes de fonctionnalités',
                'description' => 'Votez pour les demandes de fonctionnalités. (2x par mois)',
            ],

            'sort_options' => [
                'title' => 'Options de filtrage',
                'description' => 'La capacité de filtrer le classement par pays / amis / mods spécifiques.',
            ],

            'more_favourites' => [
                'title' => 'Plus de favoris',
                'description' => 'Le nombre maximum de beatmaps que vous pouvez préférer est augmenté de :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Plus d\'amis',
                'description' => 'Le nombre maximum d\'amis que vous pouvez avoir est augmenté de :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Mettre en ligne plus de Beatmaps',
                'description' => 'Le nombre maximal de beatmaps non-classées que vous pouvez avoir est calculé à partir d\'une valeur de base, augmentée pour chacune de vos beatmaps classées, jusqu\'à une certaine limite.<br/><br/>Normalement ce nombre est de 4 plus 1 pour chaque beatmap classée (jusqu\'à un maximum de 2). Avec osu!supporter, le maximum passe à 8 plus 1 par beatmap classée (jusqu\'à un maximum de 12).',
            ],
            'friend_filtering' => [
                'title' => 'Classement des amis',
                'description' => 'Compétez avec vos amis et voyez comment vous montez contre eux !*<br/><br/><small>* pas encore disponible sur le nouveau site, comingsoon(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Merci beaucoup de votre support ! Vous avez contribué pour un total de :dollars avec :tags achats de tags !',
            'gifted' => ":giftedTags de vos achats de tags ont été offerts en cadeau (pour un total de :giftedDollars offerts), quelle générosité !",
            'not_yet' => "Vous n'avez pas de tag supporter :(",
            'valid_until' => 'Votre tag supporter expire :date!',
            'was_valid_until' => 'Votre tag supporter a expiré :date.',
        ],
    ],
];
