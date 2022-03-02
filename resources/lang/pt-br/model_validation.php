<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute especificado é invalido.',
    'not_negative' => ':attribute não pode ser negativo.',
    'required' => ':attribute é necessário.',
    'too_long' => ':attribute ultrapassou tamanho máximo - deve ser até :limit caracteres.',
    'wrong_confirmation' => 'Confirmação não confere.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Marcação de tempo é especificada mas beatmap está faltando.',
        'beatmapset_no_hype' => "Beatmap não pode ser hypado.",
        'hype_requires_null_beatmap' => 'Hype deve ser feito na seção Geral (todas as dificuldades).',
        'invalid_beatmap_id' => 'Dificuldade especificada inválida.',
        'invalid_beatmapset_id' => 'Beatmap inválido especificado.',
        'locked' => 'Discussão está trancada.',

        'attributes' => [
            'message_type' => 'Tipo de mensagem',
            'timestamp' => 'Marcação de Tempo',
        ],

        'hype' => [
            'discussion_locked' => "Esse beatmap está bloqueado para discussão e não pode ser hypado",
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

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Discussão está trancada.',
        'first_post' => 'Não é possível excluir a publicação inicial.',

        'attributes' => [
            'message' => 'A mensagem',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Não é permitido responder comentários excluídos.',
        'top_only' => 'Fixar respostas de comentário não é permitido.',

        'attributes' => [
            'message' => 'A mensagem',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute especificado é invalido.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Só pode votar um pedido de recurso.',
            'not_enough_feature_votes' => 'Votos suficientes.',
        ],

        'poll_vote' => [
            'invalid' => 'Opção especificada inválida.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Deletar postagem de metadados de um beatmap não é permitido.',
            'beatmapset_post_no_edit' => 'Editar postagem de metadados de um beatmap não é permitido.',
            'first_post_no_delete' => 'Não é possível excluir a publicação inicial',
            'missing_topic' => 'Está faltando um tópico na publicação',
            'only_quote' => 'Sua resposta contém apenas uma citação.',

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
            'duplicate_options' => 'Opção duplicada não é permitida.',
            'grace_period_expired' => 'Não é possível editar uma enquete após :limit horas',
            'hiding_results_forever' => 'Não é possível esconder os resultados de uma enquete que nunca acabará.',
            'invalid_max_options' => 'Opções por usuário não deve exceder o número de opções disponíveis.',
            'minimum_one_selection' => 'É necessário no mínimo uma opção por usuário.',
            'minimum_two_options' => 'É necessário no mínimo duas opções.',
            'too_many_options' => 'Número máximo de opções permitidas excedido.',

            'attributes' => [
                'title' => 'Título da enquete',
            ],
        ],

        'topic_vote' => [
            'required' => 'Selecione uma opção quando votar.',
            'too_many' => 'Mais opções selecionadas do que permitidas.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Número máximo de aplicações OAuth excedido.',
            'url' => 'Por favor, insira uma URL válida.',

            'attributes' => [
                'name' => 'Nome da Aplicação',
                'redirect' => 'URL de Callback da Aplicação',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Senha não deve conter seu nome de usuário.',
        'email_already_used' => 'Email já utilizado.',
        'email_not_allowed' => 'Endereço de email não permitido.',
        'invalid_country' => 'País não presente no banco de dados.',
        'invalid_discord' => 'Nome de usuário do Discord inválido.',
        'invalid_email' => "Não parece ser um email válido.",
        'invalid_twitter' => 'Nome de usuário do Twitter inválido.',
        'too_short' => 'Nova senha curta demais.',
        'unknown_duplicate' => 'Nome de usuário ou email já utilizado.',
        'username_available_in' => 'Este nome de usuário estará disponível em :duration.',
        'username_available_soon' => 'Este nome de usuário estará disponível a qualquer momento!',
        'username_invalid_characters' => 'O nome de usuário contém caracteres inválidos.',
        'username_in_use' => 'Nome de usuário já está em uso!',
        'username_locked' => 'Nome de usuário já está em uso!', // TODO: language for this should be slightly different.
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

        'attributes' => [
            'username' => 'Nome de Usuário',
            'user_email' => 'Endereço de email',
            'password' => 'Senha',
        ],

        'change_username' => [
            'restricted' => 'Não é possível alterar seu nome de usuário enquanto estiver em modo restrito.',
            'supporter_required' => [
                '_' => 'Você precisa ser um :link para mudar seu nome de usuário!',
                'link_text' => 'osu!supporter',
            ],
            'username_is_same' => 'Este já é seu nome de usuário, bobinho!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Beatmaps ranqueados não podem ser reportados',
        'reason_not_valid' => ':reason não é valido para este tipo de denúncia.',
        'self' => "Você não pode se denunciar!",
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
