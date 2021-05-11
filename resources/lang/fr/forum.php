<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Sujets épinglés',
    'slogan' => "c'est dangereux de jouer seul.",
    'subforums' => 'Sous-forums',
    'title' => 'Forums',

    'covers' => [
        'edit' => 'Modifier la couverture',

        'create' => [
            '_' => 'Définir l\'image de couverture',
            'button' => 'Télécharger la couverture',
            'info' => 'La bannière devrait avoir les résolutions :dimensions. Vous pouvez aussi faire glisser l\'image ici pour l\'uploader',
        ],

        'destroy' => [
            '_' => 'Retirer la bannière',
            'confirm' => 'Êtes-vous sûr de supprimer la bannière ?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Dernier message',

        'index' => [
            'title' => 'Accueil du forum',
        ],

        'topics' => [
            'empty' => 'Pas de sujets !',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Marquer le forum comme lu',
        'forums' => 'Marquer les forums comme lus',
        'busy' => 'Marquer comme lu...',
    ],

    'post' => [
        'confirm_destroy' => 'Voulez-vous vraiment supprimer ce post ?',
        'confirm_restore' => 'Voulez-vous vraiment restaurer ce post ?',
        'edited' => 'Dernière édition par :user :when, modifié :count_delimited fois au total.|Dernière édition par :user :when, modifié :count_delimited fois au total.',
        'posted_at' => 'posté le :when',
        'posted_by' => 'posté par :username',

        'actions' => [
            'destroy' => 'Supprimer le post',
            'edit' => 'Modifier le post',
            'report' => 'Signaler le post',
            'restore' => 'Restaurer le post',
        ],

        'create' => [
            'title' => [
                'reply' => 'Nouvelle réponse',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited discussion|:count_delimited discussions',
            'topic_starter' => 'Créateur du sujet',
        ],
    ],

    'search' => [
        'go_to_post' => 'Aller au post',
        'post_number_input' => 'entrer le numéro du post',
        'total_posts' => ':posts_count posts au total',
    ],

    'topic' => [
        'confirm_destroy' => 'Voulez-vous vraiment supprimer cette discussion ?',
        'confirm_restore' => 'Voulez-vous vraiment restaurer cette discussion ?',
        'deleted' => 'sujet supprimé',
        'go_to_latest' => 'voir le dernier post',
        'has_replied' => 'Vous avez répondu à ce sujet',
        'in_forum' => 'dans :forum',
        'latest_post' => ':when par :user',
        'latest_reply_by' => 'dernière réponse par :user',
        'new_topic' => 'Poster un nouveau sujet',
        'new_topic_login' => 'Connectez-vous pour poster un nouveau sujet',
        'post_reply' => 'Poster',
        'reply_box_placeholder' => 'Tapez ici pour répondre',
        'reply_title_prefix' => 'Re',
        'started_by' => 'par :user',
        'started_by_verbose' => 'suivi par :user',

        'actions' => [
            'destroy' => 'Supprimer le sujet',
            'restore' => 'Restaurer le sujet',
        ],

        'create' => [
            'close' => 'Fermer',
            'preview' => 'Prévisualisation',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Écrire',
            'submit' => 'Poster',

            'necropost' => [
                'default' => 'Ce sujet est inactif depuis un certain temps. Ne postez ici que si vous avez une raison spécifique de le faire.',

                'new_topic' => [
                    '_' => "Ce sujet est inactif depuis un certain temps. Si vous n'avez pas de raison spécifique de poster ici, merci de :create à la place.",
                    'create' => 'créer une nouvelle discussion',
                ],
            ],

            'placeholder' => [
                'body' => 'Tapez le contenu du post ici',
                'title' => 'Cliquez ici pour définir le titre du post',
            ],
        ],

        'jump' => [
            'enter' => 'cliquez pour entrer un numéro de post spécifique',
            'first' => 'aller au premier post',
            'last' => 'aller au dernier post',
            'next' => 'sauter les 10 prochains messages',
            'previous' => 'retournez 10 postes en arrière',
        ],

        'post_edit' => [
            'cancel' => 'Annuler',
            'post' => 'Sauvegarder',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'liste d\'abonnement des sujets du forum',

            'box' => [
                'total' => 'Sujets suivis',
                'unread' => 'Sujets avec nouvelles réponses',
            ],

            'info' => [
                'total' => 'Vous suivez un total de :total sujets.',
                'unread' => 'Vous avez :unread réponses non-lues aux sujets suivis.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Se désabonner du sujet ?',
                'title' => 'Désabonner',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Sujets',

        'actions' => [
            'login_reply' => 'Connectez-vous pour répondre',
            'reply' => 'Répondre',
            'reply_with_quote' => 'Citer un post et répondre',
            'search' => 'Rechercher',
        ],

        'create' => [
            'create_poll' => 'Créer un sondage',

            'preview' => 'Aperçu de la discussion',

            'create_poll_button' => [
                'add' => 'Créer un sondage',
                'remove' => 'Annuler la création du sondage',
            ],

            'poll' => [
                'hide_results' => 'Masquer les résultats du sondage.',
                'hide_results_info' => 'Ils ne seront affichés qu\'après la clôture du sondage.',
                'length' => 'Durée du sondage',
                'length_days_suffix' => 'jours',
                'length_info' => 'Laissez vide pour un sondage sans fin',
                'max_options' => 'Réponses par utilisateur',
                'max_options_info' => 'Il s\'agit du nombre d\'options que chaque utilisateur peut sélectionner lors du vote.',
                'options' => 'Options',
                'options_info' => 'Entrez chaque réponse sur une nouvelle ligne. Vous pouvez entrer jusqu\'à 10 réponses.',
                'title' => 'Question',
                'vote_change' => 'Autoriser le changement de vote.',
                'vote_change_info' => 'Si cette option est activée, les utilisateurs pourront changer leur vote.',
            ],
        ],

        'edit_title' => [
            'start' => 'Modifier le titre',
        ],

        'index' => [
            'feature_votes' => 'priorité d\'étoiles',
            'replies' => 'réponses',
            'views' => 'vues',
        ],

        'issue_tag_added' => [
            'to_0' => 'Supprimer le tag "added"',
            'to_0_done' => 'Tag "added" supprimé',
            'to_1' => 'Ajouter le tag "added"',
            'to_1_done' => 'Tag "added" ajouté',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Supprimer le tag "assigned"',
            'to_0_done' => 'Tag "assigned" supprimé',
            'to_1' => 'Ajouter le tag "assigned"',
            'to_1_done' => 'Tag "assigned" ajouté',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Supprimer le tag "confirmed"',
            'to_0_done' => 'Tag "confirmed" supprimé',
            'to_1' => 'Ajouter le tag "confirmed"',
            'to_1_done' => 'Tag "confirmed" ajouté',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Supprimer le tag "duplicate"',
            'to_0_done' => 'Tag "duplicate" supprimé',
            'to_1' => 'Ajouter le tag "duplicate"',
            'to_1_done' => 'Tag "duplicate" ajouté',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Supprimer le tag "invalid"',
            'to_0_done' => 'Tag "invalid" supprimé',
            'to_1' => 'Ajouter le tag "invalid"',
            'to_1_done' => 'Tag "invalid" ajouté',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Supprimer le tag "resolved"',
            'to_0_done' => 'Tag "resolved" supprimé',
            'to_1' => 'Ajouter le tag "resolved"',
            'to_1_done' => 'Tag "resolved" ajouté',
        ],

        'lock' => [
            'is_locked' => 'Ce sujet est verrouillé, vous ne pouvez pas y répondre',
            'to_0' => 'Déverrouiller le sujet',
            'to_0_confirm' => 'Déverrouiller le sujet ?',
            'to_0_done' => 'Le sujet a été déverrouillé',
            'to_1' => 'Verrouiller le sujet',
            'to_1_confirm' => 'Verrouiller le sujet ?',
            'to_1_done' => 'Le sujet a été verrouillé',
        ],

        'moderate_move' => [
            'title' => 'Déplacer vers un autre forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Désépingler le sujet',
            'to_0_confirm' => 'Désépingler le sujet ?',
            'to_0_done' => 'Le sujet a été désépinglé',
            'to_1' => 'Épingler le sujet',
            'to_1_confirm' => 'Épingler le sujet ?',
            'to_1_done' => 'Le sujet a été épinglé',
            'to_2' => 'Épingler le sujet et marquer en tant qu\'annonce',
            'to_2_confirm' => 'Épingler le sujet et le marquer en tant qu\'annonce ?',
            'to_2_done' => 'Le sujet a été épinglé et marqué en tant qu\'annonce',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Montrer les messages supprimés',
            'hide' => 'Masquer les messages supprimés',
        ],

        'show' => [
            'deleted-posts' => 'Posts supprimés',
            'total_posts' => 'Total des posts',

            'feature_vote' => [
                'current' => 'Priorité actuelle : +:count',
                'do' => 'Promouvoir cette requête',

                'info' => [
                    '_' => 'Il s\'agit d\'une :feature_request. Les demandes de fonctionnalité peuvent être votées par des :supporters.',
                    'feature_request' => 'demande de fonctionnalité',
                    'supporters' => 'supporters',
                ],

                'user' => [
                    'count' => '{0} pas de votes|{1} :count_delimited vote|[2,*] :count_delimited votes',
                    'current' => 'Il vous reste :votes.',
                    'not_enough' => "Vous n'avez plus de votes disponibles",
                ],
            ],

            'poll' => [
                'edit' => 'Édition du sondage',
                'edit_warning' => 'Éditer un sondage supprimera les résultats actuels !',
                'vote' => 'Voter',

                'button' => [
                    'change_vote' => 'Changer le vote',
                    'edit' => 'Éditer le sondage',
                    'view_results' => 'Passer aux résultats',
                    'vote' => 'Voter',
                ],

                'detail' => [
                    'end_time' => 'Le sondage se termine le :time',
                    'ended' => 'Sondage terminé le :time',
                    'results_hidden' => 'Les résultats seront affichés après la fin du sondage.',
                    'total' => 'Total de votes : :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Vous ne suivez pas ce sujet',
            'to_watching' => 'Suivre',
            'to_watching_mail' => 'Suivre avec notifications',
            'tooltip_mail_disable' => 'La notification est activée. Cliquez pour désactiver',
            'tooltip_mail_enable' => 'La notification est désactivée. Cliquez pour activer',
        ],
    ],
];
