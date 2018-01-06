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
        'deleted' => 'supprimé par :editor :delete_time.',
        'deny_kudosu' => 'refuser le kudosu',
        'edit' => 'éditer',
        'edited' => 'Dernière modification par :editor :update_time.',
        'kudosu_denied' => 'Interdit de recevoir des kudosu.',
        'message_placeholder' => 'Écrivez ici pour poster',
        'message_type_select' => 'Sélectionnez un type de commentaire',
        'reply_notice' => 'Appuyez sur entrée pour répondre.',
        'reply_placeholder' => 'Écrivez votre réponse ici',
        'require-login' => 'Veuillez vous connecter pour poster ou répondre',
        'resolved' => 'Résolu',
        'restore' => 'restaurer',
        'title' => 'Discussions',

        'collapse' => [
            'all-collapse' => 'Tout replier',
            'all-expand' => 'Tout déplier',
        ],

        'empty' => [
            'empty' => 'Pas de discussion !',
            'hidden' => 'Aucune discussion ne correspond à vos critères.',
        ],

        'message_hint' => [
            'in_general' => 'Ce post va aller dans la discussion générale du beatmapset. Pour modder cette beatmap, précisez le temps (ex. 00:12:345).',
            'in_timeline' => 'Pour modder plusieurs temps, faites plusieurs posts (un post par temps).',
        ],

        'message_type' => [
            'hype' => 'Hype!',
            'mapper_note' => 'Note',
            'praise' => 'Hommage',
            'problem' => 'Problème',
            'suggestion' => 'Suggestion',
        ],

        'mode' => [
            'events' => 'Histoire',
            'general' => 'Général',
            'general_all' => 'Général (toutes difficultées)',
            'timeline' => 'Chronologie',
        ],

        'new' => [
            'timestamp' => 'Horodatage',
            'timestamp_missing' => 'ctrl-c en mode édition et collez votre message pour ajouter un horodatage !',
            'title' => 'Nouvelle Discussion',
        ],

        'show' => [
            'title' => ':title mappée par :mappe',
        ],

        'sort' => [
            '_' => 'Trier par:',
            'created_at' => 'date de création',
            'timeline' => 'timeline',
            'updated_at' => 'last update',
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
            'approved' => 'Cette beatmap a été approuvée le :date!',
            'graveyard' => "Cette beatmap n'a pas été mise à jour depuis le :date et semble être abamdonnée par son créateur...",
            'loved' => 'Cette beatmap a été ajoutée aux aimées le :date!',
            'ranked' => 'Cette beatmap a été classée le :date!',
            'wip' => 'Note: Cette beatmap est amrquée en tant que work-in-progress par le créateur.',
        ],

    ],

    'hype' => [
        'button' => 'Hype la Beatmap !',
        'button_done' => 'Déjà Hypée !',
        'confirm' => 'Êtes-vous sûr ? Cela va utiliser un de vos :n hype restants et ne peut pas être annulé.',
        'explanation' => 'Hype cette beatmap pour la rendre plus visible pour la nomination et son classement !',
        'explanation_guest' => 'Connectes-toi et hype cette beatmap pour la nomination et son classement !',
        'new_time' => 'Vous aurez un nouveau hype le :new_time.',
        'remaining' => 'Il vous reste :remaining hype.',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'nominations' => [
        'disqualifed-at' => 'disqualifiée :time_ago (:reason).',
        'disqualifed_no_reason' => 'aucune raison spécifiée',
        'disqualification-prompt' => 'Raison de la disqualification?',
        'disqualify' => 'Disqualifier',
        'incorrect_state' => "Erreur lors de l'action, merci de réesayer.",
        'nominate' => 'Nominer',
        'nominated-by' => 'nominée par :users',
        'nominate-confirm' => 'Nominer cette beatmap?',
        'qualified' => "Map classée environ le :date, si aucun problème n'est trouvé.",
        'qualified-soon' => "Beatmap bientôt classée, si aucun problème n'est trouvé.",
        'reset-confirm' => 'Êtes-vous sûr ? Poster un nouveau problème réinitialisera la nomination.',
        'required-text' => 'Nominations: :current/:required',
        'title' => 'Statut de Nomination',
        'unresolved_issues' => "Il reste encore des problèmes non résolus qui doivent être d'abord corrigés.",
    ],

    'listing' => [
        'search' => [
            'prompt' => 'Tapez des mots-clés...',
            'options' => 'Plus de critères de recherche',
            'not-found' => 'Aucun résultat',
            'not-found-quote' => '... non, rien trouvé.',
            'filters' => [
                'mode' => 'Mode',
                'status' => 'Statut du Classement',
                'genre' => 'Genre',
                'language' => 'Langue',
                'extra' => 'supplément',
                'rank' => 'Rang Atteint',
            ],
        ],
        'mode' => 'Mode',
        'status' => 'Classification',
        'mapped-by' => 'mappé par :mapper',
        'source' => 'de :source',
        'load-more' => 'Charger plus',
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
        'qualified' => 'Qualifée',
        'loved' => 'Loved',
        'faves' => 'Favoris',
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
    'mods' => [
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'Sans mods',
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
    'extra' => [
        'video' => 'Avec vidéo',
        'storyboard' => 'Avec storyboard',
    ],
    'rank' => [
        'any' => "N'importe",
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
