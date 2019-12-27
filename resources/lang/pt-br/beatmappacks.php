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
        'description' => 'Coleções temáticas pré-compactadas.',
        'nav_title' => 'listagem',
        'title' => 'Pacotes de Beatmaps',

        'blurb' => [
            'important' => 'LEIA ISSO ANTES DE BAIXAR',
            'instruction' => [
                '_' => "Instalação: Assim que terminar de baixar um pacote, extraia o .rar na pasta Songs, no seu diretório do osu!.
                    Todos os arquivos estão compactados dentro do pacote, então o osu! precisará extrair os beatmaps por sí só na próxima vez que você entrar no jogo.
                    :scary tente descompactar os arquivos sozinho,
                    ou os beatmaps não funcionarão corretamente quando tentar abrí-los.",
                'scary' => 'NÃO',
            ],
            'note' => [
                '_' => 'Lembre-se que é altamente recomendado :scary, já que beatmaps mais antigos tem uma qualidade muito menor do que os mais recentes.',
                'scary' => 'baixar os pacotes de beatmaps dos mais recentes para os mais antigos',
            ],
        ],
    ],

    'show' => [
        'download' => 'Baixar',
        'item' => [
            'cleared' => 'finalizado',
            'not_cleared' => 'não finalizado',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Álbum',
        'chart' => 'Destaques',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Você precisa estar :link para baixar',
        'link_text' => 'conectado',
    ],
];
