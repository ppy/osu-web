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
    'login' => [
        '_' => 'Entrar',
        'username' => 'Nome de usuário',
        'password' => 'Senha',
        'button' => 'Entrar',
        'remember' => 'Lembrar deste computador',
        'title' => 'Faça login para continuar',
        'failed' => 'Login incorreto',
        'register' => 'Não tem uma conta de osu!? Crie uma',
        'forgot' => 'Esqueceu sua senha?',
        'beta' => [
            'main' => 'Acesso Beta atualmente restrito para usuários privilegiados.',
            'small' => '(supporters serão incluidos logo)',
        ],

        'here' => 'aqui', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Registrar',
    ],
    'anonymous' => [
        'login_link' => 'clique para fazer entrar',
        'username' => 'Convidado',
        'error' => 'Você precisa fazer o login antes de tentar isso.',
    ],
    'logout_confirm' => 'Tem certeza de que quer sair? :(',
    'show' => [
        '404' => 'Usuário não encontrado! ;_;',
        'current_location' => 'Atualmente em :location.',
        'edit' => [
            'cover' => [
                'button' => 'Mudar Capa de Perfil',
                'defaults_info' => 'Mais opções de capa estarão disponíveis no futuro',
                'upload' => [
                    'broken_file' => 'Processamento de imagem falhou. Verifique a imagem enviada e tente novamente.',
                    'button' => 'Enviar imagem',
                    'dropzone' => 'Arraste aqui para enviar',
                    'dropzone_info' => 'Você também pode arrastar sua imagem aqui para enviar',
                    'restriction_info' => "Envio de imagem disponível apenas para <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'Tamanho da capa deve ser 2000x500',
                    'too_large' => 'O arquivo enviado é muito grande.',
                    'unsupported_format' => 'Formato não suportado.',
                ],
            ],
        ],
        'extra' => [
            'achievements' => [
                'title' => 'Conquistas',
                'achieved-on' => 'Conquistado em :date',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
            ],
            'historical' => [
                'empty' => 'Sem histórico de performance. :(',
                'most_played' => [
                    'count' => 'vezes jogadas',
                    'title' => 'Beatmaps Mais Jogados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisão: :percentage',
                    'title' => 'Jogadas Recentes',
                ],
                'title' => 'Histórico',
            ],
            'performance' => [
                'title' => 'Performance',
            ],
            'kudosu' => [
                'available' => 'Kudosu Disponível',
                'available_info' => 'Kudosu pode ser trocado por estrelas de kudosu, que podem ajudar seu beatmap a conseguir mais atenção. Este é o número de kudosu que você ainda não usou.',
                'entry' => [
                    'empty' => 'Este jogador ainda não recebeu nenhum kudosu!',
                    'give' => 'Recebeu <strong class="kudosu-entries__amount">:amount kudosu</strong> de :giver por um post em :post',
                    'revoke' => 'Kudosu negado por :giver pelo post :post',
                ],
                'recent_entries' => 'Histórico Recente de Kudosu',
                'title' => 'Kudosu!',
                'total' => 'Kudosu Total Recebido',
                'total_info' => 'Baseado na contribuição de um jogador para a moderação de beatmaps. Veja <a href="'.osu_url('user.kudosu').'">esta página</a> para mais informações.',
            ],
            'me' => [
                'title' => 'eu!',
            ],
            'medals' => [
                'title' => 'Medalhas',
            ],
            'recent_activities' => [
                'title' => 'Recente',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Melhor Performance',
                ],
                'empty' => 'Nenhuma performance maravilhosa ainda. :(',
                'first' => [
                    'title' => 'Ranks de Primeiro Lugar',
                ],
                'pp' => ':amountpp',
                'title' => 'Ranks',
                'weighted_pp' => 'conseguiu: :pp (:percentage)',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
                'favourite' => [
                    'title' => 'Beatmaps Favoritos (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps Rankeados & Aprovados (:count)',
                ],
                'none' => 'Nenhum... ainda.',
            ],
        ],
        'first_members' => 'aqui desde o começo',
        'is_supporter' => 'osu!supporter',
        'is_developer' => 'osu!developer',
        'lastvisit' => 'Visto por último em :date.',
        'joined_at' => 'registrou-se em :date',
        'more_achievements' => 'e mais',
        'origin' => [
            'age' => ':age anos.',
            'country' => 'De :country.',
            'country_age' => ':age anos de :country.',
        ],
        'page' => [
            'description' => '<strong>eu!</strong> é uma área pessoal customizável na sua página de perfil.',
            'edit_big' => 'Edite-me!',
            'placeholder' => 'Digite o conteúdo da página aqui',
            'restriction_info' => "Você precisa ser um <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporter</a> para desbloquear essa função.",
        ],
        'plays_with' => [
            '_' => 'Joga com',
            'keyboard' => 'Teclado',
            'mouse' => 'Mouse',
            'tablet' => 'Mesa digitalizadora',
            'touch' => 'Touch Screen',
        ],
        'missingtext' => 'Você deve ter feito um erro de digitação! (ou o jogador pode ter sido banido)',
        'page_description' => 'osu! - Tudo que você sempre quis saber sobre :username!',
        'rank' => [
            'country' => 'Rank de país para :mode',
            'global' => 'Rank global para :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisão de Acerto',
            'level' => 'Level :level',
            'maximum_combo' => 'Combo Máximo',
            'play_count' => 'Vezes Jogadas',
            'ranked_score' => 'Pontuação Rankeada',
            'replays_watched_by_others' => 'Replays Assistidos por Outros',
            'score_ranks' => 'Ranks de Pontuação',
            'total_hits' => 'Hits Totais',
            'total_score' => 'Pontuação Total',
        ],
        'title' => 'perfil de :username',
    ],
	
	 'verify' => [
        'title' => 'Verificação de conta',
    ],
];
