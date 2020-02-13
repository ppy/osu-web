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
    'index' => [
        'description' => 'Colecciones preempaquetadas de beatmaps basadas en un tema común.',
        'nav_title' => 'listado',
        'title' => 'Paquetes de Beatmap',

        'blurb' => [
            'important' => 'LEE ESTO ANTES DE DESCARGAR',
            'instruction' => [
                '_' => "Instalación: Una vez que un paquete haya sido descargado, extrae el archivo .rar en tu carpeta de canciones de osu!.
                    Todas las canciones siguen en formato .zip y/o .osz dentro del paquete, así que osu! necesitará extraer los beatmaps por sí mismo la próxima vez que ingreses en Modos de Juego.
                    :scary extraigas los zip's/osz's por ti mismo,
                    o los beatmaps se mostratran incorrectamente en osu!, y no funcionarán correctamente.",
                'scary' => 'NUNCA',
            ],
            'note' => [
                '_' => 'También ten en cuenta que es muy recomendable :scary, ya que los mapas más antiguos son de mucha menor calidad que los mapas más recientes.',
                'scary' => 'descargar los paquetes de los más recientes a los más antiguos',
            ],
        ],
    ],

    'show' => [
        'download' => 'Descargar',
        'item' => [
            'cleared' => 'procesado',
            'not_cleared' => 'no procesado',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Álbum',
        'chart' => 'Destacados',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Necesitas :link para descargar',
        'link_text' => 'sesión iniciada',
    ],
];
