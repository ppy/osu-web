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
        'blurb' => [
            'important' => 'LEE ESTO ANTES DE DESCARGAR',
            'instruction' => [
                '_' => "Instalación: Una vez que un paquete ha sido descargado, extrae el .rar en tu carpeta de canciones de osu!.
                    Todas las canciones siguen en formato zip y/o .osz dentro del paquete, así que osu! necesitará extraer los mapas por sí mismo la próxima vez que ingreses al modo de juego.
                    :scary extraigas los zip's/osz's por ti mismo,
                    o los beatmaps podrían desplegarse incorrectamente en osu! y no funcionarán correctamente.",
                'scary' => 'NUNCA',
            ],
            'note' => [
                '_' => 'También ten en cuenta que es altamente recomendado :scary, ya que a diferencia de los mapas recientes, los mapas antiguos tienen una calidad muy inferior.',
                'scary' => 'descargar los paquetes de los más recientes a los más antiguos',
            ],
        ],
        'title' => 'Paquetes de beatmap',
        'description' => 'Colecciones pre-empaquetadas de beatmaps basadas en un tema común.',
    ],
    'show' => [
        'download' => 'Descargar',
        'item' => [
            'cleared' => 'pasado',
            'not_cleared' => 'no pasado',
        ],
    ],
    'mode' => [
        'artist' => 'Artista/Álbum',
        'chart' => 'Listado',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],
    'require_login' => [
        '_' => 'Necesitas :link para descargar',
        'link_text' => 'iniciar sesión',
    ],
];
