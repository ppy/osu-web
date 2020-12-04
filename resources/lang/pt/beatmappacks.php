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
            'instruction' => [
                '_' => "Instalação: Uma vez transferido um pacote, extrai o .rar para o teu Diretório de Canções do osu!.
                    Todas as canções estão no formato .ZIP e/ou .OSZ dentro do pacote, por isso o osu! irá precisar de extrair, por si próprio, os beatmaps da próxima vez que fores para o Modo de jogo.
                    :scary extrai os ZIPs/OSZs por ti próprio,
                    ou os beatmaps vão-se apresentar de forma incorreta no osu! e não irão funcionar corretamente.",
                'scary' => 'NÃO',
            ],
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
