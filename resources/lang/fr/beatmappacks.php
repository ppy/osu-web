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
    'index' => [
        'blurb' => [
            'important' => 'LISEZ CECI AVANT DE TÉLÉCHARGER',
            'instruction' => [
                '_' => "Installation: Une fois la collection téléchargée, extraire le .rar dans le dossier Songs d'osu!.
                    Tous les sons sont encore en .zip et/ou en .osz dans la collection, donc osu! aura besoin d'extraire seul les beatmaps la prochaine fois que vous jouerez.
                    :scary extraire les zip/osz vous-même,
                    ou les beatmaps ne vont pas s'afficher correctement et osu! va mal fonctionner.",
                'scary' => 'Ne PAS',
            ],
            'note' => [
                '_' => "Notez aussi qu'il est recommandé de :scary, car les anciennes beatmaps sont de moins bonne qualité que les nouvelles beatmaps.",
                'scary' => 'télécharger les collections de la plus récente à la plus ancienne',
            ],
        ],
        'title' => 'Collections de Beatmaps',
        'description' => 'Collection de beatmaps basées sur un thème',
    ],
    'show' => [
        'download' => 'Télécharger',
        'item' => [
            'cleared' => 'terminé',
            'not_cleared' => 'non terminé',
        ],
    ],
    'mode' => [
        'artist' => 'Artiste/Album',
        // unsure for this
        'chart' => 'Classement',
        'standard' => 'Standard',
        'theme' => 'Thème',
    ],
    'require_login' => [
        '_' => 'Vous devez être :link pour télécharger',
        'link_text' => 'connecté',
    ],
];
