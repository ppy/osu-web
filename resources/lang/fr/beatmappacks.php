<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'index' => [
        'blurb' => [
            'important' => 'LISEZ CECI AVANT DE TÉLÉCHARGER',
            'instruction' => [
                '_' => "Installation: Une fois la collection téléchargée, extraire le .rar dans le dossier Songs d'osu!.
                    Toutes les musiques sont encore en .zip et/ou en .osz dans la collection, osu! s'occupera d'extraire tout seul les beatmaps la prochaine fois que vous jouerez.
                    :scary extraire les zip/osz vous-même,
                    ou les beatmaps ne vont pas s'afficher correctement et osu! va mal fonctionner.",
                'scary' => 'Ne PAS',
            ],
            'note' => [
                '_' => 'Notez aussi qu\'il est recommandé de :scary, car les anciennes beatmaps sont de moins bonne qualité que les nouvelles beatmaps.',
                'scary' => 'télécharger les collections de la plus récente à la plus ancienne',
            ],
        ],
        'title' => 'Collections de Beatmaps',
        'description' => 'Collection de beatmaps basées sur un thème',
    ],

    'show' => [
        'back' => '',
        'download' => 'Télécharger',
        'item' => [
            'cleared' => 'terminé',
            'not_cleared' => 'non terminé',
        ],
    ],

    'mode' => [
        'artist' => 'Artiste/Album',
        'chart' => 'Classement',
        'standard' => 'Standard',
        'theme' => 'Thème',
    ],

    'require_login' => [
        '_' => 'Vous devez être :link pour télécharger',
        'link_text' => 'connecté',
    ],
];
