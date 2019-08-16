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
        'blurb' => [
            'important' => 'LÊ ISTO ANTES DE TRANSFERIR',
            'instruction' => [
                '_' => "Instalação: Uma vez transferido um pacote, extrai o .rar para o teu Diretório de Canções do osu!.
                    Todas as canções estão .ZIPadas e/ou .OSZadas dentro do pacote, por isso o osu! irá precisar de extrair, por ele próprio, os beatmaps da próxima vez que fores para o Modo de jogo.
                    :scary extraias os ZIPs/OSZs por ti próprio,
                    ou os beatmaps vão-se apresentar de forma incorreta no osu! e não irão funcionar corretamente.",
                'scary' => 'NÃO',
            ],
            'note' => [
                '_' => 'Toma nota de que também é altamente recomendado :scary, já que os mapas mais velhos são de menor qualidade do que os mapas mais recentes.',
                'scary' => 'transferir os pacotes do mais velho para o mais novo',
            ],
        ],
        'title' => 'Pacotes Beatmap',
        'description' => 'Coleções pré-empacotadas de beatmaps baseadas num tema em comum.',
    ],

    'show' => [
        'download' => 'Transferir',
        'item' => [
            'cleared' => 'limpado',
            'not_cleared' => 'não limpado',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Álbum',
        'chart' => 'Em Destaque',
        'standard' => 'Padrão',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Tu precisas de estar :link para transferir',
        'link_text' => 'autenticado',
    ],
];
