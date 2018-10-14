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
    'too_long' => ':attribute limite máximo excedido - só pode ser até :limit caracteres.',
    'wrong_confirmation' => 'A confirmação não corresponde.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'A discussão está bloqueada.',
        'first_post' => 'Não é possível eliminar uma publicação de começo.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'A marca de tempo está especificada mas o beatmap está em falta.',
        'beatmapset_no_hype' => "O beatmap não pode ser hypeado.",
        'hype_requires_null_beatmap' => 'O hype tem que ser feito na secção Geral (todas as dificuldades).',
        'invalid_beatmap_id' => 'Dificuldade especificada inválida.',
        'invalid_beatmapset_id' => 'Beatmap especificado inválido.',
        'locked' => 'A discussão está bloqueada.',

        'hype' => [
            'guest' => 'Tens que estar com a sessão iniciada para hypear.',
            'hyped' => 'Já hypeaste este beatmap.',
            'limit_exceeded' => 'Usaste todo o teu hype.',
            'not_hypeable' => 'Este beatmap não pode ser hypeado',
            'owner' => 'Nada de hypear o teu próprio beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'A marca de tempo especificada ultrapassa a duração do beatmap.',
            'negative' => "A marca de tempo não pode ser negativa.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Só se pode votar numa característica solicitada.',
            'not_enough_feature_votes' => 'Votos insuficientes.',
        ],

        'poll_vote' => [
            'invalid' => 'Opção especificada inválida.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Não é permitido eliminar a publicação dos metadados do beatmap.',
            'beatmapset_post_no_edit' => 'Não é permitido editar a publicação dos metadados do beatmap.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Uma opção duplicada não é permitida.',
            'invalid_max_options' => 'As opções por cada utilizador não podem exceder o número de opções disponíveis.',
            'minimum_one_selection' => 'Um mínimo de uma opção é necessária por utilizador.',
            'minimum_two_options' => 'São necessárias pelo menos duas opções.',
            'too_many_options' => 'Número máximo de opções permitidas excedido.',
        ],

        'topic_vote' => [
            'required' => 'Selecciona uma opção quando estiveres a votar.',
            'too_many' => 'Foram seleccionadas opções a mais do que as permitidas.',
        ],
    ],

    'user' => [
        'contains_username' => 'A palavra-passe não pode conter o nome de utilizador.',
        'email_already_used' => 'Endereço de email já usado.',
        'invalid_country' => 'País inexistente na base de dados.',
        'invalid_discord' => 'Nome de utilizador do Discord inválido.',
        'invalid_email' => "Não parece que seja um endereço de email válido.",
        'too_short' => 'A nova palavra-passe é demasiado curta.',
        'unknown_duplicate' => 'Nome de utilizador e endereço de e-mail já usados.',
        'username_available_in' => 'Este nome de utilizador irá estar disponível para uso em :duration.',
        'username_available_soon' => 'Este nome de utilizador irá estar disponível para uso em qualquer momento!',
        'username_invalid_characters' => 'O nome de utilizador solicitado contém caracteres inválidos.',
        'username_in_use' => 'Este nome de utilizador já está a ser usado!',
        'username_no_space_userscore_mix' => 'Por favor usa sublinhados ou espaços, não ambos!',
        'username_no_spaces' => "O nome de utilizador não pode começar ou acabar com espaços!",
        'username_not_allowed' => 'Esta escolha para nome de utilizador não é permitida.',
        'username_too_short' => 'O nome de utilizador solicitado é demasiado curto.',
        'username_too_long' => 'O nome de utilizador solicitado é demasiado longo.',
        'weak' => 'Palavra-passe colocada na lista-negra.',
        'wrong_current_password' => 'A palavra-passe actual está incorrecta.',
        'wrong_email_confirmation' => 'A confirmação do email não corresponde.',
        'wrong_password_confirmation' => 'A confirmação da palavra-passe não corresponde.',
        'too_long' => 'Comprimento máximo excedido - só pode ser até :limit caracteres.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Tu tens de ter :link para mudar o teu nome!',
                'link_text' => 'ajudaste o osu!',
            ],
            'username_is_same' => 'Este já é o teu nome de utilizador, tontinho!',
        ],
    ],
];
