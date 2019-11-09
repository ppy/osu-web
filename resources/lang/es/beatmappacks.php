<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'index' => [
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
        'title' => 'Paquetes de Beatmap',
        'description' => 'Colecciones preempaquetadas de beatmaps basadas en un tema común.',
    ],

    'show' => [
        'back' => '',
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
