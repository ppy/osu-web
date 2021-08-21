<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Échec pendant l\'actualisation du vote',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'accorder le kudosu',
        'beatmap_information' => 'Page de la beatmap',
        'delete' => 'supprimer',
        'deleted' => 'Supprimé par :editor :delete_time.',
        'deny_kudosu' => 'refuser le kudosu',
        'edit' => 'éditer',
        'edited' => 'Dernière modification par :editor il y a :update_time.',
        'guest' => 'Difficulté de l\'invité par :user',
        'kudosu_denied' => 'Le kudosu a été refusé pour ce post.',
        'message_placeholder_deleted_beatmap' => 'Cette difficulté a été supprimée, il n\'est plus possible d\'en discuter.',
        'message_placeholder_locked' => 'La discussion pour cette beatmap a été désactivée.',
        'message_placeholder_silenced' => "Impossible de publier la discussion en étant réduit au silence.",
        'message_type_select' => 'Sélectionnez un type de commentaire',
        'reply_notice' => 'Appuyez sur Entrée pour répondre.',
        'reply_placeholder' => 'Écrivez votre réponse ici',
        'require-login' => 'Veuillez vous connecter pour poster ou répondre',
        'resolved' => 'Résolu',
        'restore' => 'restaurer',
        'show_deleted' => 'Afficher le contenu supprimé',
        'title' => 'Discussions',

        'collapse' => [
            'all-collapse' => 'Tout réduire',
            'all-expand' => 'Tout développer ',
        ],

        'empty' => [
            'empty' => 'Pas de discussion !',
            'hidden' => 'Aucune discussion ne correspond à vos critères.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Verrouiller la discussion',
                'unlock' => 'Déverrouiller la discussion',
            ],

            'prompt' => [
                'lock' => 'Raison du verrouillage',
                'unlock' => 'Êtes-vous sûr de vouloir déverrouiller cette discussion ?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Ce post sera déplacé vers la discussion générale du beatmapset. Pour modder cette beatmap, indiquez le timestamp (ex. 00:12:345).',
            'in_timeline' => 'Pour modder plusieurs sections de cette beatmap, faites plusieurs posts (un post pour chaque section).',
        ],

        'message_placeholder' => [
            'general' => 'Écrivez ici pour poster dans Général (:version)',
            'generalAll' => 'Écrivez ici pour poster dans Général (Toutes les difficultés)',
            'review' => 'Tapez ici pour poster un commentaire',
            'timeline' => 'Écrivez ici pour poster dans la Chronologie (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Disqualifier',
            'hype' => 'Hype!',
            'mapper_note' => 'Note',
            'nomination_reset' => 'Réinitialiser la nomination',
            'praise' => 'Compliments',
            'problem' => 'Problème',
            'review' => 'Review',
            'suggestion' => 'Suggestion',
        ],

        'mode' => [
            'events' => 'Historique',
            'general' => 'Général :scope',
            'reviews' => 'Reviews',
            'timeline' => 'Chronologie',
            'scopes' => [
                'general' => 'Cette difficulté',
                'generalAll' => 'Toutes les difficultés',
            ],
        ],

        'new' => [
            'pin' => 'Épingler',
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl + c en mode édition et collez votre message pour ajouter un timestamp !',
            'title' => 'Nouvelle Discussion',
            'unpin' => 'Désépingler',
        ],

        'review' => [
            'new' => 'Nouveau commentaire',
            'embed' => [
                'delete' => 'Supprimer',
                'missing' => '[DISCUSSION SUPPRIMÉE]',
                'unlink' => 'Dissocier',
                'unsaved' => 'Non sauvegardé',
                'timestamp' => [
                    'all-diff' => 'Les messages sur "Toutes les difficultés" ne peuvent pas être horodatés.',
                    'diff' => 'Si :type commence par un horodatage, il sera affiché sous la chronologie.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'insérer un paragraphe',
                'praise' => 'insérer un compliment',
                'problem' => 'insérer un problème',
                'suggestion' => 'insérer une suggestion',
            ],
        ],

        'show' => [
            'title' => ':title mappé par :mapper',
        ],

        'sort' => [
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
            'loved' => 'Cette beatmap a été ajouté à loved le :date !',
            'ranked' => 'Cette beatmap a été classée le :date !',
            'wip' => 'Note: Cette beatmap a été marquée comme en cours de travail par son créateur.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Pas encore de votes négatifs',
                'up' => 'Pas encore de votes positifs',
            ],
            'latest' => [
                'down' => 'Derniers votes négatifs',
                'up' => 'Derniers votes positifs',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hyper la Beatmap !',
        'button_done' => 'Déjà Hypée !',
        'confirm' => "Êtes-vous sûr ? Ceci va utiliser un de vos :n hypes restants et l'action ne peut être annulée.",
        'explanation' => 'Hyper cette beatmap permet de la rendre plus visible pour sa nomination et son classement !',
        'explanation_guest' => 'Connectez-vous et hypez cette beatmap afin de la rendre plus visible pour sa nomination et son classement !',
        'new_time' => "Vous obtiendrez un point de hype dans :new_time.",
        'remaining' => 'Vous avez :remaining hypes restants.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Train de la hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Laisser un commentaire',
    ],

    'nominations' => [
        'delete' => 'Supprimer',
        'delete_own_confirm' => 'Êtes-vous sûr ? La beatmap sera supprimé et vous serez redirigé vers votre profil.',
        'delete_other_confirm' => 'Êtes-vous sûr ? La beatmap sera supprimée et vous serez redirigé vers le profil de l\'utilisateur.',
        'disqualification_prompt' => 'Raison de la disqualification ?',
        'disqualified_at' => 'disqualifiée :time_ago (:reason).',
        'disqualified_no_reason' => 'aucune raison spécifiée',
        'disqualify' => 'Disqualifiée',
        'incorrect_state' => 'Erreur lors de l\'action, merci de réessayer.',
        'love' => 'Aimer',
        'love_choose' => 'Choisissez la difficulté pour loved',
        'love_confirm' => 'Vous aimez cette beatmap ?',
        'nominate' => 'Nominer',
        'nominate_confirm' => 'Nominer cette beatmap?',
        'nominated_by' => 'nominée par :users',
        'not_enough_hype' => "Il n'y a pas assez de hype.",
        'remove_from_loved' => 'Retirer de Loved',
        'remove_from_loved_prompt' => 'Raison pour laquelle il a été retiré de Loved :',
        'required_text' => 'Nominations: :current/:required',
        'reset_message_deleted' => 'supprimée',
        'title' => 'Statut de la nomination',
        'unresolved_issues' => 'Il y a encore des questions non résolues qui doivent être traitées en priorité.',

        'rank_estimate' => [
            '_' => 'Cette map est estimée à être classée le :date si aucun problème n\'a été trouvé. Elle est #:position dans la :queue.',
            'queue' => 'file d\'attente de classement',
            'soon' => 'bientôt',
        ],

        'reset_at' => [
            'nomination_reset' => 'Le processus de nomination a été réinitialisé :time_ago par :user avec le nouveau problème :discussion (:message).',
            'disqualify' => 'Disqualifiée le :time_ago par :user avec le nouveau problème :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Êtes-vous sûr ? Poster un nouveau problème va réinitialiser le processus de nomination.',
            'disqualify' => 'Êtes-vous sûr? Cela va supprimer la beatmap de la qualification et réinitialiser le processus de nomination.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'tapez des mots-clés...',
            'login_required' => 'Connectez-vous pour rechercher.',
            'options' => 'Plus de critères de recherche',
            'supporter_filter' => 'Le filtrage par :filters requiert un tag osu!supporter actif',
            'not-found' => 'aucun résultat',
            'not-found-quote' => '... non, rien trouvé.',
            'filters' => [
                'extra' => 'Supplément',
                'general' => 'Général',
                'genre' => 'Genre',
                'language' => 'Langue',
                'mode' => 'Mode',
                'nsfw' => 'Contenu explicite',
                'played' => 'Jouée',
                'rank' => 'Rang Atteint',
                'status' => 'Catégories',
            ],
            'sorting' => [
                'title' => 'Titre',
                'artist' => 'Artiste',
                'difficulty' => 'Difficulté',
                'favourites' => 'Favoris',
                'updated' => 'Mise à jour',
                'ranked' => 'Classée',
                'rating' => 'Évaluation',
                'plays' => 'Parties',
                'relevance' => 'Pertinence',
                'nominations' => 'Nominations',
            ],
            'supporter_filter_quote' => [
                '_' => 'Le filtrage par :filters requiert un :link actif',
                'link_text' => 'tag osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Inclure les beatmaps converties',
        'follows' => 'Mappeurs abonnés',
        'recommended' => 'Difficulté recommandée',
    ],
    'mode' => [
        'all' => 'Tous',
        'any' => 'Tous',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Tous',
        'approved' => 'Approuvée',
        'favourites' => 'Favoris',
        'graveyard' => 'Cimetière',
        'leaderboard' => 'Avec un classement',
        'loved' => 'Loved',
        'mine' => 'Mes maps',
        'pending' => 'En attente & WIP',
        'qualified' => 'Qualifiée',
        'ranked' => 'Classée',
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
        'electronic' => 'Electronique',
        'metal' => 'Métal',
        'classical' => 'Classique',
        'folk' => 'Folk',
        'jazz' => 'Jazz',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
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
        'russian' => 'Russe',
        'polish' => 'Polonais',
        'instrumental' => 'Instrumentale',
        'other' => 'Autre',
        'unspecified' => 'Non spécifié',
    ],

    'nsfw' => [
        'exclude' => 'Masquer',
        'include' => 'Afficher',
    ],

    'played' => [
        'any' => 'Tous',
        'played' => 'Jouée',
        'unplayed' => 'Non jouée',
    ],
    'extra' => [
        'video' => 'Possède une vidéo',
        'storyboard' => 'Possède un storyboard',
    ],
    'rank' => [
        'any' => 'Tous',
        'XH' => 'SS argenté',
        'X' => '',
        'SH' => 'S argenté',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Nombre de joueurs : :count',
        'favourites' => 'Favorites : :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Tous',
        ],
    ],
];
