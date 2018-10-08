<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'not_negative' => ':attribute não pode ser negativo.',
    'required' => ':attribute é necessário.',
    'too_long' => ':attribute ultrapassou tamanho máximo - deve ser até :limit caracteres.',
    'wrong_confirmation' => 'Confirmação não confere.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Discussão está trancada.',
        'first_post' => 'Não é possível excluir a publicação inicial.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Marcação de tempo é especificada mas beatmap está faltando.',
        'beatmapset_no_hype' => "Beatmap não pode ser hypado.",
        'hype_requires_null_beatmap' => 'Hype deve ser feito na seção Geral (todas as dificuldades).',
        'invalid_beatmap_id' => 'Dificuldade inválida especificada.',
        'invalid_beatmapset_id' => 'Beatmap inválido especificado.',
        'locked' => 'Discussão está trancada.',

        'hype' => [
            'guest' => 'Precisa estar conectado para hypar.',
            'hyped' => 'Você já hypou este beatmap.',
            'limit_exceeded' => 'Você usou todo seu hype.',
            'not_hypeable' => 'Este beatmap não pode ser hypado',
            'owner' => 'Não é possível hypar seu próprio beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Marcação de tempo especificada ultrapassa a duração do beatmap.',
            'negative' => "Marcação de tempo não pode ser negativa.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Só pode votar um pedido de recurso.',
            'not_enough_feature_votes' => 'Sem votos suficientes.',
        ],

        'poll_vote' => [
            'invalid' => 'Opção inválida especificada.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Deletar postagem de metadados de um beatmap não é permitido.',
            'beatmapset_post_no_edit' => 'Editar postagem de metadados de um beatmap não é permitido.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opção duplicada não é permitida.',
            'invalid_max_options' => 'Opção por usuário não deve exceder o número de opções disponíveis.',
            'minimum_one_selection' => 'É necessário no mínimo uma opção por usuário.',
            'minimum_two_options' => 'É necessário no mínimo duas opções.',
            'too_many_options' => 'Número máximo de opções permitidas excedido.',
        ],

        'topic_vote' => [
            'required' => 'Selecione uma opção quando votar.',
            'too_many' => 'Mais opções selecionadas do que permitidas.',
        ],
    ],

    'user' => [
        'contains_username' => 'Senha não deve conter seu nome de usuário.',
        'email_already_used' => 'Email já utilizado.',
        'invalid_country' => 'País não presente no banco de dados.',
        'invalid_discord' => 'Nome de usuário do Discord inválido.',
        'invalid_email' => "Não parece ser um email válido.",
        'too_short' => 'Nova senha curta demais.',
        'unknown_duplicate' => 'Nome de usuário ou email já utilizado.',
        'username_available_in' => 'Este nome de usuário estará disponível em :duration.',
        'username_available_soon' => 'Este nome de usuário estará disponível a qualquer momento!',
        'username_invalid_characters' => 'O nome de usuário contém caracteres inválidos.',
        'username_in_use' => 'Nome de usuário já está em uso!',
        'username_no_space_userscore_mix' => 'Por favor use underscores ou espaços, não os dois!',
        'username_no_spaces' => "Nome de usuário não pode começar ou terminar com espaços!",
        'username_not_allowed' => 'Nome de usuário não permitido.',
        'username_too_short' => 'O nome de usuário é muito curto.',
        'username_too_long' => 'O nome de usuário é muito longo.',
        'weak' => 'Senha proibida.',
        'wrong_current_password' => 'Senha atual incorreta.',
        'wrong_email_confirmation' => 'Confirmação de email não confere.',
        'wrong_password_confirmation' => 'Confirmação de senha não confere.',
        'too_long' => 'ultrapassou tamanho máximo - deve ser até :limit caracteres.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Você precisa ser um :link para mudar seu nome de usuário!',
                'link_text' => 'osu!supporter',
            ],
            'username_is_same' => 'Este já é seu nome de usuário, bobinho!',
        ],
    ],
];
