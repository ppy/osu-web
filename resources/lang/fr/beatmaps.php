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
    'discussion-posts' => [
        'store' => [
            'error' => 'Impossible de sauvegarder le post',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Impossible de modifier le vote',
        ],
    ],

    'discussions' => [
        'collapse' => [
            'all-collapse' => 'Tout replier',
            'all-expand' => 'Tout déplier',
        ],

        'edit' => 'Éditer',
        'edited' => 'Édité par :editor le :update_time',
        'empty' => [
            'empty' => 'Pas de discussion !',
            'filtered' => 'Aucune discussion ne correspond à vos critères.',
        ],

        'message_hint' => [
            'in_general' => 'Ce post va aller dans la discussion générale du beatmapset. Pour modder cette beatmap, précisez le temps (ex. 00:12:345).',
            'in_timeline' => 'Pour modder plusieurs temps, faites plusieurs posts (un post par temps).',
        ],

        'message_placeholder' => 'Tapez ici pour poster',

        'message_type' => [
            'praise' => 'Hommage',
            'problem' => 'Problème',
            'suggestion' => 'Suggestion',
        ],

        'message_type_select' => 'Séléctionner le type de commentaire',

        'mode' => [
            'general' => 'Général',
            'timeline' => 'Chronologie',
        ],

        'require-login' => 'Connectez-vous pour poster ou répondre',
        'resolved' => 'Résolu',

        'show' => [
            'title' => 'Discussion de la beatmap',
        ],

        'stats' => [
            'mine' => 'Moi',
            'pending' => 'En attente',
            'praises' => 'Hommages',
            'resolved' => 'Résolu',
            'total' => 'Total',
        ],
    ],

    'nominations' => [
        'disqualify' => 'Disqualifier',
        'nominate' => 'Nominer',
        'required-text' => 'Nominations: :current/:required',
        'disqualifed-at' => 'disqualifié :time_ago',
        'disqualification-prompt' => 'Raison de la disqualification?',
        'qualified' => 'Map classée environ le :date, si aucun problème n\'est trouvé.',
        'qualified-soon' => 'Beatmap bientôt classée, si aucun problème n\'est trouvé.',
        'incorrect-state' => 'Erreur lors de l\'action, merci de réesayer.',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'Tapez des mots-clés...',
            'options' => 'Plus de critères de recherche',
            'not-found' => 'Aucun résultat',
            'not-found-quote' => '... non, rien trouvé.',
        ],
        'mode' => 'Mode',
        'status' => 'Classification',
        'mapped-by' => 'mappé par :mapper',
        'source' => 'de :source',
        'load-more' => 'Charger plus',
    ],
    'beatmapset' => [
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
                'ar' => 'Niveau d\'approche',
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
                'title' => 'Tableaux des scores',
                'no-scores' => [
                    'global' => 'Pas de scores. Peut-être vous dans le classement?',
                    'loading' => 'Chargement des scores...',
                    'country' => 'Personne de votre pays n\'a encore fait un score!',
                    'friend' => 'Personnne de vos amis n\'a encore fait un score!',
                ],
                'supporter-only' => 'Vous devez être osu!supporter pour accéder à cette fonctionnalité!',
                'supporter-link' => 'Cliquez <a href=":link">ici</a> pour connaître toutes les supers fonctions obtenus avec!',
                'global' => 'Classement global',
                'country' => 'Classement national',
                'friend' => 'Classement des amis',
                'stats' => [
                    'accuracy' => 'Précision',
                    'score' => 'Score',
                ],
                'list' => [
                    'rank-header' => 'Rang',
                    'player-header' => 'Joueur',
                    'score' => 'Score',
                    'accuracy' => 'Précision',
                ],
            ],
        ],
    ],
    'mode' => [
        'any' => 'Tous',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Tous',
        'ranked-approved' => 'Classifié & approuvé',
        'approved' => 'Approuvé',
        'faves' => 'Favoris',
        'modreqs' => 'Requêtes de mods',
        'pending' => 'En attente',
        'graveyard' => 'Cimetière',
        'my-maps' => 'Mes maps',
    ],
    'genre' => [
        'any' => 'Tous',
        'unspecified' => 'Non spécifié',
        'video-game' => 'Jeu vidéo',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Autre',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
    ],
    'language' => [
    'any' => 'Tous',
    'english' => 'Anglais',
    'chinese' => 'Chinois',
    'french' => 'Français',
    'german' => 'Allemand',
    'italian' => 'Italien',
    'japanese' => 'Japonais',
    'korean' => 'Coréen',
    'spanish' => 'Espagnol',
    'swedish' => 'Suédois',
    'instrumental' => 'Instrumentales',
    'other' => 'Autre',
    ],
    'extra' => [
        'video' => 'Avec vidéo',
        'storyboard' => 'Avec un storyboard',
    ],
    'rank' => [
        'any' => 'Any',
        'XH' => 'SS d\'argent',
        'X' => 'SS',
        'SH' => 'S d\'argent',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
