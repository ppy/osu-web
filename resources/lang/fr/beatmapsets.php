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
    'availability' => [
        'disabled' => "Cette beatmap n'est actuellement pas disponible au téléchargement.",
        'parts-removed' => "Des parties de cette beatmap ont été supprimées suite à la requête du créateur ou d'un titulaire de droits tiers",
        'more-info' => "Voir ici pour plus d'informations.",
    ],

    'index' => [
        'title' => 'Liste des beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discussion',

        'details' => [
            'made-by' => 'créée par ',
            'submitted' => 'envoyée le ',
            'updated' => 'dernière mise à jour le ',
            'ranked' => 'classifiée le ',
            'approved' => 'approuvée le ',
            'qualified' => 'qualifiée le ',
            'loved' => 'loved le ',
            'logged-out' => 'Vous devez vous connecter avant de télécharger des beatmaps !',
            'download' => [
                '_' => 'télécharger',
                'video' => 'avec Vidéo',
                'no-video' => 'sans Vidéo',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Ajouter ce beatmapset aux favoris',
            'unfavourite' => 'Retirer ce beatmapset des favoris',
        ],
        'stats' => [
            'cs' => 'Taille des Cercles',
            'cs-mania' => 'Nombre de touches',
            'drain' => 'Drainage PV',
            'accuracy' => 'Précision',
            'ar' => "Niveau d'approche",
            'stars' => 'Difficulté en étoiles',
            'total_length' => 'Longeur',
            'bpm' => 'BPM',
            'count_circles' => 'Nombre de Cercles',
            'count_sliders' => 'Nombre de Sliders',
            'user-rating' => 'Évaluation des joueurs',
            'rating-spread' => 'Propagation note',
        ],
        'info' => [
            'no_scores' => 'Beatmap non classifiée',
            'points-of-failure' => 'Points de ratés',
            'success-rate' => 'Taux de réussite',

            'description' => 'Description',

            'source' => 'Source',
            'tags' => 'Tags',
        ],
        'scoreboard' => [
            'achieved' => 'atteint :when',
            'country' => 'Classement national',
            'friend' => 'Classement des amis',
            'global' => 'Classement global',
            'supporter-link' => 'Cliquez <a href=":link">ici</a> pour connaître toutes les supers fonctions obtenues avec !',
            'supporter-only' => 'Vous devez être osu!supporter pour accéder à cette fonctionnalité !',
            'title' => 'Tableaux des scores',

            'list' => [
                'accuracy' => 'Précision',
                'player-header' => 'Joueur',
                'rank-header' => 'Rang',
                'score' => 'Score',
            ],
            'no_scores' => [
                'country' => "Personne de votre pays n'a encore fait un score !",
                'friend' => "Personnne de vos amis n'a encore fait un score !",
                'global' => 'Pas de scores. Peut-être vous dans le classement ?',
                'loading' => 'Chargement des scores...',
                'unranked' => 'Beatmap non classifié.',
            ],
            'score' => [
                'first' => 'En Tête',
                'own' => 'Votre meilleur',
            ],
        ],
    ],
];
