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
    'not_negative' => ':attribute no puede ser negativo.',
    'required' => ':attribute es requerido.',
    'too_long' => ':attribute ha excedido el límite máximo - puede ser hasta :limit caractéres.',
    'wrong_confirmation' => 'La confirmación no coincide.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'La discusión está cerrada.',
        'first_post' => 'No se puede eliminar la publicación inicial.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'La marca de tiempo ha sido especificada pero el beatmap no se encontró.',
        'beatmapset_no_hype' => "El beatmap no puede ser hypeado.",
        'hype_requires_null_beatmap' => 'El hype debe ser realizado en la sección de General (todas las dificultades).',
        'invalid_beatmap_id' => 'Dificultad especificada inválida.',
        'invalid_beatmapset_id' => 'Beatmap especificado inválido',
        'locked' => 'La discusión está cerrada.',

        'hype' => [
            'guest' => 'Debes iniciar sesión para hypear.',
            'hyped' => 'Ya hypeaste este mapa.',
            'limit_exceeded' => 'Ya has utilizado todos tus hypes.',
            'not_hypeable' => 'Este beatmap no puede ser hypeado',
            'owner' => 'No puedes hypear tu propio beatmapa.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'La marca de tiempo especificada está más alla de la duración del beatmapa.',
            'negative' => "La marca de tiempo no puede ser negativa.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Solo se puede votar en solicitudes de características.',
            'not_enough_feature_votes' => 'Votos insuficientes.',
        ],

        'poll_vote' => [
            'invalid' => 'Opción especificada inválida.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Eliminar la publicación de los metadatos del beatmapa no está permitido.',
            'beatmapset_post_no_edit' => 'Editar la publicación de los metadatos del mapa no está permitido.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opciones duplicadas no permitidas.',
            'invalid_max_options' => 'La opciones por usuario no pueden exceder el número de opciones disponibles.',
            'minimum_one_selection' => 'Se requiere un mínimo de una opción por usuario.',
            'minimum_two_options' => 'Se necesitan al menos dos opciones.',
            'too_many_options' => 'Número de opciones permitidas excedidas.',
        ],

        'topic_vote' => [
            'required' => 'Selecciona una opción para votar.',
            'too_many' => 'Seleccionadas más opciones de las permitidas.',
        ],
    ],

    'user' => [
        'contains_username' => 'La contraseña no puede contener el nombre de usuario.',
        'email_already_used' => 'El correo electrónico ya está siendo utilizado.',
        'invalid_country' => 'El país no está en la base de datos.',
        'invalid_discord' => 'Usuario de Discord invalido.',
        'invalid_email' => "No parece que sea un correo electrónico valido.",
        'too_short' => 'La nueva contraseña es muy corta.',
        'unknown_duplicate' => 'El nombre de usuario o correo electrónico ya está siendo utilizado.',
        'username_available_in' => 'Este nombre de usuario estará disponible para su uso en :duration.',
        'username_available_soon' => '¡Este nombre de usuario estará disponible para su uso en cualquier momento!',
        'username_invalid_characters' => 'El nombre de usuario solicitado tiene carácteres inválidos.',
        'username_in_use' => '¡El nombre de usuario ya está en uso!',
        'username_no_space_userscore_mix' => 'Por favor utiliza guiones bajos o espacios, ¡no ambas!',
        'username_no_spaces' => "¡El nombre no puede iniciar o finalizar con espacios!",
        'username_not_allowed' => 'Esta elección de nombre de usuario no está permitida.',
        'username_too_short' => 'El nombre de usuario solicitado es muy corto.',
        'username_too_long' => 'El nombre de usuario solicitado es muy largo.',
        'weak' => 'Contraseña no permitida.',
        'wrong_current_password' => 'La contraseña actual es incorrecta.',
        'wrong_email_confirmation' => 'La confirmación de correo electrónico no coincide.',
        'wrong_password_confirmation' => 'La confirmación de contraseña no coincide.',
        'too_long' => 'Se excedió el límite máximo - puedes usar hasta :limit caracteres.',

        'change_username' => [
            'supporter_required' => [
                '_' => '¡Debes tener :link para cambiar tu nombre!',
                'link_text' => 'apoyar a osu!',
            ],
            'username_is_same' => '¡Este ya es tu nombre de usuario, tonto!',
        ],
    ],
];
