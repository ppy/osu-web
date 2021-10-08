<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute especificado inválido.',
    'not_negative' => ':attribute não pode ser negativo.',
    'required' => ':attribute é necessário.',
    'too_long' => ':attribute limite máximo excedido - só pode ser até :limit caracteres.',
    'wrong_confirmation' => 'A confirmação não corresponde.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'A marca de tempo está especificada mas o beatmap está em falta.',
        'beatmapset_no_hype' => "O beatmap não pode ser hypeado.",
        'hype_requires_null_beatmap' => 'O hype tem que ser feito na secção Geral (todas as dificuldades).',
        'invalid_beatmap_id' => 'Dificuldade especificada inválida.',
        'invalid_beatmapset_id' => 'Beatmap especificado inválido.',
        'locked' => 'A discussão está bloqueada.',

        'attributes' => [
            'message_type' => 'Tipos de mensagem',
            'timestamp' => 'Marca de tempo',
        ],

        'hype' => [
            'discussion_locked' => "Este mapa está atualmente bloqueado para ser discutido e não pode ser publicado",
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

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'A discussão está bloqueada.',
        'first_post' => 'Não é possível eliminar uma publicação inicial.',

        'attributes' => [
            'message' => 'A mensagem',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Não é permitido responder a comentários eliminados.',
        'top_only' => 'Não é permitido afixar uma resposta a um comentário.',

        'attributes' => [
            'message' => 'A mensagem',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute especificado inválido.',
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
            'first_post_no_delete' => 'Não é possível apagar a publicação inicial',
            'missing_topic' => 'Está a faltar um tópico na publicação',
            'only_quote' => 'A tua resposta contém apenas uma citação.',

            'attributes' => [
                'post_text' => 'Corpo da publicação',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Título do tópico',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Uma opção duplicada não é permitida.',
            'grace_period_expired' => 'Não é possível editar uma sondagem depois de mais de :limit horas',
            'hiding_results_forever' => 'Não é possível esconder os resultados duma sondagem que nunca irá terminar.',
            'invalid_max_options' => 'As opções por cada utilizador não podem exceder o número de opções disponíveis.',
            'minimum_one_selection' => 'Um mínimo de uma opção é necessária por utilizador.',
            'minimum_two_options' => 'São necessárias pelo menos duas opções.',
            'too_many_options' => 'Número máximo de opções permitidas excedido.',

            'attributes' => [
                'title' => 'Título da sondagem',
            ],
        ],

        'topic_vote' => [
            'required' => 'Seleciona uma opção quando estiveres a votar.',
            'too_many' => 'Foram selecionadas opções a mais do que as permitidas.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Excedeste o n.º máximo de aplicações OAuth autorizadas.',
            'url' => 'Por favor insere um URL válido.',

            'attributes' => [
                'name' => 'Nome da aplicação',
                'redirect' => 'URL de recolha da aplicação',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'A palavra-passe não pode conter o nome de utilizador.',
        'email_already_used' => 'Endereço de email já usado.',
        'email_not_allowed' => 'Endereço de email não permitido.',
        'invalid_country' => 'País inexistente na base de dados.',
        'invalid_discord' => 'Nome de utilizador do Discord inválido.',
        'invalid_email' => "Não parece que seja um endereço de email válido.",
        'invalid_twitter' => 'Nome de utilizador do Twitter inválido.',
        'too_short' => 'A nova palavra-passe é demasiado curta.',
        'unknown_duplicate' => 'Nome de utilizador e endereço de e-mail já usados.',
        'username_available_in' => 'Este nome de utilizador irá estar disponível para uso em :duration.',
        'username_available_soon' => 'Este nome de utilizador irá estar disponível para uso em qualquer momento!',
        'username_invalid_characters' => 'O nome de utilizador solicitado contém caracteres inválidos.',
        'username_in_use' => 'Este nome de utilizador já está a ser usado!',
        'username_locked' => 'Este nome de utilizador já está a ser usado!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Por favor usa underscores ou espaços, não ambos!',
        'username_no_spaces' => "O nome de utilizador não pode começar ou acabar com espaços!",
        'username_not_allowed' => 'Esta escolha para nome de utilizador não é permitida.',
        'username_too_short' => 'O nome de utilizador solicitado é demasiado curto.',
        'username_too_long' => 'O nome de utilizador solicitado é demasiado longo.',
        'weak' => 'A palavra-passe está na lista-negra.',
        'wrong_current_password' => 'A palavra-passe atual está incorreta.',
        'wrong_email_confirmation' => 'A confirmação do email não corresponde.',
        'wrong_password_confirmation' => 'A confirmação da palavra-passe não corresponde.',
        'too_long' => 'Comprimento máximo excedido - só pode ser até :limit caracteres.',

        'attributes' => [
            'username' => 'Nome de utilizador',
            'user_email' => 'Endereço de email',
            'password' => 'Palavra-passe',
        ],

        'change_username' => [
            'restricted' => 'Não podes mudar o teu nome de utilizador enquanto estiveres restrito.',
            'supporter_required' => [
                '_' => 'Tens de ter :link para mudar o teu nome!',
                'link_text' => 'ajudaste o osu!',
            ],
            'username_is_same' => 'Este já é o teu nome de utilizador, tontinho!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Os beatmaps classificados não podem ser denunciados',
        'reason_not_valid' => ':reason não é valida para este tipo de denúncia.',
        'self' => "Não te podes denunciar a ti mesmo!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Quantidade',
                'cost' => 'Custo',
            ],
        ],
    ],
];
