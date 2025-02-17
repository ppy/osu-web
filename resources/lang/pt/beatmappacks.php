<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Coleções pré-empacotadas de beatmaps baseadas num tema em comum.',
        'empty' => 'Brevemente!',
        'nav_title' => 'listagem',
        'title' => 'Pacotes de beatmap',

        'blurb' => [
            'important' => 'LÊ ISTO ANTES DE TRANSFERIR',
            'install_instruction' => 'Instalação: Assim que um pacote for transferido, extrai o seu conteúdo na tua pasta Songs do osu! e ele fará o resto.',
        ],
    ],

    'show' => [
        'created_by' => '',
        'download' => 'Transferir',
        'item' => [
            'cleared' => 'concluído',
            'not_cleared' => 'não concluído',
        ],
        'no_diff_reduction' => [
            '_' => ':link não poderá ser usado para limpar este pacote.',
            'link' => 'Mods de redução da dificuldade',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Álbum',
        'chart' => 'Em destaque',
        'featured' => 'Artista Destacado',
        'loved' => 'Project Loved',
        'standard' => 'Padrão',
        'theme' => 'Tema',
        'tournament' => 'Torneio',
    ],

    'require_login' => [
        '_' => 'Tu precisas de estar :link para transferir',
        'link_text' => 'autenticado',
    ],
];
