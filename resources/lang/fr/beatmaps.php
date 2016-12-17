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
            'error' => 'Impossible d\'enregistrer le message',
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
            'empty' => 'Aucune discussion pour le moment !',
            'filtered' => 'Aucune discussion ne correspond à vos critères.',
        ],
        'message_hint' => [
            'in_general' => 'Ce message sera envoyé dans le fil de discussion de cette beatmap. Si vous souhaitez la modder, veuillez commencer ce message avec les coordonnées temporelles d\'un objet (ex. 00:12:345).',
            'in_timeline' => 'Si vous désirez modder plusieurs objets, refaites un nouveau message à chaque fois (un message par objet).',
        ],
        'message_placeholder' => 'Écrivez ici pour poster',
        'message_type' => [
            'praise' => 'Éloge',
            'problem' => 'Problème',
            'suggestion' => 'Suggestion',
        ],
        'message_type_select' => 'Sélectionnez le type de commentaire',
        'mode' => [
            'general' => 'Général',
            'timeline' => 'Chronologie',
        ],
        'require-login' => 'Veuillez vous connecter pour pouvoir poster ou répondre',
        'resolved' => 'Résolu',
        'show' => [
            'title' => ':title créée par :mapper',
        ],
        'stats' => [
            'mine' => 'Moi',
            'pending' => 'En attente',
            'praises' => 'Hommages',
            'resolved' => 'Résolu',
            'total' => 'Total',
            'deleted' => 'Supprimé',
        ],
        'delete' => 'supprimer',
        'deleted' => 'Supprimé par :editor le :delete_time',
        'new' => [
            'timestamp' => 'Coordonnée Temporelle',
            'timestamp_missing' => 'Copiez (ctrl-c) l\'objet que vous souhaitez modder dans l\'éditeur et copiez le dans votre message pour y ajouter ses coordonnées',
            'title' => 'Nouvelle Discussion',
        ],
        'reply_placeholder' => 'Entrez votre réponse ici',
        'restore' => 'rétablir ',
        'title' => 'Discussions',
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
                'submitted' => 'envoyée le',
                'ranked' => 'classifiée le',
                'logged-out' => 'Vous devez vous connecter avant de pouvoir télécharger des beatmaps !',
                'download' => [
                    '_' => 'Télécharger',
                    'no-video' => 'sans la vidéo',
                    'direct' => 'osu!direct',
                    'video' => 'avec la vidéo',
                ],
                'approved' => 'approuvée le',
                'favourite' => 'Ajouter cette beatmap à vos favoris',
                'qualified' => 'qualifiée le',
                'unfavourite' => 'Retirer cette beatmap de vos favoris',
                'updated' => 'dernière mise à jour le',
            ],
            'stats' => [
                'cs' => 'Taille des Cercles',
                'drain' => 'Drain des PV',
                'accuracy' => 'Précision',
                'ar' => 'Vitesse d\'Approche',
                'stars' => 'Étoiles de difficulté',
                'total_length' => 'Durée',
                'bpm' => 'BPM',
                'count_circles' => 'Nombre de Cercles',
                'count_sliders' => 'Nombre de Sliders',
                'cs-mania' => 'Nombre de Touches',
                'rating-spread' => 'Répartition des Notes',
                'user-rating' => 'Note des Joueurs',
            ],
            'info' => [
                'success-rate' => 'Taux de réussite',
                'points-of-failure' => 'Diagramme de non-réussite',
                'description' => 'Description',
                'source' => 'Source',
                'tags' => 'Tags',
            ],
            'scoreboard' => [
                'title' => 'Tableaux des scores',
                'no-scores' => [
                    'global' => 'Aucun score pour le moment. Peut-être devriez-vous essayer d\'en faire un !',
                    'loading' => 'Chargement des scores...',
                    'country' => 'Personne de votre pays n\'a encore fait de score !',
                    'friend' => 'Aucun de vos amis n\'a encore fait de score !',
                ],
                'supporter-only' => 'Vous devez être osu!supporter pour accéder à cette fonctionnalité !',
                'supporter-link' => 'Cliquez <a href=":link">ici</a> pour découvrir toutes les supers fonctionnalités que cela offre !',
                'global' => 'Classement mondial',
                'country' => 'Classement national',
                'friend' => 'Classement des amis',
                'stats' => [
                    'accuracy' => 'Précision',
                    'score' => 'Score',
                    'count100' => '100',
                    'count300' => '300',
                    'count50' => '50',
                    'countgeki' => 'MAX',
                    'countkatu' => '200',
                ],
                'list' => [
                    'rank-header' => 'Rang',
                    'player-header' => 'Joueur',
                    'score' => 'Score',
                    'accuracy' => 'Précision',
                ],
                'achieved' => 'accompli le :when',
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
        'graveyard' => 'Cimtière',
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
        'electronic' => 'Électronique',
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
        'video' => 'Avec une vidéo',
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
