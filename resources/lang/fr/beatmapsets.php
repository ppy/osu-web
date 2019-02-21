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
    'availability' => [
        'disabled' => 'Cette beatmap n\'est actuellement pas disponible au téléchargement.',
        'parts-removed' => 'Des parties de cette beatmap ont été supprimées suite à la requête du créateur ou d\'un titulaire de droits tiers',
        'more-info' => 'Voir ici pour plus d\'informations.',
    ],

    'index' => [
        'title' => 'Liste des beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discussion',

        'details' => [
            'approved' => 'approuvée le ',
            'favourite' => 'Ajouter ce beatmapset aux favoris',
            'favourited_count' => '+ 1 autre!|+ :count autres!',
            'logged-out' => 'Vous devez vous connecter pour pouvoir télécharger des beatmaps !',
            'loved' => 'loved le ',
            'mapped_by' => 'mappée par :mapper',
            'qualified' => 'qualifiée le ',
            'ranked' => 'classée le ',
            'submitted' => 'envoyée le ',
            'unfavourite' => 'Retirer ce beatmapset des favoris',
            'updated' => 'dernière mise à jour le ',
            'updated_timeago' => 'dernière mise à jour :timeago',

            'download' => [
                '_' => 'télécharger',
                'direct' => 'osu!direct',
                'no-video' => 'sans Vidéo',
                'video' => 'avec Vidéo',
            ],

            'login_required' => [
                'bottom' => '',
                'top' => '',
            ],
        ],

        'favourites' => [
            'limit_reached' => '',
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
        ],

        'info' => [
            'description' => 'Description',
            'genre' => 'Genre',
            'language' => 'Langue',
            'no_scores' => 'Les données sont encore en cours de calcul...',
            'points-of-failure' => 'Répartition des échecs',
            'source' => 'Source',
            'success-rate' => 'Taux de réussite',
            'tags' => 'Tags',
            'unranked' => 'Beatmap non classée',
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
                'pp' => 'pp',
                'rank' => 'Rang',
                'score_total' => 'Score total',
                'score' => 'Score',
            ],

            'no_scores' => [
                'country' => 'Personne de votre pays n\'a encore fait un score !',
                'friend' => 'Aucun de vos amis n\'a de score sur cette map !',
                'global' => 'Pas de scores. Peut-être vous dans le classement ?',
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
    ],
];
