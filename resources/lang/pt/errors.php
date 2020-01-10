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
        'http-401' => 'Por favor inicia sessão para proceder.',
        'http-403' => 'Acesso negado.',
        'http-404' => 'Não encontrado.',
        'http-429' => 'Demasiadas tentativas. Tenta novamente mais tarde.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Ocorreu um erro. Tenta recarregar a página.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Modo especificado inválido.',
        'standard_converts_only' => 'Não há pontuações disponíveis para o modo solicitado nesta dificuldade de beatmap.',
    ],
    'checkout' => [
        'generic' => 'Ocorreu um erro ao preparar o teu pagamento.',
    ],
    'search' => [
        'default' => 'Não foi possível obter nenhuns resultados, tenta outra vez mais tarde.',
        'operation_timeout_exception' => 'De momento, a pesquisa está mais ocupada que o habitual, tenta outra vez mais tarde.',
    ],

    'logged_out' => 'Foste desconectado. Por favor inicia sessão e tenta outra vez.',
    'supporter_only' => 'Tens de ser um apoiante para utilizar esta funcionalidade.',
    'no_restricted_access' => 'Tu não és capaz de desempenhar esta ação enquanto a tua conta estiver num estado restrito.',
    'unknown' => 'Ocorreu um erro desconhecido.',
];
