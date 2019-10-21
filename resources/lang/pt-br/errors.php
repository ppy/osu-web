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
    'codes' => [
        'http-401' => 'Por favor, inicie a sessão para continuar.',
        'http-403' => 'Acesso negado.',
        'http-404' => 'Não encontrado.',
        'http-429' => 'Muitas tentativas. Tente novamente mais tarde.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Ocorreu um erro. Tente atualizar a página.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Modo inválido especificado.',
        'standard_converts_only' => 'Não há pontuações disponíveis para o modo escolhido nesta dificuldade.',
    ],
    'checkout' => [
        'generic' => 'Ocorreu um erro durante o preparamento do seu pagamento.',
    ],
    'search' => [
        'default' => 'Não foi possível obter nenhum resultado, tente novamente mais tarde.',
        'operation_timeout_exception' => 'A busca está mais ocupada que o normal, tente novamente mais tarde.',
    ],

    'logged_out' => 'Você foi desconectado. Conecte-se e tente novamente.',
    'supporter_only' => 'Você precisa ser um osu!supporter para usar esta função.',
    'no_restricted_access' => 'Você não pode executar esta ação enquanto sua conta estiver restrita.',
    'unknown' => 'Ocorreu um erro desconhecido.',
];
