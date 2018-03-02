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
    'deleted' => '[usuário deletado]',

    'beatmapset_activities' => [
        'discussions' => [
            'title_recent' => 'Discussões começadas recentemente',
        ],

        'events' => [
            'title_recent' => 'Eventos recentes',
        ],

        'posts' => [
            'title_recent' => 'Postagens recentes',
        ],

        'votes_received' => [
            'title_most' => 'Mais votado (últimos 3 meses)',
        ],

        'votes_made' => [
            'title_most' => 'Mais votado (últimos 3 meses)',
        ],
    ],

    'login' => [
        '_' => 'Conectar-se',
        'locked_ip' => 'seu endereço IP está bloqueado. Por favor, espere alguns minutos.',
        'username' => 'Nome de usuário',
        'password' => 'Senha',
        'button' => 'Conectar',
        'button_posting' => 'Conectando...',
        'remember' => 'Lembrar deste computador',
        'title' => 'Por favor, conecte-se para prosseguir',
        'failed' => 'Login incorreto',
        'register' => 'Você não tem uma conta no osu!? Faça uma!',
        'forgot' => 'Esqueceu sua senha?',
        'beta' => [
            'main' => 'Acesso Beta está restrito apenas para usuários privilegiados.',
            'small' => '(supporters terão acesso em breve)',
        ],

        'here' => 'here', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Registrar',
    ],
    'anonymous' => [
        'login_link' => 'clique para conectar-se',
        'login_text' => 'conectar',
        'username' => 'Convidado',
        'error' => 'Você precisa conectar-se para fazer isso.',
    ],
    'logout_confirm' => 'Tem certeza que deseja sair? :(',
    'restricted_banner' => [
        'title' => 'Sua conta foi restrita',
        'message' => 'Enquanto restrito, você será impossibilitado de interagir com outros jogadores e suas pontuações serão apenas visíveis para você. Isso é geralmente o resultado de um processo automático e provavelmente será resolvido em até 24 horas. Caso tenha interesse em apelar por sua restrição, por favor, <a href="mailto:accounts@ppy.sh">entre em contato com o suporte</a>.',
    ],
    'show' => [
        '404' => 'Usuário não encontrado! ;_;',
        'age' => ':age anos de idade',
        'first_members' => 'Aqui desde o começo',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Juntou-se em :date',
        'lastvisit' => 'Última vez visto em :date',
        'missingtext' => 'Talvez você tenha feito um erro de digitação! (ou o usuário está banido)',
        'origin_age' => ':age',
        'origin_country' => 'morando em :country',
        'origin_country_age' => ':age morando em :country',
        'page_description' => 'osu! - Tudo que você sempre quis saber sobre :username!',
        'plays_with' => 'Joga com :devices',
        'title' => 'Perfil de :username',

        'edit' => [
            'cover' => [
                'button' => 'Mudar capa de perfil',
                'defaults_info' => 'Mais opções de capa virão no futuro',
                'upload' => [
                    'broken_file' => 'Falha ao processar imagem. Verifique a imagem enviada e tente novamente.',
                    'button' => 'Enviar imagem',
                    'dropzone' => 'Solte aqui pare enviar',
                    'dropzone_info' => 'Você também pode soltar sua imagem aqui para enviar',
                    'restriction_info' => "Envio disponível apenas para <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'O tamanho da capa deve ser 2000x700',
                    'too_large' => 'Arquivo enviado é muito grande.',
                    'unsupported_format' => 'Formato não suportado.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '1 seguidor|:count seguidores',
            'unranked' => 'Nada jogado recentemente',

            'achievements' => [
                'title' => 'Conquistas',
                'achieved-on' => 'Conquistado em :date',
            ],
            'beatmaps' => [
                'none' => 'Nenhum... ainda.',
                'title' => 'Mapas',

                'favourite' => [
                    'title' => 'Mapas favoritos (:count)',
                ],
                'graveyard' => [
                    'title' => 'Mapas desatualizados (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Mapas Ranqueados & Aprovados (:count)',
                ],
                'unranked' => [
                    'title' => 'Mapas pendentes (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Sem registro de performance. :(',
                'title' => 'Histórico',

                'most_played' => [
                    'count' => 'vezes jogadas',
                    'title' => 'Mapas mais jogados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisão: :percentage',
                    'title' => 'Jogados recentemente (24h)',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu disponível',
                'available_info' => 'Kudosu pode ser trocado por estrelas de kudosu, que podem ajudar seu mapa a ter um pouco mais de atenção. Este é o número de kudosu que você tem disponível.',
                'recent_entries' => 'Histórico de kudosu recente',
                'title' => 'Kudosu!',
                'total' => 'Total de kudosu adquirido',
                'total_info' => 'Baseado na contribuição que um usuário fez na moderação de um mapa. Veja <a href="'.osu_url('user.kudosu').'">esta página</a> para mais informações.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => 'Esse usuário ainda não tem nenhum kudosu!',

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Recebeu :amount por negação de kudosu na postagem :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Negado :amount na postagem :post',
                        ],

                        'delete' => [
                            'reset' => 'Perdeu :amount por postagem deletada em :post',
                        ],

                        'restore' => [
                            'give' => 'Recebeu :amount por postagem restaurada em :post',
                        ],

                        'vote' => [
                            'give' => 'Recebeu :amount por obter votos na postagem :post',
                            'reset' => 'Perdeu :amount por perder votos na postagem :post',
                        ],

                        'recalculate' => [
                            'give' => 'Recebeu :amount por votos recalculados na postagem :post',
                            'reset' => 'Perdeu :amount por votos recalculados na postagem :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Recebeu :amount de :giver na postagem :post',
                        'reset' => 'Kudosu reiniciado por :giver na postagem :post',
                        'revoke' => 'Kudosu negado por :giver na postagem :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'eu!',
            ],
            'medals' => [
                'empty' => 'Esse usuário não conseguiu nada recentemente. ;_;',
                'title' => 'Medalhas',
            ],
            'recent_activity' => [
                'title' => 'Recente',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Melhor performance',
                ],
                'empty' => 'Nenhuma performance incrível ainda. :(',
                'first' => [
                    'title' => 'Primeiro lugar',
                ],
                'pp' => ':amountpp',
                'title' => 'Ranques',
                'weighted_pp' => 'recalculado: :pp (:percentage)',
            ],
        ],
        'page' => [
            'description' => '<strong>eu!</strong> é uma área pessoal customizável na sua página de perfil.',
            'edit_big' => 'Editar eu!',
            'placeholder' => 'Digite o conteúdo da página aqui',
            'restriction_info' => "Você precisa ser um <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> para desbloquear esse recurso.",
        ],
        'rank' => [
            'country' => 'Ranking nacional de :mode',
            'global' => 'Ranking global de :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisão',
            'level' => 'Nível :level',
            'maximum_combo' => 'Combo máximo',
            'play_count' => 'Vezes jogadas',
            'ranked_score' => 'Pontuação ranqueada',
            'replays_watched_by_others' => 'Replays assistidos por outros',
            'score_ranks' => 'Ranque em pontuação',
            'total_hits' => 'Vezes clicadas',
            'total_score' => 'Pontuação total',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Usuário criado',
    ],
    'verify' => [
        'title' => 'Verificação de conta',
    ],
];
