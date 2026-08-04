<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute especificado inválido.',
    'not_negative' => ':attribute não pode ser negativo.',
    'required' => ':attribute é obrigatório.',
    'too_long' => ':attribute excedeu o comprimento máximo — só pode ter até :limit caracteres.',
    'url' => 'Por favor, insira um URL válido.',
    'wrong_confirmation' => 'A confirmação não corresponde.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'A marca de tempo foi especificada, mas falta a dificuldade do mapa.',
        'beatmapset_no_hype' => "O mapa não pode ser hypeado.",
        'hype_requires_null_beatmap' => 'O hype deve ser feito na secção Geral (todas as dificuldades).',
        'invalid_beatmap_id' => 'Dificuldade inválida especificada.',
        'invalid_beatmapset_id' => 'Mapa inválido especificado.',
        'locked' => 'A discussão está bloqueada.',

        'attributes' => [
            'message_type' => 'Tipos de mensagem',
            'timestamp' => 'Marca de tempo',
        ],

        'hype' => [
            'discussion_locked' => "Este mapa está atualmente bloqueado para discussão e não pode ser hypeado",
            'guest' => 'É necessário iniciar a sessão para hypear.',
            'hyped' => 'Já hypeou este mapa.',
            'limit_exceeded' => 'Já usou todo o seu hype.',
            'not_hypeable' => 'Este mapa não pode ser hypeado',
            'owner' => 'Não pode hypear o seu próprio mapa.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'A marca de tempo especificada ultrapassa a duração do mapa.',
            'negative' => "A marca de tempo não pode ser negativa.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'A discussão está bloqueada.',
        'first_post' => 'Não pode apagar a publicação inicial.',

        'attributes' => [
            'message' => 'A mensagem',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Não pode responder a um comentário eliminado.',
        'top_only' => 'Não pode afixar uma resposta a um comentário.',

        'attributes' => [
            'message' => 'A mensagem',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute especificado inválido.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Só pode votar num pedido de funcionalidade.',
            'not_enough_feature_votes' => 'Votos insuficientes.',
        ],

        'poll_vote' => [
            'invalid' => 'Opção especificada inválida.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Não é permitido eliminar a publicação dos metadados do mapa.',
            'beatmapset_post_no_edit' => 'Não é permitido editar a publicação dos metadados do mapa.',
            'first_post_no_delete' => 'Não pode apagar a publicação inicial',
            'missing_topic' => 'A publicação não tem tópico',
            'only_quote' => 'A sua resposta contém apenas uma citação.',

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
            'duplicate_options' => 'Não é permitido repetir a mesma opção.',
            'grace_period_expired' => 'Não pode editar uma sondagem após mais de :limit horas.',
            'hiding_results_forever' => 'Não pode ocultar os resultados de uma sondagem que nunca termina.',
            'invalid_max_options' => 'A opção por utilizador não pode exceder o número de opções disponíveis.',
            'minimum_one_selection' => 'É necessário pelo menos uma opção por utilizador.',
            'minimum_two_options' => 'São necessárias pelo menos duas opções.',
            'too_many_options' => 'Excedeu o número máximo de opções permitidas.',

            'attributes' => [
                'title' => 'Título da sondagem',
            ],
        ],

        'topic_vote' => [
            'required' => 'Selecione uma opção ao votar.',
            'too_many' => 'Selecionou mais opções do que o permitido.',
        ],
    ],

    'legacy_api_key' => [
        'exists' => 'É fornecida apenas uma chave de API por utilizador, por agora.',

        'attributes' => [
            'api_key' => 'chave da api',
            'app_name' => 'nome da aplicação',
            'app_url' => 'url da aplicação',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Excedeu o número máximo de aplicações OAuth autorizadas.',
            'url' => 'Insira um URL válido.',

            'attributes' => [
                'name' => 'Nome da aplicação',
                'redirect' => 'URL de recolha da aplicação',
            ],
        ],
    ],

    'team' => [
        'invalid_characters' => 'Esta escolha :attribute contém caracteres inválidos.',
        'used' => 'Esta escolha :attribute já foi utilizada.',
        'word_not_allowed' => 'Esta escolha :attribute não é permitida.',

        'attributes' => [
            'default_ruleset_id' => 'Modos de jogo por padrão',
            'is_open' => 'Candidatura à equipa',
            'name' => 'Nome',
            'short_name' => 'Nome abreviado',
            'url' => 'URL',
        ],
    ],

    'user' => [
        'contains_username' => 'A palavra‑passe não pode conter o nome de utilizador.',
        'email_already_used' => 'O endereço de e-mail já está a ser utilizado.',
        'email_not_allowed' => 'O endereço de e-mail não é permitido.',
        'invalid_country' => 'O país não consta na base de dados.',
        'invalid_discord' => 'O nome de utilizador do Discord é inválido.',
        'invalid_email' => "Não parece ser um endereço de e-mail válido.",
        'invalid_twitter' => 'O nome de utilizador do Twitter é inválido.',
        'too_short' => 'A nova palavra-passe é demasiado curta.',
        'unknown_duplicate' => 'O nome de utilizador ou o endereço de e-mail já está a ser utilizado.',
        'username_available_in' => 'Este nome de utilizador ficará disponível para utilização dentro de :duration.',
        'username_available_soon' => 'Este nome de utilizador ficará disponível para utilização a qualquer momento!',
        'username_invalid_characters' => 'O nome de utilizador solicitado contém caracteres inválidos.',
        'username_in_use' => 'O nome de utilizador já está a ser utilizado!',
        'username_locked' => 'O nome de utilizador já está a ser utilizado!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Por favor, utilize apenas subtraços ou espaços, não ambos!',
        'username_no_spaces' => "O nome de utilizador não pode começar nem terminar com espaços!",
        'username_not_allowed' => 'Esta escolha de nome de utilizador não é permitida.',
        'username_too_short' => 'O nome de utilizador solicitado é demasiado curto.',
        'username_too_long' => 'O nome de utilizador solicitado é demasiado longo.',
        'weak' => 'A palavra-passe está na lista-negra.',
        'wrong_current_password' => 'A palavra-passe atual está incorreta.',
        'wrong_email_confirmation' => 'A confirmação do e-mail não corresponde.',
        'wrong_password_confirmation' => 'A confirmação da palavra-passe não corresponde.',
        'too_long' => 'Excedeu o comprimento máximo — só pode ter até :limit caracteres.',

        'attributes' => [
            'username' => 'Nome de utilizador',
            'user_email' => 'Endereço de e-mail',
            'password' => 'Palavra-passe',
        ],

        'change_username' => [
            'restricted' => 'Não pode alterar o seu nome de utilizador enquanto estiver com restrições.',
            'supporter_required' => [
                '_' => 'Tem de ter :link para mudar o seu nome!',
                'link_text' => 'ajudou o osu!',
            ],
            'username_is_same' => 'Este já é o seu nome de utilizador, tontinho!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Os mapas classificados não podem ser reportados',
        'not_in_channel' => 'Não está neste canal.',
        'in_team' => 'Faz parte da equipa.',
        'reason_not_valid' => ':reason não é valida para este tipo de denúncia.',
        'self' => "Não é permitido reportar‑se a si próprio!",
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
