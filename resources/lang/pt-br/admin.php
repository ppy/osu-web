<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'show' => [
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'ativar',
                'activate_confirm' => 'ativar modding v2 para este beatmap?',
                'active' => 'ativo',
                'inactive' => 'inativo',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Deletar',

                'forum-name' => '#:id do Fórum: :name',

                'no-cover' => 'Sem capa definida',

                'submit' => [
                    'save' => 'Salvar',
                    'update' => 'Atualizar',
                ],

                'title' => 'Lista de Capas do Fórum',

                'type-title' => [
                    'default-topic' => 'Capa Padrão de Tópico',
                    'main' => 'Capa do Fórum',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Visualizador de Logs',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Console de Admin',

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
                'title' => 'Lista de Pedidos',
            ],
        ],
    ],

];
