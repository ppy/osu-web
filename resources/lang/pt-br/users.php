<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'deleted' => '[usuário deletado]',

    'beatmapset_activities' => [
        'title' => "Histórico de modding de :user",
        'title_compact' => 'Modding',

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

    'anonymous' => [
        'login_link' => 'clique para conectar-se',
        'login_text' => 'conectar-se',
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
        'lastvisit_online' => 'Atualmente online',
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
                    'size_info' => 'O tamanho da capa deve ser 2800x620',
                    'too_large' => 'O arquivo enviado é muito grande.',
                    'unsupported_format' => 'Formato não suportado.',

                    'restriction_info' => [
                        '_' => 'Upload disponível apenas para :link',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'modo de jogo padrão',
                'set' => 'definir :mode como modo de jogo padrão',
            ],
        ],

        'extra' => [
            'none' => 'nenhum',
            'unranked' => 'Nada jogado recentemente',

            'achievements' => [
                'achieved-on' => 'Conquistado em :date',
                'locked' => 'Trancado',
                'title' => 'Conquistas',
            ],
            'beatmaps' => [
                'by_artist' => 'por :artist',
                'none' => 'Nenhum... ainda.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps Favoritos',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps no Cemitério',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps Ranqueados & Aprovados',
                ],
                'unranked' => [
                    'title' => 'Beatmaps Pendentes',
                ],
            ],
            'discussions' => [
                'title' => 'Discussões',
                'title_longer' => 'Discussões Recentes',
                'show_more' => 'ver mais discussões',
            ],
            'events' => [
                'title' => 'Eventos',
                'title_longer' => 'Eventos Recentes',
                'show_more' => 'ver mais eventos',
            ],
            'historical' => [
                'empty' => 'Sem registro de performance. :(',
                'title' => 'Histórico',

                'monthly_playcounts' => [
                    'title' => 'Histórico de Jogo',
                    'count_label' => 'Vezes jogadas',
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
                    'count_label' => 'Replays assistidos',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Disponível',
                'available_info' => "Kudosu pode ser trocado por estrelas de kudosu, que podem ajudar seu beatmap a ter um pouco mais de atenção. Este é o número de kudosu que você tem disponível.",
                'recent_entries' => 'Histórico de kudosu recente',
                'title' => 'Kudosu!',
                'total' => 'Total de Kudosu Adquirido',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Esse usuário ainda não recebeu nenhum kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Recebeu :amount por negação de kudosu na publicação :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Negou :amount na publicação :post',
                        ],

                        'delete' => [
                            'reset' => 'Perdeu :amount por postagem deletada em :post',
                        ],

                        'restore' => [
                            'give' => 'Recebeu :amount pela publicação restaurada em :post',
                        ],

                        'vote' => [
                            'give' => 'Recebeu :amount por obter votos na publicação :post',
                            'reset' => 'Perdeu :amount por perder votos na publicação :post',
                        ],

                        'recalculate' => [
                            'give' => 'Recebeu :amount por votos recalculados na publicação :post',
                            'reset' => 'Perdeu :amount por votos recalculados na publicação :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Recebeu :amount de :giver por uma publicação em :post',
                        'reset' => 'Kudosu reiniciado por :giver na publicação :post',
                        'revoke' => 'Kudosu negado por :giver na publicação :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Baseado na quantidade de contribuições realizadas pelo usuário em moderações de beatmaps. Veja :link para mais informações.',
                    'link' => 'esta página',
                ],
            ],
            'me' => [
                'title' => 'eu!',
            ],
            'medals' => [
                'empty' => "Esse usuário não conseguiu nenhuma recentemente. ;_;",
                'recent' => 'Recente',
                'title' => 'Medalhas',
            ],
            'posts' => [
                'title' => 'Publicações',
                'title_longer' => 'Publicações Recentes',
                'show_more' => 'ver mais publicações',
            ],
            'recent_activity' => [
                'title' => 'Recente',
            ],
            'top_ranks' => [
                'download_replay' => 'Baixar Replay',
                'empty' => 'Nenhuma performance incrível ainda. :(',
                'not_ranked' => 'Apenas beatmaps ranqueados dão pp.',
                'pp_weight' => 'ajustado :percentage',
                'title' => 'Classificações',

                'best' => [
                    'title' => 'Melhor Performance',
                ],
                'first' => [
                    'title' => 'Primeiros Lugares',
                ],
            ],
            'votes' => [
                'given' => 'Votos Dados (últimos 3 meses)',
                'received' => 'Votos Recebidos (últimos 3 meses)',
                'title' => 'Votos',
                'title_longer' => 'Votos Recentes',
                'vote_count' => ':count_delimited voto|:count_delimited votos',
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

        'header_title' => [
            '_' => 'Player :info',
            'info' => 'Info',
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
            'button' => 'Editar página do perfil',
            'description' => '<strong>eu!</strong> é uma área pessoal customizável na sua página de perfil.',
            'edit_big' => 'Me edite!',
            'placeholder' => 'Digite o conteúdo da página aqui',

            'restriction_info' => [
                '_' => 'Você precisa ser um :link para desbloquear esta funcionalidade.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Contribuiu com :link',
            'count' => ':count publicação no fórum|:count publicações no fórum',
        ],
        'rank' => [
            'country' => 'Ranking nacional de :mode',
            'country_simple' => 'Ranking Nacional',
            'global' => 'Ranking global de :mode',
            'global_simple' => 'Ranking Global',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisão',
            'level' => 'Nível :level',
            'level_progress' => 'Progresso para o próximo nível',
            'maximum_combo' => 'Combo Máximo',
            'medals' => 'Medalhas',
            'play_count' => 'Vezes Jogadas',
            'play_time' => 'Tempo de Jogo',
            'ranked_score' => 'Pontuação Ranqueada',
            'replays_watched_by_others' => 'Replays Assistidos',
            'score_ranks' => 'Ranque em Pontuação',
            'total_hits' => 'Acertos Totais',
            'total_score' => 'Pontuação Total',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Beatmaps Ranqueados e Aprovados',
            'loved_beatmapset_count' => 'Loved Beatmaps',
            'unranked_beatmapset_count' => 'Beatmaps Pendentes',
            'graveyard_beatmapset_count' => 'Beatmaps no Cemitério',
        ],
    ],

    'status' => [
        'all' => 'Todos',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Usuário criado',
    ],
    'verify' => [
        'title' => 'Verificação de Conta',
    ],

    'view_mode' => [
        'card' => 'Visualizar em card',
        'list' => 'Visualizar em lista',
    ],
];
