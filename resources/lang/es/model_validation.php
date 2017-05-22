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
    'required' => ':attribute es requerido.',
    'wrong_confirmation' => 'La confirmación no coincide.',

    'beatmap_discussion_post' => [
        'first_post' => 'No puedes eliminar la primera publicación.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Solo puedes votar en solicitudes de características.',
            'not_enough_feature_votes' => 'Votos insuficientes.',
        ],

         'poll_vote' => [
            'invalid' => 'Opción inválida.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opciones duplicadas no permitidas.',
            'invalid_max_options' => 'Opciones por usuario no pueden exceder el número de opciones disponibles.',
            'minimum_one_selection' => 'Se requiere un mínimo de una opción por usuario.',
            'minimum_two_options' => 'Se necesitan al menos dos opciones.',
            'too_many_options' => 'Número de opciones permitidas excedidas.',
        ],

        'topic_vote' => [
            'too_many' => 'Seleccionadas más opciones de las permitidas.',
        ],
    ],

    'user_email' => [
        'invalid' => 'No parece que haya un correo electrónico.',
        'already_used' => 'Correo electrónico ya en uso.',
        'wrong_confirmation' => 'La confirmación de correo electrónico no coincide.',
        'wrong_current_password' => 'Contraseña actual incorrecta.',
    ],

    'user_password' => [
        'contains_username' => 'La contraseña no puede contener el nombre de usuario.',
        'too_short' => 'La nueva contraseña es muy corta.',
        'weak' => 'Contraseña no permitida.',
        'wrong_confirmation' => 'La confirmación de contraseña no coincide.',
        'wrong_current_password' => 'La contraseña actual es incorrecta.',
    ],
];
