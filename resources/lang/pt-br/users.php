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
    'deleted' => '[usuário deletado]',

    'beatmapset_activities' => [
        'title' => "Histórico de modding de :user",

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
            'title_most' => 'Mais votado por (últimos 3 meses)',
        ],

        'votes_made' => [
            'title_most' => 'Mais votado (últimos 3 meses)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Você bloqueou este usuário.',
        'blocked_count' => 'usuários bloqueados: (:count)',
        'hide_profile' => 'ocultar perfil',
        'not_blocked' => 'Este usuário não está bloqueado.',
        'show_profile' => 'exibir perfil',
        'too_many' => 'Limite de bloqueios atingido.',
        'button' => [
            'block' => 'bloquear',
            'unblock' => 'desbloquear',
        ],
    ],

    'card' => [
        'loading' => 'Carregando...',
        'send_message' => 'enviar mensagem',
    ],

    'login' => [
        '_' => 'Conectar-se',
        'locked_ip' => 'seu endereço IP está bloqueado. Por favor, espere alguns minutos.',
        'username' => 'Nome de Usuário',
        'password' => 'Senha',
        'button' => 'Conectar',
        'button_posting' => 'Conectando...',
        'remember' => 'Lembrar deste computador',
        'title' => 'Por favor, conecte-se para prosseguir',
        'failed' => 'Login incorreto',
        'register' => "Você não tem uma conta no osu!? Faça uma!",
        'forgot' => 'Esqueceu sua senha?',
        'beta' => [
            'main' => 'Acesso Beta está restrito apenas para usuários privilegiados.',
            'small' => '(osu!supporters terão acesso em breve)',
        ],

        'here' => 'aqui', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'postagens de :username',
    ],

    'signup' => [
        '_' => 'Registrar',
    ],
    'anonymous' => [
        'login_link' => 'clique para conectar-se',
        'login_text' => 'conectar',
        'username' => 'Visitante',
        'error' => 'Você precisa estar conectado para fazer isso.',
    ],
    'logout_confirm' => 'Tem certeza de que deseja sair? :(',
    'report' => [
        'button_text' => 'reportar',
        'comments' => 'Comentários Adicionais',
        'placeholder' => 'Por favor, forneça qualquer informação que você acredite ser útil.',
        'reason' => 'Motivo',
        'thanks' => 'Obrigado por sua denuncia!',
        'title' => 'Reportar :username?',

        'actions' => [
            'send' => 'Enviar Reporte',
            'cancel' => 'Cancelar',
        ],

        'options' => [
            'cheating' => 'Jogando sujo / Trapaceando',
            'insults' => 'Me insultando / outros',
            'spam' => 'Spam',
            'unwanted_content' => 'Enviando links com conteúdo inapropriado',
            'nonsense' => 'Sem sentido',
            'other' => 'Outro (escreva abaixo)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Sua conta foi restrita!',
        'message' => 'Enquanto restrito, você será impossibilitado de interagir com outros jogadores e suas pontuações serão visíveis apenas para você. Isso é geralmente causado por um processo automático e provavelmente será resolvido em até 24 horas. Caso tenha interesse em recorrer da sua restrição, por favor, <a href="mailto:accounts@ppy.sh">entre em contato com o suporte</a>.',
    ],
    'show' => [
        'age' => ':age anos',
        'change_avatar' => 'mude seu avatar!',
        'first_members' => 'Aqui desde o começo',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Entrou em :date',
        'lastvisit' => 'Visto por último :date',
        'missingtext' => 'Talvez você tenha feito um erro de digitação! (ou o usuário está banido)',
        'origin_country' => 'Morando em :country',
        'page_description' => 'osu! - Tudo que você sempre quis saber sobre :username!',
        'previous_usernames' => 'anteriormente conhecido como',
        'plays_with' => 'Joga com :devices',
        'title' => "Perfil de :username",

        'edit' => [
            'cover' => [
                'button' => 'Mudar Capa de Perfil',
                'defaults_info' => 'Mais opções de capa virão no futuro',
                'upload' => [
                    'broken_file' => 'Falha ao processar imagem. Verifique a imagem enviada e tente novamente.',
                    'button' => 'Enviar imagem',
                    'dropzone' => 'Solte aqui pare enviar',
                    'dropzone_info' => 'Você também pode soltar sua imagem aqui para enviar',
                    'restriction_info' => "Envio disponível apenas para <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'O tamanho da capa deve ser 2000x700',
                    'too_large' => 'O arquivo enviado é muito grande.',
                    'unsupported_format' => 'Formato não suportado.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'modo de jogo padrão',
                'set' => 'definir :mode como modo de jogo padrão',
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
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps favoritos (:count)',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps no cemitério (:count)',
                ],
                'loved' => [
                    'title' => 'Beatmaps Loved (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps Ranqueados & Aprovados (:count)',
                ],
                'unranked' => [
                    'title' => 'Beatmaps Pendentes (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Sem registro de performance. :(',
                'title' => 'Histórico',

                'monthly_playcounts' => [
                    'title' => 'Histórico de Jogo',
                ],
                'most_played' => [
                    'count' => 'vezes jogadas',
                    'title' => 'Beatmaps Mais Jogados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisão: :percentage',
                    'title' => 'Jogados Recentemente (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Histórico de Replays Assistidos',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Disponível',
                'available_info' => "Kudosu pode ser trocado por estrelas de kudosu, que podem ajudar seu beatmap a ter um pouco mais de atenção. Este é o número de kudosu que você tem disponível.",
                'recent_entries' => 'Histórico de kudosu recente',
                'title' => 'Kudosu!',
                'total' => 'Total de Kudosu Adquirido',
                'total_info' => 'Baseado na contribuição que um usuário fez na moderação de um beatmap. Veja <a href="'.osu_url('user.kudosu').'">esta página</a> para mais informações.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Esse usuário ainda não recebeu nenhum kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Recebeu :amount por negação de kudosu na postagem :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Negou :amount na postagem :post',
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
                'empty' => "Esse usuário não conseguiu nenhuma recentemente. ;_;",
                'title' => 'Medalhas',
            ],
            'recent_activity' => [
                'title' => 'Recente',
            ],
            'top_ranks' => [
                'empty' => 'Nenhuma performance incrível ainda. :(',
                'not_ranked' => 'Apenas beatmaps ranqueados dão pp.',
                'pp' => ':amountpp',
                'title' => 'Ranques',
                'weighted_pp' => 'ponderado: :pp (:percentage)',

                'best' => [
                    'title' => 'Melhor Performance',
                ],
                'first' => [
                    'title' => 'Primeiros Lugares',
                ],
            ],
            'account_standing' => [
                'title' => 'Estado da Conta',
                'bad_standing' => "A conta de <strong>:username</strong> não está num estado muito bom :(",
                'remaining_silence' => '<strong>:username</strong> vai poder falar novamente em :duration.',

                'recent_infringements' => [
                    'title' => 'Infrações Recentes',
                    'date' => 'data',
                    'action' => 'ação',
                    'length' => 'duração',
                    'length_permanent' => 'Permanente',
                    'description' => 'descrição',
                    'actor' => 'por :username',

                    'actions' => [
                        'restriction' => 'Banimento',
                        'silence' => 'Silenciamento',
                        'note' => 'Nota',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => 'Interesses',
            'lastfm' => 'Last.fm',
            'location' => 'Local atual',
            'occupation' => 'Ocupação',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'Talvez o usuário tenha mudado seu nome.',
            'reason_2' => 'A conta pode estar temporariamente indisponível devido a problemas de abuso ou de segurança.',
            'reason_3' => 'Você pode ter feito um erro de digitação!',
            'reason_header' => 'Há algumas possíveis razões para isso:',
            'title' => 'Usuário não encontrado! ;_;',
        ],
        'page' => [
            'description' => '<strong>eu!</strong> é uma área pessoal customizável na sua página de perfil.',
            'edit_big' => 'Me edite!',
            'placeholder' => 'Digite o conteúdo da página aqui',
            'restriction_info' => "Você precisa ser um <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> para desbloquear este recurso.",
        ],
        'post_count' => [
            '_' => 'Contribuiu com :link',
            'count' => ':count postagem no fórum|:count postagens no fórum',
        ],
        'rank' => [
            'country' => 'Ranking nacional de :mode',
            'global' => 'Ranking global de :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisão',
            'level' => 'Nível :level',
            'maximum_combo' => 'Combo Máximo',
            'play_count' => 'Vezes Jogadas',
            'play_time' => 'Tempo de Jogo',
            'ranked_score' => 'Pontuação Ranqueada',
            'replays_watched_by_others' => 'Replays Assistidos por Outros',
            'score_ranks' => 'Ranque em Pontuação',
            'total_hits' => 'Acertos Totais',
            'total_score' => 'Pontuação Total',
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
        'title' => 'Verificação de Conta',
    ],
];
