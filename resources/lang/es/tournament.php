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
    'index' => [
        'none_running' => 'No hay torneos en activos en este momento, ¡por favor vuelve más tarde!',
        'registration_period' => 'Inscripción: :start al :end',

        'header' => [
            'subtitle' => 'Una lista de torneos activos, y oficialmente reconocidos',
            'title' => 'Torneos de la comunidad',
        ],

        'item' => [
            'registered' => 'Jugadores registrados',
        ],

        'state' => [
            'current' => 'Torneos Activos',
            'previous' => 'Torneos Pasados',
        ],
    ],

    'show' => [
        'banner' => 'Apoya A Tu Equipo',
        'entered' => 'Estás inscrito para este torneo.<br> <br>Ten en cuenta que esto no significa que hayas sido asignado a un equipo.<br><br>Más instrucciones te serán enviadas por correo electrónico cercanos a la fecha del torneo, así que por favor ¡Asegúrate que tu dirección de correo electronico vinculado con tu cuenta de osu! sea valido!',
        'info_page' => 'Página de Información',
        'login_to_register' => '¡Por favor :login para ver los detalles de inscripción!',
        'not_yet_entered' => 'No estás inscrito en este torneo.',
        'rank_too_low' => '¡Lo sentimos, no cumples con los requisitos de rank para este torneo!',
        'registration_ends' => 'Las inscripciones se cierran en :date',

        'button' => [
            'cancel' => 'Cancelar inscripción',
            'register' => '¡Inscribirme!',
        ],

        'state' => [
            'before_registration' => 'La inscripción para este torneo aún no se ha abierto.',
            'ended' => 'Este torneo ha concluido. Visita la página de información para los resultados.',
            'registration_closed' => 'Registro para este torneo ha cerrado. Visite la página de información para las actualizaciones más recientes.',
            'running' => 'Este torneo está actualmente en curso. Visita la página de información para más detalles.',
        ],
    ],
    'tournament_period' => 'Desde el :start al :end',
];
