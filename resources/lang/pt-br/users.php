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
    'deleted' => '[usuário excluído]',

    'login' => [
        '_' => 'Iniciar sessão',
        'locked_ip' => 'seu endereço IP está trancado. Por favor, espere alguns minutos.',
        'username' => 'Nome de usuário',
        'password' => 'Senha',
        'button' => 'Iniciar sessão',
        'remember' => 'Lembrar deste computador',
        'title' => 'Inicie a sessão para continuar',
        'failed' => 'Nome de usuário e/ou senha incorretos',
        'register' => 'Não tem uma conta no osu!? Crie uma',
        'forgot' => 'Esqueceu a sua senha?',
        'beta' => [
            'main' => 'Acesso beta atualmente restrito para usuários privilegiados.',
            'small' => '(supporters serão incluidos logo)',
        ],

        'here' => 'aqui', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Registrar',
    ],
    'anonymous' => [
        'login_link' => 'clique para iniciar a sessão',
        'username' => 'Convidado',
        'error' => 'Você precisa iniciar a sessão para fazer isso.',
    ],
    'logout_confirm' => 'Tem certeza de que deseja sair? :(',
    'show' => [
        '404' => 'Usuário(a) não encontrado! ;_;',
        'age' => ':age anos',
        'current_location' => 'Atualmente em :location',
        'first_members' => 'Aqui desde o começo',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Registrou-se em :date',
        'lastvisit' => 'Visto por último :date',
        'missingtext' => 'Você pode ter cometido um erro de digitação! (ou o(a) usuário(a) pode ter sido banido(a))',
        'origin_age' => ':age',
        'origin_country' => 'De :country',
        'origin_country_age' => ':age de :country',
        'page_description' => 'osu! — Tudo o que você sempre quis saber sobre :username!',
        'plays_with' => 'Joga com :devices',
        'title' => 'Perfil de :username',

        'edit' => [
            'cover' => [
                'button' => 'Alterar capa do perfil',
                'defaults_info' => 'Mais opções de capa estarão disponíveis no futuro',
                'upload' => [
                    'broken_file' => 'Falha ao processar imagem. Verifique a imagem enviada e tente novamente.',
                    'button' => 'Enviar imagem',
                    'dropzone' => 'Arraste aqui para enviar',
                    'dropzone_info' => 'Você também pode arrastar a sua imagem aqui para enviar',
                    'restriction_info' => "Envio de imagem disponível apenas para <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'O tamanho da capa deve ser 2000x700',
                    'too_large' => 'O arquivo enviado é muito grande.',
                    'unsupported_format' => 'Formato não suportado.',
                ],
            ],
        ],
        'extra' => [
            'achievements' => [
                'title' => 'Conquistas',
                'achieved-on' => 'Alcançada em :date',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
            ],
            'historical' => [
                'empty' => 'Sem histórico de desempenho. :(',
                'most_played' => [
                    'count' => 'vezes jogadas',
                    'title' => 'Beatmaps mais jogados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisão: :percentage',
                    'title' => 'Jogadas recentes',
                ],
                'title' => 'Histórico',
            ],
            'kudosu' => [
                'available' => 'Kudosu disponível',
                'available_info' => 'Kudosu pode ser trocado por estrelas de Kudosu, que podem ajudar o seu beatmap a conseguir mais atenção. Este é o número de Kudosu não usados ainda.',
                'recent_entries' => 'Histórico recente de Kudosu',
                'title' => 'Kudosu!',
                'total' => 'Kudosu total recebido',
                'total_info' => 'Baseado na contribuição de um usuário para a moderação de beatmaps. Acesse <a href="'.osu_url('user.kudosu').'">esta página</a> para mais informações.',

                'entry' => [
                    'amount' => ':amount Kudosu',
                    'empty' => 'Este usuário ainda não recebeu nenhum Kudosu!',

                    'forum_post' => [
                        'give' => 'Recebeu :amount de :giver por uma publicação em :post',
                        'revoke' => 'Kudosu negado por :giver pela publicação :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'eu!',
            ],
            'medals' => [
                'empty' => 'Este usuário ainda não recebeu nenhuma. ;_;',
                'title' => 'Medalhas',
            ],
            'recent_activities' => [
                'title' => 'Recente',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Melhor desempenho',
                ],
                'empty' => 'Nenhum desempenho notável ainda. :(',
                'first' => [
                    'title' => 'Ranks de primeiro lugar',
                ],
                'pp' => ':amountpp',
                'title' => 'Ranks',
                'weighted_pp' => 'conseguiu: :pp (:percentage)',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
                'favourite' => [
                    'title' => 'Beatmaps favoritos (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps ranqueados e aprovados (:count)',
                ],
                'none' => 'Nenhum... ainda.',
            ],
        ],
        'page' => [
            'description' => '<strong>eu!</strong> é uma área pessoal personalizável na sua página de perfil.',
            'edit_big' => 'Editar eu!',
            'placeholder' => 'Escreva o conteúdo da página aqui',
            'restriction_info' => "Você precisa ser um <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporter</a> para desbloquear essa função.",
        ],
        'rank' => [
            'country' => 'Rank de país para :mode',
            'global' => 'Rank global para :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisão de acertos',
            'level' => 'Nível :level',
            'maximum_combo' => 'Combo máximo',
            'play_count' => 'Vezes jogadas',
            'ranked_score' => 'Pontuação ranqueada',
            'replays_watched_by_others' => 'Replays assistidos por outros',
            'score_ranks' => 'Ranks de pontuação',
            'total_hits' => 'Acertos totais',
            'total_score' => 'Pontuação total',
        ],
    ],

    'verify' => [
        'title' => 'Verificação de conta',
    ],
];
