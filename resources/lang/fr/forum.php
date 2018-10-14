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
    'pinned_topics' => 'Sujets épinglés',
    'slogan' => "it's dangerous to play alone.",
    'subforums' => 'Sous-forums',
    'title' => 'osu! forum',

    'covers' => [
        'create' => [
            '_' => 'Définir la bannière',
            'button' => 'Uploader une image',
            'info' => 'La bannière devrait avoir les résolutions :dimensions. Vous pouvez aussi faire glisser l\'image ici pour l\'uploader',
        ],

        'destroy' => [
            '_' => 'Retirer la bannière',
            'confirm' => 'Êtes-vous sûr de supprimer la bannière ?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nouvelle réponse pour le sujet ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Pas de sujets!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Voulez-vous vraiment supprimer ce post ?',
        'confirm_restore' => 'Voulez-vous vraiment restaurer ce post ?',
        'edited' => 'Modifié par :user le :when, édité :count fois en tout.',
        'posted_at' => 'posté :when',

        'actions' => [
            'destroy' => 'Supprimer le post',
            'restore' => 'Restaurer le post',
            'edit' => 'Modifier le post',
        ],
    ],

    'search' => [
        'go_to_post' => 'Aller au post',
        'post_number_input' => 'entrer le numéro du post',
        'total_posts' => ':posts_count posts au total',
    ],

    'topic' => [
        'deleted' => 'sujet supprimé',
        'go_to_latest' => 'voir le dernier post',
        'latest_post' => ':when par :user',
        'latest_reply_by' => 'dernière réponse par :user',
        'new_topic' => 'Poster un nouveau sujet',
        'new_topic_login' => 'Connectez-vous pour poster un nouveau sujet',
        'post_reply' => 'Poster',
        'reply_box_placeholder' => 'Tapez ici pour répondre',
        'reply_title_prefix' => 'Re',
        'started_by' => 'par :user',
        'started_by_verbose' => 'suivi par :user',

        'create' => [
            'preview' => 'Prévisualisation',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Écrire',
            'submit' => 'Poster',

            'necropost' => [
                'default' => 'Cette discussion a été inactive depuis un certain temps. Postez ici seulement si vous avez une raison particulière de le faire.',

                'new_topic' => [
                    '_' => "Cette discussion a été inactive pendant un certain temps. Si vous n’avez pas de raison particulière de poster ici, s’il vous plaît :create au lieu de cela.",
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
            'next' => 'passer de 10 posts suivants',
            'previous' => 'revenir 10 posts en arrière',
        ],

        'post_edit' => [
            'cancel' => 'Annuler',
            'post' => 'Sauvegarder',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Abonnements aux Sujets',
            'title_compact' => 'abonnements',
            'title_main' => '<strong>Abonnements</strong> aux Sujets',

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
                'confirmation' => 'Se désabonner du sujet?',
                'title' => 'Désabonner',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Sujets',

        'actions' => [
            'login_reply' => 'Connectez-vous pour Répondre',
            'reply' => 'Répondre',
            'reply_with_quote' => 'Citer un post et répondre',
            'search' => 'Rechercher',
        ],

        'create' => [
            'create_poll' => 'Créer un sondage',

            'create_poll_button' => [
                'add' => 'Créer un sondage',
                'remove' => 'Annuler la création du sondage',
            ],

            'poll' => [
                'length' => 'Durée du sondage',
                'length_days_suffix' => 'jours',
                'length_info' => 'Laissez vide pour un sondage sans fin',
                'max_options' => 'Réponses par utlisateur',
                'max_options_info' => 'C\'est le nombre de réponses qu\'un utilisateur peut choisir.',
                'options' => 'Réponses',
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
            'views' => 'vues',
            'replies' => 'réponses',
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
            'to_0_done' => 'Le sujet a été déverrouillé',
            'to_1' => 'Verrouiller le sujet',
            'to_1_done' => 'Le sujet a été verrouillé',
        ],

        'moderate_move' => [
            'title' => 'Se déplacer dans un autre forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Désépingler le sujet',
            'to_0_done' => 'Le sujet a été désépinglé',
            'to_1' => 'Épingler le sujet',
            'to_1_done' => 'Le sujet a été épinglé',
            'to_2' => 'Épingler le sujet et marquer en tant qu\'annonce',
            'to_2_done' => 'Le sujet a été épinglé et marqué en tant qu\'annonce',
        ],

        'show' => [
            'deleted-posts' => 'Posts Supprimés',
            'total_posts' => 'Total des Posts',

            'feature_vote' => [
                'current' => 'Priorité : +:count',
                'do' => 'Promouvoir cette requête',

                'user' => [
                    'count' => '{0} pas de vote|{1} :count vote|[2,*] :count votes',
                    'current' => 'Il vous reste :votes.',
                    'not_enough' => "Vous n'avez plus de votes disponibles",
                ],
            ],

            'poll' => [
                'vote' => 'Voter',

                'detail' => [
                    'end_time' => 'Le sondage termine à :time',
                    'ended' => 'Sondage terminé :time',
                    'total' => 'Total de votes: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Vous ne suivez pas ce sujet',
            'to_watching' => 'Suivre',
            'to_watching_mail' => 'Suivre avec notifications',
            'mail_disable' => 'Désactiver les notifications',
        ],
    ],
];
