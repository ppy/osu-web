<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Coleções pré-empacotadas de beatmaps baseadas num tema em comum.',
        'nav_title' => 'listagem',
        'title' => 'Pacotes de beatmap',

        'blurb' => [
            'important' => 'LÊ ISTO ANTES DE TRANSFERIR',
            'install_instruction' => 'Instalação: Assim que um pacote for transferido, extrai o seu conteúdo no teu diretório Songs do osu! e ele fará o resto.',
            'note' => [
                '_' => 'Toma nota de que também é altamente recomendado :scary, já que os mapas mais velhos são de menor qualidade do que os mapas mais recentes.',
                'scary' => 'transferir os pacotes do mais velho para o mais novo',
            ],
        ],
    ],

    'show' => [
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
        'standard' => 'Padrão',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Tu precisas de estar :link para transferir',
        'link_text' => 'autenticado',
    ],
];
