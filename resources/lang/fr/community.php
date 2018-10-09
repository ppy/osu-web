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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Vous aimez osu! ?<br/>
                                Supportez le développement d\'osu! :D',
            'small_description' => '',
            'support_button' => 'Je veux supporter osu!',
        ],

        'dev_quote' => 'osu! est un jeu entièrement free-to-play, mais le maintenir à flots n\'est certainement pas gratuit. Entre le prix des serveurs et de la bande passante internationale de qualité, le temps passé à maintenir le système et la communauté, fournir des prix pour les compétitions, répondre aux questions du support et généralement garder les gens heureux, osu! requiert une certaine quantité d\'argent! Oh, et n\'oubliez pas le fait que nous le faisons sans pub ou partenariat avec des toolbars ou autres!
                    <br/><br/>osu! est en majorité opéré par moi-même, vous me connaissez sûrement sous le pseudo "peppy".
                    J\'ai du quitter mon travail pour garder le rythme avec osu!,
                    et je lutte par moments pour maintenir mes standards.
                    J\'aimerais remercier personnellement tout ceux qui ont supporté osu! jusqu\'ici,
                    et de la même manière tout ceux qui continueront à supporter ce super jeu et sa communauté dans le futur :).',

        'supporter_status' => [
            'contribution' => 'Merci beaucoup de votre support ! Vous avez contribué pour un total de :dollars avec :tags achats de tags !',
            'gifted' => ':giftedTags de vos achats de tags ont été offerts en cadeau (pour un total de :giftedDollars offerts), quelle générosité !',
            'not_yet' => "Vous n'avez pas de tag supporter :(",
            'title' => 'Statut du supporter',
            'valid_until' => 'Votre tag supporter expire :date!',
            'was_valid_until' => 'Votre tag supporter a expiré :date.',
        ],

        'why_support' => [
            'title' => 'Pourquoi devrais-je supporter osu !?',
            'blocks' => [
                'dev' => 'Développé et maintenu en majorité par une seule personne en Australie',
                'time' => 'Prend tellement de temps pour le maintenir que ce n\'est plus possible d\'appeler ça un "hobby".',
                'ads' => 'Aucune pub, nulle part. <br/><br/>
                        Pas comme 99,95% des sites, nous ne profitons pas de votre clic pour l\'argent.',
                'goodies' => 'Vous obtiendrez des goodies !',
            ],
        ],

        'perks' => [
            'title' => 'Ah ? Qu\'est-ce que j\'aurais en plus ?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'accès rapide à la recherche et au téléchargement de beatmap sans quitter le jeu.',
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
                'description' => 'Personnalisez votre profil avec une page utilisateur complètement changeable.',
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

            'feel_special' => [
                'title' => 'Sentez-vous spécial',
                'description' => 'Le sentiment spécial de participer au bon fonctionnement d\'osu!',
            ],

            'more_to_come' => [
                'title' => 'Plus à venir',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Je suis convaincu! :D',
            'support' => 'soutenez osu!',
            'gift' => 'ou offrez osu!supporter à un autre joueur',
            'instructions' => 'cliquez sur le cœur pour vous rendre dans l\'osu!store',
        ],
    ],
];
