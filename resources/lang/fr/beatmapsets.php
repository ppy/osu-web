<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Cette beatmap n\'est actuellement pas disponible au téléchargement.',
        'parts-removed' => 'Des parties de cette beatmap ont été supprimées suite à la requête du créateur ou d\'un titulaire de droits tiers',
        'more-info' => 'Voir ici pour plus d\'informations.',
        'rule_violation' => 'Certains éléments contenus dans cette map ont été supprimés après avoir été jugés inappropriés pour être utilisés dans osu!.',
    ],

    'download' => [
        'limit_exceeded' => 'Ralentissez, jouez plus.',
    ],

    'index' => [
        'title' => 'Liste des beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'pas de beatmaps',

        'download' => [
            'all' => 'télécharger',
            'video' => 'télécharger avec la vidéo',
            'no_video' => 'télécharger sans la vidéo',
            'direct' => 'ouvrir dans osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Un beatmapset hybride nécessite de sélectionner au moins un mode de jeu à nominer.',
        'incorrect_mode' => 'Vous n\'avez pas la permission de nominer pour le mode :mode',
        'full_bn_required' => 'Vous devez être un Beatmap Nominator avec toutes les autorisations pour effectuer cette qualification.',
        'too_many' => 'L\'exigence de nomination est déjà remplie.',

        'dialog' => [
            'confirmation' => 'Êtes-vous sûr de vouloir nominer cette Beatmap ?',
            'header' => 'Nominer la beatmap',
            'hybrid_warning' => 'remarque : vous ne pouvez nominer qu\'une seule fois, donc assurez-vous que vous êtes en nomination pour tous les modes de jeu que vous avez l\'intention de proposer',
            'which_modes' => 'Nominer pour quels modes ?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicite',
    ],

    'show' => [
        'discussion' => 'Discussion',

        'details' => [
            'by_artist' => '',
            'favourite' => 'Ajouter ce beatmapset aux favoris',
            'favourite_login' => '',
            'logged-out' => 'Vous devez vous connecter pour pouvoir télécharger des beatmaps !',
            'mapped_by' => 'mappée par :mapper',
            'unfavourite' => 'Retirer ce beatmapset des favoris',
            'updated_timeago' => 'dernière mise à jour :timeago',

            'download' => [
                '_' => 'télécharger',
                'direct' => '',
                'no-video' => 'sans Vidéo',
                'video' => 'avec Vidéo',
            ],

            'login_required' => [
                'bottom' => 'pour accéder à plus de fonctionnalités',
                'top' => 'Se connecter',
            ],
        ],

        'details_date' => [
            'approved' => 'approuvé :timeago',
            'loved' => 'a aimé :timeago',
            'qualified' => 'qualifiée :timeago',
            'ranked' => 'classée :timeago',
            'submitted' => 'envoyée :timeago',
            'updated' => 'dernière mise à jour :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Vous avez trop de beatmaps favorites ! Veuillez en supprimer quelques-unes avant d\'essayer à nouveau.',
        ],

        'hype' => [
            'action' => 'Hype cette map si vous avez aimé la jouer afin qu’elle progresse au statut de <strong>Classée</strong>.',

            'current' => [
                '_' => 'Cette map est actuellement :status.',

                'status' => [
                    'pending' => 'en attente',
                    'qualified' => 'qualifiée',
                    'wip' => 'travail en cours',
                ],
            ],

            'disqualify' => [
                '_' => 'Si vous avez un problème avec cette beatmap, veuillez la disqualifier :link.',
            ],

            'report' => [
                '_' => 'Si vous trouvez un problème avec cette beatmap, merci de le signaler :link pour alerter l\'équipe.',
                'button' => 'Signaler un problème',
                'link' => 'ici',
            ],
        ],

        'info' => [
            'description' => 'Description',
            'genre' => 'Genre',
            'language' => 'Langue',
            'no_scores' => 'Les données sont encore en cours de calcul...',
            'nsfw' => 'Contenu explicite',
            'points-of-failure' => 'Répartition des échecs',
            'source' => 'Source',
            'storyboard' => 'Ce beatmap contient un storyboard',
            'success-rate' => 'Taux de réussite',
            'tags' => 'Tags',
            'video' => '',
        ],

        'nsfw_warning' => [
            'details' => 'Cette beatmap contient du contenu explicite, offensant ou perturbant. Voulez-vous le voir quand même ?',
            'title' => 'Contenu explicite',

            'buttons' => [
                'disable' => 'Désactiver l\'avertissement',
                'listing' => 'Liste des beatmaps',
                'show' => 'Afficher',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'atteint :when',
            'country' => 'Classement national',
            'friend' => 'Classement des amis',
            'global' => 'Classement global',
            'supporter-link' => 'Cliquez <a href=":link">ici</a> pour connaître toutes les supers fonctions obtenues avec !',
            'supporter-only' => 'Vous devez être osu!supporter pour accéder à cette fonctionnalité !',
            'title' => 'Tableaux des scores',

            'headers' => [
                'accuracy' => 'Précision',
                'combo' => 'Combo max',
                'miss' => 'Raté',
                'mods' => 'Mods',
                'player' => 'Joueur',
                'pp' => '',
                'rank' => 'Rang',
                'score_total' => 'Score total',
                'score' => 'Score',
                'time' => 'Temps',
            ],

            'no_scores' => [
                'country' => 'Personne de votre pays n\'a encore fait un score !',
                'friend' => 'Aucun de vos amis n\'a de score sur cette map !',
                'global' => 'Pas de scores. Peut-être devriez vous en faire un ?',
                'loading' => 'Chargement des scores...',
                'unranked' => 'Beatmap non classifié.',
            ],
            'score' => [
                'first' => 'En Tête',
                'own' => 'Votre meilleur',
            ],
        ],

        'stats' => [
            'cs' => 'Taille des Cercles',
            'cs-mania' => 'Nombre de touches',
            'drain' => 'Drainage PV',
            'accuracy' => 'Précision',
            'ar' => 'Niveau d\'approche',
            'stars' => 'Difficulté en étoiles',
            'total_length' => 'Longueur',
            'bpm' => 'BPM',
            'count_circles' => 'Nombre de Cercles',
            'count_sliders' => 'Nombre de Sliders',
            'user-rating' => 'Évaluation des joueurs',
            'rating-spread' => 'Propagation note',
            'nominations' => 'Nominations',
            'playcount' => 'Nombre de joueurs',
        ],

        'status' => [
            'ranked' => 'Classée',
            'approved' => 'Approuvée',
            'loved' => 'Aimée',
            'qualified' => 'Qualifiée',
            'wip' => 'WIP',
            'pending' => 'En attente',
            'graveyard' => 'Cimetière',
        ],
    ],
];
