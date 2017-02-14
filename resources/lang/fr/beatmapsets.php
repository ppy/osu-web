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
    'show' => [
        'details' => [
            'made-by' => 'créé par ',
            'submitted' => 'envoyé le ',
            'ranked' => 'classifié le ',
            'logged-out' => 'Vous devez vous connecter avant de télécharger des beatmaps!',
            'download' => [
                '_' => 'télécharger',
                'no-video' => 'sans la vidéo',
                'direct' => 'osu!direct',
            ],
        ],
        'stats' => [
            'cs' => 'Taille du cercle',
            'drain' => 'Drainage PV',
            'accuracy' => 'Précision',
            'ar' => "Niveau d'approche",
            'stars' => 'Difficulté étoiles',
            'total_length' => 'Longeur',
            'bpm' => 'BPM',
        ],
        'info' => [
            'success-rate' => 'Taux de réussite',
            'points-of-failure' => 'Points de ratés',

            'description' => 'Description',

            'source' => 'Source',
            'tags' => 'Tags',
        ],
        'scoreboard' => [
            'country' => 'Classement national',
            'friend' => 'Classement des amis',
            'global' => 'Classement global',
            'supporter-link' => 'Cliquez <a href=":link">ici</a> pour connaître toutes les supers fonctions obtenus avec!',
            'supporter-only' => 'Vous devez être osu!supporter pour accéder à cette fonctionnalité!',
            'title' => 'Tableaux des scores',

            'list' => [
                'accuracy' => 'Précision',
                'player-header' => 'Joueur',
                'rank-header' => 'Rang',
                'score' => 'Score',
            ],
            'no_scores' => [
                'country' => "Personne de votre pays n'a encore fait un score!",
                'friend' => "Personnne de vos amis n'a encore fait un score!",
                'global' => 'Pas de scores. Peut-être vous dans le classement?',
                'loading' => 'Chargement des scores...',
            ],
            'stats' => [
                'accuracy' => 'Précision',
                'score' => 'Score',
            ],
        ],
    ],
];
