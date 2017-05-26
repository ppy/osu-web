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
    'required' => ':attribute est requis.',
    'wrong_confirmation' => 'La confirmation ne correspond pas.',

    'beatmap_discussion_post' => [
        'first_post' => 'Impossible de supprimer le post de départ.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Vous pouvez seulement voter pour une fonction.',
            'not_enough_feature_votes' => 'Pas assez de votes.',
        ],

        'poll_vote' => [
            'invalid' => 'Option invalide spécifiée.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Les options dupliquées ne sont pas autorisées.',
            'invalid_max_options' => 'Le nombre de réponses par utilisateur ne devrait pas dépasser le nombre de réponses.',
            'minimum_one_selection' => "Un minimum d'une réponse par utilisateur est nécessaire.",
            'minimum_two_options' => 'Au moins 2 réponses nécéssaires.',
            'too_many_options' => 'Nombre maximal de réponses dépassés.',
        ],

        'topic_vote' => [
            'too_many' => 'Vous avez choisi trop de réponses.',
        ],
    ],

    'user_email' => [
        'invalid' => 'Ça ne semble pas être une adresse email.',
        'already_used' => 'Adresse email déjà utilisée.',
        'wrong_confirmation' => "La confirmation de l'email ne correspond pas.",
        'wrong_current_password' => "Le mot de passe actuel n'est pas correct.",
    ],

    'user_password' => [
        'contains_username' => "Le mot de passe ne doit pas contenir de nom d'utilisateur.",
        'too_short' => 'Le nouveau mot de passe est trop court.',
        'weak' => 'Mot de passe interdits.',
        'wrong_confirmation' => 'La confirmation du mot de passe ne correspond pas.',
        'wrong_current_password' => 'Le mot de passe actuel est incorrect.',
    ],
];
