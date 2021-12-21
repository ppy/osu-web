<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Colecciones preempaquetadas de mapas basadas en un tema común.',
        'nav_title' => 'listado',
        'title' => 'Paquetes de Mapas',

        'blurb' => [
            'important' => 'LEE ESTO ANTES DE DESCARGAR',
            'install_instruction' => '',
            'note' => [
                '_' => 'También ten en cuenta que es muy recomendable :scary, ya que los mapas más antiguos son de mucha menor calidad que los mapas más recientes.',
                'scary' => 'descargar los paquetes de los más recientes a los más antiguos',
            ],
        ],
    ],

    'show' => [
        'download' => 'Descargar',
        'item' => [
            'cleared' => 'completado',
            'not_cleared' => 'no completado',
        ],
        'no_diff_reduction' => [
            '_' => ':link no pueden ser usados para completar este paquete.',
            'link' => 'Los mods de reducción de dificultad',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Álbum',
        'chart' => 'Destacados',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Necesitas tener la :link para descargar',
        'link_text' => 'sesión iniciada',
    ],
];
