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
        'allow_kudosu' => 'accorder le kudosu',
        'delete' => 'supprimer',
        'deleted' => 'Supprimé par :editor :delete_time.',
        'deny_kudosu' => 'refuser le kudosu',
        'edit' => 'éditer',
        'edited' => 'Dernière modification par :editor :update_time',
        'kudosu_denied' => 'Le kudosu a été refusé pour ce post.',
        'message_placeholder_deleted_beatmap' => 'Cette difficulté a été supprimée, il n\'est plus possible d\'en discuter.',
        'message_type_select' => 'Sélectionnez un type de commentaire',
        'reply_notice' => 'Appuyez sur Entrée pour répondre.',
        'reply_placeholder' => 'Écrivez votre réponse ici',
        'require-login' => 'Connectez-vous pour poster ou répondre',
        'resolved' => 'Résolu',
        'restore' => 'restaurer',
        'title' => 'Discussions',

        'collapse' => [
            'all-collapse' => 'Tout replier',
            'all-expand' => 'Tout déplier',
        ],

        'empty' => [
            'empty' => 'Pas encore de discussion !',
            'hidden' => 'Aucune discussion ne correspond à vos critères.',
        ],

        'message_hint' => [
            'in_general' => 'Ce post va aller dans la discussion générale du beatmapset. Pour modder cette beatmap, précisez le temps (ex. 00:12:345).',
            'in_timeline' => 'Pour modder plusieurs temps, faites plusieurs posts (un post par temps).',
        ],

        'message_placeholder' => [
            'general' => 'Écrivez ici pour poster dans Général (:version)',
            'generalAll' => 'Écrivez ici pour poster dans Général (Toutes les difficultés)',
            'timeline' => 'Écrivez ici pour poster dans la Chronologie (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Disqualifier',
            'hype' => 'Hype!',
            'mapper_note' => 'Note',
            'nomination_reset' => 'Réinitialiser la nomination',
            'praise' => 'Hommage',
            'problem' => 'Problème',
            'suggestion' => 'Suggestion',
        ],

        'mode' => [
            'events' => 'Historique',
            'general' => 'General :scope',
            'timeline' => 'Chronologie',
            'scopes' => [
                'general' => 'Cette difficulté',
                'generalAll' => 'Toutes les difficultés',
            ],
        ],

        'new' => [
            'timestamp' => 'Horodatage',
            'timestamp_missing' => 'ctrl-c en mode édition et collez votre message pour ajouter un horodatage !',
            'title' => 'Nouvelle Discussion',
        ],

        'show' => [
            'title' => 'Discussion de la beatmap',
        ],

        'sort' => [
            '_' => 'Trier par:',
            'created_at' => 'Date de création',
            'timeline' => 'Chronologie',
            'updated_at' => 'Dernière mise à jour',
        ],

        'stats' => [
            'deleted' => 'Supprimé',
            'mapper_notes' => 'Notes',
            'mine' => 'Moi',
            'pending' => 'En attente',
            'praises' => 'Hommages',
            'resolved' => 'Résolu',
            'total' => 'Tout',
        ],

        'status-messages' => [
            'approved' => 'Cette beatmap a été approuvée le :date !',
            'graveyard' => "Cette beatmap n'a pas été modifiée depuis :date et a sûrement été abandonnée par son créateur...",
            'loved' => 'Cette beatmap a été ajoutée pour être loved le :date !',
            'ranked' => 'Cette beatmap a été classée le :date !',
            'wip' => 'Note: Cette beatmap a été marquée comme en cours de travail par son créateur.',
        ],

    ],

    'hype' => [
        'button' => 'Hyper la Beatmap !',
        'button_done' => 'Déjà hypée !',
        'confirm' => "Êtes-vous sûr ? Ceci va utiliser un de vos :n hypes restants et l'action ne peut être annulée.",
        'explanation' => 'Hyper cette beatmap permet de la rendre plus visible pour sa nomination et son classement !',
        'explanation_guest' => 'Connectez-vous et hypez cette beatmap afin de la rendre plus visible pour sa nomination et son classement !',
        'new_time' => "Vous obtiendrez un point de hype :new_time.",
        'remaining' => 'Vous avez :remaining hypes restants.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Train de la hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Laisser un avis',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Raison de la disqualification?',
        'disqualified_at' => 'disqualifiée :time_ago (:reason).',
        'disqualified_no_reason' => 'aucune raison spécifiée',
        'disqualify' => 'Disqualifier',
        'incorrect_state' => 'Erreur lors de l\'action, merci de réessayer.',
        'love' => 'Aimer',
        'love_confirm' => 'Vous aimez cette beatmap ?',
        'nominate' => 'Nominer',
        'nominate_confirm' => 'Nominer cette beatmap?',
        'nominated_by' => 'nominée par :users',
        'qualified' => 'La map sera classée le :date environ, si aucun problème n\'est trouvé.',
        'qualified_soon' => 'Beatmap bientôt classée, si aucun problème n\'est trouvé.',
        'required_text' => 'Nominations: :current/:required',
        'reset_message_deleted' => 'supprimé',
        'title' => 'Statut de la nomination',
        'unresolved_issues' => 'Il reste encore des problèmes à résoudre.',

        'reset_at' => [
            'nomination_reset' => 'Le processus de nomination a été réinitialisé :time_ago par :user avec le nouveau problème :discussion (:message).',
            'disqualify' => 'Disqualifiée :time_ago par :user avec le nouveau problème :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Êtes-vous sûr ? Poster un nouveau problème va réinitialiser le processus de nomination.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'Tapez des mots-clés...',
            'login_required' => 'Connectez-vous pour rechercher.',
            'options' => 'Plus de critères de recherche',
            'supporter_filter' => 'Le filtrage par :filters requiert un tag supporter osu! actif',
            'not-found' => 'Aucun résultat',
            'not-found-quote' => '... non, rien trouvé.',
            'filters' => [
                'general' => 'Général',
                'mode' => 'Mode',
                'status' => 'Catégories',
                'genre' => 'Genre',
                'language' => 'Langue',
                'extra' => 'supplément',
                'rank' => 'Rang Atteint',
                'played' => 'Jouée',
            ],
            'sorting' => [
                'title' => 'titre',
                'artist' => 'artiste',
                'difficulty' => 'difficulté',
                'updated' => 'mise à jour',
                'ranked' => 'classée',
                'rating' => 'évaluation',
                'plays' => 'parties',
                'relevance' => 'pertinence',
                'nominations' => 'nominations',
            ],
            'supporter_filter_quote' => [
                '_' => 'Le filtrage par :filters requiert un :link actif',
                'link_text' => 'tag supporter',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Difficulté recommandée',
        'converts' => 'Inclure les beatmaps converties',
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
        'ranked-approved' => 'Classifiée & approuvée',
        'approved' => 'Approuvée',
        'qualified' => 'Qualifiée',
        'loved' => 'Loved',
        'faves' => 'Favoris',
        'pending' => 'En attente & WIP',
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
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'Sans mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Appareil tactile',
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
        'instrumental' => 'Instrumentale',
        'other' => 'Autre',
    ],
    'played' => [
        'any' => 'Toutes',
        'played' => 'Jouée',
        'unplayed' => 'Non-jouée',
    ],
    'extra' => [
        'video' => 'Avec vidéo',
        'storyboard' => 'Avec storyboard',
    ],
    'rank' => [
        'any' => 'N\'importe',
        'XH' => 'SS argenté',
        'X' => 'SS',
        'SH' => 'S argenté',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
