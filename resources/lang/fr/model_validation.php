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
    'not_negative' => ':attribute ne peut être négatif.',
    'required' => ':attribute est requis.',
    'too_long' => ':attribute dépasse la longeur maximale - elle est de :limit caractères.',
    'wrong_confirmation' => 'La confirmation ne correspond pas.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'La discussion est verrouillée.',
        'first_post' => 'Impossible de supprimer le post de départ.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'L\'horodatage est correct, mais la beatmap est introuvable.',
        'beatmapset_no_hype' => "Cette beatmap ne peut pas être hypée.",
        'hype_requires_null_beatmap' => 'La hype doit être réalisée dans la section Général (toutes les difficultés).',
        'invalid_beatmap_id' => 'Difficulté spécifiée invalide.',
        'invalid_beatmapset_id' => 'Beatmap spécifiée invalide',
        'locked' => 'La discussion est verrouillée.',

        'hype' => [
            'guest' => 'Vous devez être connecté pour hyper.',
            'hyped' => 'Vous avez déjà hypé cette beatmap.',
            'limit_exceeded' => 'Vous avez utilisé toute votre hype.',
            'not_hypeable' => 'Cette beatmap ne peut pas être hypée',
            'owner' => 'Vous ne pouvez pas hyper votre propre beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'L\'horodotage spécifié dépasse la longueur de la beatmap',
            'negative' => "L'horodotage ne peut pas être négatif",
        ],
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
        ],

        'topic_poll' => [
            'duplicate_options' => 'Les options dupliquées ne sont pas autorisées.',
            'invalid_max_options' => 'Le nombre de réponses par utilisateur ne devrait pas dépasser le nombre de réponses.',
            'minimum_one_selection' => 'Un minimum d\'une réponse par utilisateur est nécessaire.',
            'minimum_two_options' => 'Au moins 2 réponses nécéssaires.',
            'too_many_options' => 'Nombre maximal de réponses dépassés.',
        ],

        'topic_vote' => [
            'required' => 'Séléctionnez une option pour voter.',
            'too_many' => 'Vous avez choisi trop de réponses.',
        ],
    ],

    'user' => [
        'contains_username' => 'Le mot de passe ne doit pas contenir de nom d\'utilisateur.',
        'email_already_used' => 'Adresse email déjà utilisée.',
        'invalid_country' => 'Le pays n\'est pas dans la base de données.',
        'invalid_discord' => 'Nom d\'utilisateur Discord invalide.',
        'invalid_email' => "Ça ne semble pas être une adresse email valide.",
        'too_short' => 'Le nouveau mot de passe est trop court.',
        'unknown_duplicate' => 'Nom d\'utilisateur ou adresse e-mail déjà utilisée.',
        'username_available_in' => 'Ce nom d\'utilisateur sera disponible dans :duration.',
        'username_available_soon' => 'Ce nom d\'utilisateur sera disponible dans quelques instants !',
        'username_invalid_characters' => 'Le nom d\'utilisateur contient des caractères invalides.',
        'username_in_use' => 'Le nom d\'utilisateur est déjà utilisé !',
        'username_no_space_userscore_mix' => 'Merci d\'utiliser soit des underscores ou des espaces, pas les deux ensemble !',
        'username_no_spaces' => "Le nom d'utilisateur ne peut pas commencer ou terminer avec des espaces",
        'username_not_allowed' => 'Ce nom d\'utilisateur n\'est pas autorisé.',
        'username_too_short' => 'Le nom d\'utilisateur est trop court.',
        'username_too_long' => 'Le nom d\'utilisateur est trop long.',
        'weak' => 'Mot de passe interdit.',
        'wrong_current_password' => 'Le mot de passe actuel est incorrect.',
        'wrong_email_confirmation' => 'La confirmation de l\'email ne correspond pas.',
        'wrong_password_confirmation' => 'La confirmation du mot de passe ne correspond pas.',
        'too_long' => 'Longueur maximale atteinte - elle est de :limit caractères.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Vous devez avoir :link pour changer votre nom !',
                'link_text' => 'supporté osu!',
            ],
            'username_is_same' => 'C\'est déjà votre nom d\'utilisateur en fait...',
        ],
    ],
];
