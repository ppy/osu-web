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
    'required' => ':attribute é obrigatório.',
    'wrong_confirmation' => 'A confirmação não é igual.',

    'beatmap_discussion_post' => [
        'first_post' => 'Não é possível excluir a publicação inicial.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Só é possível votar em uma solicitação de recurso.',
            'not_enough_feature_votes' => 'Sem votos suficientes.',
        ],

        'poll_vote' => [
            'invalid' => 'Opção inválida especificada.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opção duplicada não é permitida.',
            'invalid_max_options' => 'Opção por usuário não pode exceder o número de opções disponíveis.',
            'minimum_one_selection' => 'Um mínimo de uma opção por usuário é necessária.',
            'minimum_two_options' => 'Precisa de pelo menos duas opções.',
            'too_many_options' => 'Excedeu o número máximo de opções permitidas.',
        ],

        'topic_vote' => [
            'too_many' => 'Selecionou mais opções do que o permitido.',
        ],
    ],

    'user_email' => [
        'invalid' => 'Não parece ser um endereço de e-mail.',
        'already_used' => 'Endereço de e-mail já usado.',
        'wrong_confirmation' => 'A confirmação de e-mail não corresponde.',
        'wrong_current_password' => 'Senha atual incorreta.',
    ],

    'user_password' => [
        'contains_username' => 'A senha não pode conter o nome de usuário.',
        'too_short' => 'A nova senha é muito curta.',
        'weak' => 'Senha na lista negra.',
        'wrong_confirmation' => 'A confirmação de senha não corresponde.',
        'wrong_current_password' => 'Senha atual incorreta.',
    ],
];
