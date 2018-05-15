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
    'match' => [
        'header' => 'Partidas Multijugador',
        'team-types' => [
            'head-to-head' => 'Uno a uno',
            'tag-coop' => 'Tag Cooperativo',
            'team-vs' => 'Equipos',
            'tag-team-vs' => 'Tag Equipos',
        ],
        'events' => [
            'player-left' => ':user abandonó la partida',
            'player-joined' => ':user se unió a la partida',
            'player-kicked' => ':user ha sido expulsado de la partida',
            'match-created' => ':user creó la partida',
            'match-disbanded' => 'la partida fue disuelta',
            'host-changed' => ':user se convirtió en el anfitrión',

            'player-left-no-user' => 'un jugador abandonó la partida',
            'player-joined-no-user' => 'un jugador se unió a la partida',
            'player-kicked-no-user' => 'un jugador fue expulsado de la partida',
            'match-created-no-user' => 'la partida fue creada',
            'match-disbanded-no-user' => 'la partida fue disuelta',
            'host-changed-no-user' => 'el anfitrión ha cambiado',
        ],
        'in-progress' => '(partida en progreso)',
        'score' => [
            'stats' => [
                'accuracy' => 'Precisión',
                'combo' => 'Combo',
                'score' => 'Puntuación',
            ],
        ],
        'failed' => 'FALLIDO',
        'teams' => [
            'blue' => 'Equipo Azul',
            'red' => 'Equipo Rojo',
        ],
        'winner' => ':team gana',
        'difference' => 'por :difference',
        'loading-events' => 'Cargando eventos...',
        'more-events' => 'ver todo...',
        'beatmap-deleted' => 'beatmap eliminado',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Puntuación más alta',
            'accuracy' => 'Precisión más alta',
            'combo' => 'Combo más alto',
            'scorev2' => 'Puntuación V2',
        ],
    ],
];
