<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute spécifié non valide.',
    'not_negative' => ':attribute ne peut être négatif.',
    'required' => ':attribute est requis.',
    'too_long' => ':attribute dépasse la longeur maximale - elle est de :limit caractères.',
    'wrong_confirmation' => 'La confirmation ne correspond pas.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'L\'horodatage est correct, mais la beatmap est introuvable.',
        'beatmapset_no_hype' => "Cette beatmap ne peut pas être hypée.",
        'hype_requires_null_beatmap' => 'La hype doit être réalisée dans la section Général (toutes les difficultés).',
        'invalid_beatmap_id' => 'Difficulté spécifiée invalide.',
        'invalid_beatmapset_id' => 'Beatmap spécifiée invalide',
        'locked' => 'La discussion est verrouillée.',

        'attributes' => [
            'message_type' => 'Type de message',
            'timestamp' => 'Horodatage',
        ],

        'hype' => [
            'discussion_locked' => "Cette beatmap est actuellement verrouillée et ne peut pas être hypée",
            'guest' => 'Vous devez être connecté pour hyper.',
            'hyped' => 'Vous avez déjà hypé cette beatmap.',
            'limit_exceeded' => 'Vous avez utilisé tous vos hypes.',
            'not_hypeable' => 'Cette beatmap ne peut pas être hypée',
            'owner' => 'Vous ne pouvez pas hyper votre propre beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'L\'horodotage spécifié dépasse la longueur de la beatmap',
            'negative' => "L'horodotage ne peut pas être négatif",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'La discussion est verrouillée.',
        'first_post' => 'Impossible de supprimer le message de départ.',

        'attributes' => [
            'message' => 'Le message',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Vous ne pouvez pas répondre à un commentaire supprimé.',
        'top_only' => 'Vous ne pouvez pas épingler un commentaire.',

        'attributes' => [
            'message' => 'Le message',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute spécifié non valide.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Vous pouvez seulement voter pour une fonction.',
            'not_enough_feature_votes' => 'Pas assez de votes.',
        ],

        'poll_vote' => [
            'invalid' => 'Option invalide spécifiée.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Supprimer les métadonnées d\'une beatmap n\'est pas autorisé.',
            'beatmapset_post_no_edit' => 'Modifier les métadonnées d\'une beatmap n\'est pas autorisé.',
            'first_post_no_delete' => 'Impossible de supprimer le message de départ',
            'missing_topic' => 'Le message ne contient pas de sujet',
            'only_quote' => 'Votre réponse ne contient qu\'une citation.',

            'attributes' => [
                'post_text' => 'Contenu du post',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Titre du sujet',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Les options dupliquées ne sont pas autorisées.',
            'grace_period_expired' => 'Impossible d’éditer un sondage après plus de :limit heures.',
            'hiding_results_forever' => 'Impossible de masquer les résultats d\'un sondage à durée infinie.',
            'invalid_max_options' => 'Le nombre de réponses par utilisateur ne devrait pas dépasser le nombre de réponses.',
            'minimum_one_selection' => 'Un minimum d\'une réponse par utilisateur est nécessaire.',
            'minimum_two_options' => 'Au moins 2 réponses nécessaires.',
            'too_many_options' => 'Nombre maximal de réponses dépassés.',

            'attributes' => [
                'title' => 'Titre du sondage',
            ],
        ],

        'topic_vote' => [
            'required' => 'Sélectionnez une option pour voter.',
            'too_many' => 'Vous avez choisi trop de réponses.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Vous avez dépassé le nombre maximal d\'applications OAuth.',
            'url' => 'Veuillez saisir une URL valide.',

            'attributes' => [
                'name' => 'Nom de l\'application',
                'redirect' => 'Callback URL de l\'application',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Le mot de passe ne doit pas contenir votre nom d\'utilisateur.',
        'email_already_used' => 'Adresse email déjà utilisée.',
        'email_not_allowed' => 'Adresse e-mail non autorisée.',
        'invalid_country' => 'Ce pays n\'est pas dans la base de données.',
        'invalid_discord' => 'Nom d\'utilisateur Discord invalide.',
        'invalid_email' => "Ça ne semble pas être une adresse email valide.",
        'invalid_twitter' => 'Nom d\'utilisateur Twitter invalide.',
        'too_short' => 'Le nouveau mot de passe est trop court.',
        'unknown_duplicate' => 'Nom d\'utilisateur ou adresse e-mail déjà utilisée.',
        'username_available_in' => 'Ce nom d\'utilisateur sera disponible dans :duration.',
        'username_available_soon' => 'Ce nom d\'utilisateur sera disponible dans quelques instants !',
        'username_invalid_characters' => 'Ce nom d\'utilisateur contient des caractères invalides.',
        'username_in_use' => 'Ce nom d\'utilisateur est déjà utilisé !',
        'username_locked' => 'Ce nom d\'utilisateur est déjà utilisé !', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Merci d\'utiliser soit des underscores ou des espaces, pas les deux ensemble !',
        'username_no_spaces' => "Le nom d'utilisateur ne peut pas commencer ou terminer avec des espaces !",
        'username_not_allowed' => 'Ce nom d\'utilisateur n\'est pas autorisé.',
        'username_too_short' => 'Ce nom d\'utilisateur est trop court.',
        'username_too_long' => 'Ce nom d\'utilisateur est trop long.',
        'weak' => 'Mot de passe interdit.',
        'wrong_current_password' => 'Le mot de passe actuel est incorrect.',
        'wrong_email_confirmation' => 'Les deux adresses email ne correspondent pas.',
        'wrong_password_confirmation' => 'Les deux mots de passe ne correspondent pas.',
        'too_long' => 'Longueur maximale atteinte - elle est de :limit caractères.',

        'attributes' => [
            'username' => 'Nom d\'utilisateur',
            'user_email' => 'Adresse e-mail',
            'password' => 'Mot de passe',
        ],

        'change_username' => [
            'restricted' => 'Vous ne pouvez pas changer votre nom d\'utilisateur lorsque votre compte est restreint.',
            'supporter_required' => [
                '_' => 'Vous devez avoir eu :link pour changer votre nom !',
                'link_text' => 'un osu!supporter',
            ],
            'username_is_same' => 'C\'est déjà votre nom d\'utilisateur en fait...',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Les beatmaps classées ne peuvent pas être signalées',
        'reason_not_valid' => ':reason n\'est pas valide pour ce type de signalement.',
        'self' => "Vous ne pouvez pas vous signaler vous-même !",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Quantité',
                'cost' => 'Coût',
            ],
        ],
    ],
];
