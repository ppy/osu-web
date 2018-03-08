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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'Reviver',
            'regenerating' => 'Revivendo...',
            'remove' => 'Remover',
            'removing' => 'Removendo...',
        ],
        'show' => [
            'covers' => 'Gerenciar capas',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'ativar',
                'activate_confirm' => 'deseja ativar o modding v2 neste mapa?',
                'active' => 'ativo',
                'inactive' => 'inativo',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Excluir',

                'forum-name' => 'Fórum #:id: :name',

                'no-cover' => 'Nenhuma capa definida',

                'submit' => [
                    'save' => 'Salvar',
                    'update' => 'Atualizar',
                ],

                'title' => 'Lista de capas do fórum',

                'type-title' => [
                    'default-topic' => 'Capa padrão de tópico',
                    'main' => 'Capa do tópico',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Registros',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Coisinha fofa da administração. Desu~',

            'sections' => [
                'forum' => 'Fórum',
                'general' => 'Geral',
                'store' => 'Loja',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Lista de pedidos',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Este usuário está restrito.',
            'message' => '(só administradores conseguem ver isto)',
        ],
    ],

];
