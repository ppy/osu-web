<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'codes' => [
        'http-401' => 'Por favor, inicia sesión para continuar.',
        'http-403' => 'Acceso denegado.',
        'http-404' => 'No encontrado.',
        'http-429' => 'Demasiados intentos. Inténtalo de nuevo más tarde.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Ha ocurrido un error. Intenta refrescando la página.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Se ha especificado un modo inválido.',
        'standard_converts_only' => 'No hay puntuaciones disponibles para el modo solicitado en esta dificultad del mapa.',
    ],
    'checkout' => [
        'generic' => 'Ha ocurrido un error mientras preparábamos tu compra.',
    ],
    'search' => [
        'default' => 'No se obtuvo ningún resultado, inténtalo de nuevo más tarde.',
        'operation_timeout_exception' => 'La búsqueda está más ocupada de lo habitual, inténtalo de nuevo más tarde.',
    ],

    'logged_out' => 'Tu sesión ha expirado. Por favor, inicia sesión y vuelve a intentarlo.',
    'supporter_only' => 'Debes ser un osu!supporter para usar esta característica.',
    'no_restricted_access' => 'No puedes realizar esta acción mientras tu cuenta esté en estado restringido.',
    'unknown' => 'Se produjo un error desconocido.',
];
