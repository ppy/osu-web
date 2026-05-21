<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[utilizador eliminado]',

    'beatmapset_activities' => [
        'title' => "Histórico de Modificações de :user",
        'title_compact' => 'Modificações',

        'discussions' => [
            'title_recent' => 'Discussões recentemente iniciadas',
        ],

        'events' => [
            'title_recent' => 'Eventos recentes',
        ],

        'posts' => [
            'title_recent' => 'Publicações recentes',
        ],

        'votes_received' => [
            'title_most' => 'Os mais votados por (3 últimos meses)',
        ],

        'votes_made' => [
            'title_most' => 'Os mais votados (últimos 3 meses)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Bloqueou este utilizador.',
        'comment_text' => 'Este comentário está oculto.',
        'blocked_count' => 'utilizadores bloqueados (:count)',
        'hide_profile' => 'Ocultar o perfil',
        'hide_comment' => 'ocultar',
        'forum_post_text' => 'Esta publicação está oculta.',
        'not_blocked' => 'Esse utilizador não está bloqueado.',
        'show_profile' => 'Mostrar o perfil',
        'show_comment' => 'mostrar',
        'too_many' => 'Limite de bloqueios atingido.',
        'button' => [
            'block' => 'Bloquear',
            'unblock' => 'Desbloquear',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Oferecer uma etiqueta de apoiante',
        'loading' => 'A carregar...',
        'send_message' => 'Enviar mensagem',
    ],

    'create' => [
        'form' => [
            'password' => 'palavra-passe',
            'password_confirmation' => 'confirmação da palavra-passe',
            'submit' => 'criar uma conta',
            'user_email' => 'email',
            'user_email_confirmation' => 'confirmação do e-mail',
            'username' => 'nome de utilizador',

            'tos_notice' => [
                '_' => 'ao criar uma conta, concorda com :link',
                'link' => 'termos de serviço',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'Ó não! Parece que a sua conta foi desativada.',
        'warning' => "No caso de ter desrespeitado uma regra, note que há geralmente um período de espera de um mês durante o qual não iremos considerar nenhum pedido de amnistia. Após este período, poderá entrar em contacto connosco caso considere necessário. Por favor, note que a criação de novas contas, após ter uma desativada, resultará numa <strong>extensão deste período de espera de um mês </strong>. Por favor, recorde também que para <strong>cada conta que crie, está a violar ainda mais as regras</strong>. Instamos que não siga este caminho!",

        'if_mistake' => [
            '_' => 'Se sentir que isto é um engano, poderá entrar em contacto connosco (por :email ou ao clicar em "?" no canto inferior direito desta página). Por favor, recorde que estamos sempre confiantes com as nossas ações, uma vez que se baseiam em dados fidedignos. Reservamo-nos ao direito de ignorar o seu pedido se sentirmos que esteja a ser intencionalmente desonesto.',
            'email' => 'e-mail',
        ],

        'reasons' => [
            'compromised' => 'A sua conta foi considerada como comprometida. Poderá estar desativada temporariamente enquanto a sua identidade for confirmada.',
            'opening' => 'Há uma série de razões pelas quais podem resultar na desativação da sua conta:',

            'tos' => [
                '_' => 'Desrespeitou pelo menos uma das nossas :community_rules ou :tos.',
                'community_rules' => 'regras da comunidade',
                'tos' => 'termos de serviço',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Membros por modo de jogo',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive' => "A sua conta já não é utilizada há muito tempo.",
            'inactive_different_country' => "A sua conta já não é utilizada há muito tempo.",
        ],
    ],

    'login' => [
        '_' => 'Iniciar a sessão',
        'button' => 'Iniciar a sessão',
        'button_posting' => 'A iniciar sessão...',
        'email_login_disabled' => 'Agora, a autenticação por e-mail está desativada. Use o nome de utilizador como alternativa.',
        'failed' => 'Início de sessão incorreto',
        'forgot' => 'Esqueceu-se da palavra-passe?',
        'info' => 'Inicia sessão para continuar',
        'invalid_captcha' => 'Demasiadas tentativas falhadas de início de sessão, termine o captcha e tente novamente. (Atualize a página se o captcha não estiver visível)',
        'locked_ip' => 'O seu endereço de IP foi bloqueado. Espere uns minutos.',
        'password' => 'Palavra-passe',
        'register' => "Não tem uma conta do osu? Crie uma nova",
        'remember' => 'Lembrar este computador',
        'title' => 'Inicie a sessão para proceder',
        'username' => 'Nome de utilizador',

        'beta' => [
            'main' => 'O acesso beta está atualmente restrito a utilizadores privilegiados.',
            'small' => '(osu!supporters terão acesso em breve)',
        ],
    ],

    'multiplayer' => [
        'index' => [
            'active' => 'Ativas',
            'ended' => 'Concluídas',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Mapas: :counts',
        'modding_description_empty' => 'O utilizador não possui nenhum mapa...',

        'description' => [
            '_' => 'Classificação (:ruleset): :global | :country',
            'country' => 'País :rank',
            'global' => 'Global :rank',
        ],
    ],

    'posts' => [
        'title' => 'Publicações de :username',
    ],

    'anonymous' => [
        'login_link' => 'clique para iniciar a sessão',
        'login_text' => 'iniciar a sessão',
        'username' => 'Convidado',
        'error' => 'Precisa de ter sessão iniciada para fazer isto.',
    ],
    'logout_confirm' => 'Tem a certeza de que quer terminar a sessão? :(',
    'report' => [
        'button_text' => 'Denunciar',
        'comments' => 'Comentários adicionais',
        'placeholder' => 'Forneça qualquer informação que acredita ser útil.',
        'reason' => 'Motivo',
        'thanks' => 'Obrigado pela sua denúncia!',
        'title' => 'Quer denunciar :username?',

        'actions' => [
            'send' => 'Enviar denúncia',
            'cancel' => 'Cancelar',
        ],

        'dmca' => [
            'message_1' => [
                '_' => 'Por favor, reporte a infração de direitos de autor através de uma reclamação DMCA para :mail, conforme indicado em :policy.',
                'policy' => 'a política de direitos de autor do osu!',
            ],
            'message_2' => 'Isto aplica‑se a casos em que faixas de áudio, conteúdo visual ou conteúdo de níveis (mapas) são utilizados sem a devida autorização.',
        ],

        'options' => [
            'cheating' => 'Trapacear',
            'copyright_infringement' => 'Violação de direitos de autor',
            'inappropriate_chat' => 'Comportamento inadequado na conversa',
            'insults' => 'Insulto a mim ou a outros',
            'multiple_accounts' => 'Utilização de múltiplas contas',
            'nonsense' => 'Disparate',
            'other' => 'Outro (escreve abaixo)',
            'spam' => 'Repetição de texto',
            'unwanted_content' => 'Enviar ligações com conteúdo impróprio',
        ],
    ],
    'restricted_banner' => [
        'title' => 'A sua conta foi restrita!',
        'message' => 'Enquanto estiver restrito(a), estará incapaz de interagir com outros jogadores e as suas pontuações só serão visíveis para si. Isto é o resultado de um processo automático e será retirado geralmente em 24 horas. :link',
        'message_link' => 'Consulte esta página para saber mais.',
    ],
    'show' => [
        'age' => ':age ano(s)',
        'change_avatar' => 'mude o seu avatar!',
        'first_members' => 'Aqui desde o começo',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Juntou-se em :date',
        'lastvisit' => 'Visto pela última vez em :date',
        'lastvisit_online' => 'Atualmente online',
        'missingtext' => 'Poderá ter escrito mal! (ou o utilizador poderá ter sido banido)',
        'origin_country' => 'De :country',
        'previous_usernames' => 'antigamente conhecido como',
        'plays_with' => 'Joga com :devices',

        'comments_count' => [
            '_' => 'Publicou :link',
            'count' => ':count_delimited comentário|:count_delimited comentários',
        ],
        'cover' => [
            'to_0' => 'Ocultar capa',
            'to_1' => 'Mostrar capa',
        ],
        'daily_challenge' => [
            'daily' => 'Série de vitórias diárias',
            'daily_streak_best' => 'Melhor série de vitórias diárias',
            'daily_streak_current' => 'Série atual de vitórias diárias',
            'playcount' => 'Participação total',
            'title' => 'Desafio\nDiário',
            'top_10p_placements' => 'As melhores colocações 10%',
            'top_50p_placements' => 'As melhores colocações 50%',
            'weekly' => 'Série de vitórias semanais',
            'weekly_streak_best' => 'Melhor série de vitórias semanais',
            'weekly_streak_current' => 'Série atual de vitórias semanais',

            'unit' => [
                'day' => ':valued',
                'week' => ':valuew',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'Mudar a capa do perfil',
                'defaults_info' => 'Mais opções de capa estarão disponíveis no futuro',
                'holdover_remove_confirm' => "A capa selecionada anteriormente não está mais disponível para seleção. Não pode selecioná-la após mudar para outra capa. Deseja prosseguir?",
                'title' => 'Capa',

                'upload' => [
                    'broken_file' => 'Falha ao processar a imagem. Verifique a imagem carregada e tente outra vez.',
                    'button' => 'Carregar imagem',
                    'dropzone' => 'Largue aqui para carregar',
                    'dropzone_info' => 'Também pode largar aqui a sua imagem para carregá-la',
                    'size_info' => 'O tamanho da capa deverá ter 2400x620',
                    'too_large' => 'O ficheiro carregado é demasiado grande.',
                    'unsupported_format' => 'Formato não suportado.',

                    'restriction_info' => [
                        '_' => 'Carregamento disponível apenas para :link',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'modo de jogo por omissão',
                'set' => 'definir :mode como perfil de modo de jogo por omissão',
            ],

            'hue' => [
                'reset_no_supporter' => 'Redefinir cor para padrão? A etiqueta de apoiante é necessária para mudar para outra cor.',
                'title' => 'Cor',

                'supporter' => [
                    '_' => 'Temas de cores personalizadas disponíveis apenas no :link',
                    'link' => 'osu!supporters',
                ],
            ],
        ],

        'extra' => [
            'none' => 'nenhum',
            'unranked' => 'Nenhuma partida recente',

            'achievements' => [
                'achieved-on' => 'Alcançada em :date',
                'locked' => 'Bloqueada',
                'title' => 'Proezas',
            ],
            'beatmaps' => [
                'by_artist' => 'por :artist',
                'title' => 'Mapas',

                'favourite' => [
                    'title' => 'Mapas favoritos',
                ],
                'graveyard' => [
                    'title' => 'Mapas no cemitério',
                ],
                'guest' => [
                    'title' => 'Mapas onde participaram convidados',
                ],
                'loved' => [
                    'title' => 'Mapas adorados',
                ],
                'nominated' => [
                    'title' => 'Mapas classificados nomeados',
                ],
                'pending' => [
                    'title' => 'Mapas pendentes',
                ],
                'ranked' => [
                    'title' => 'Mapas classificados e aprovados',
                ],
            ],
            'discussions' => [
                'title' => 'Discussões',
                'title_longer' => 'Discussões recentes',
                'show_more' => 'ver mais discussões',
            ],
            'events' => [
                'title' => 'Eventos',
                'title_longer' => 'Eventos recentes',
                'show_more' => 'ver mais eventos',
            ],
            'historical' => [
                'title' => 'Historial',

                'monthly_playcounts' => [
                    'title' => 'Histórico de jogos',
                    'count_label' => 'Partidas',
                ],
                'most_played' => [
                    'count' => 'vezes jogados',
                    'title' => 'Os mapas mais jogados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisão: :percentage',
                    'title' => 'Partidas Recentes (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historial de repetições vistas',
                    'count_label' => 'Repetições assistidas',
                ],
                'score_replay_stats' => [
                    'title' => 'Repetições Mais Assistidas',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Historial recente de kudosu',
                'title' => 'Kudosu!',
                'total' => 'Total de kudosu ganhos',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Este utilizador não recebeu nenhum kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => ':amount recebido da revogação negada de kudosu da publicação de modificações :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':amount recusado da publicação de modificações :post',
                        ],

                        'delete' => [
                            'reset' => ':amount perdido da publicação de modificações :post',
                        ],

                        'restore' => [
                            'give' => ':amount recebido da restauração da publicação de modificações :post',
                        ],

                        'vote' => [
                            'give' => ':amount recebido de obter votos na publicação de modificações :post',
                            'reset' => ':amount perdido de perder votos na publicação de modificações :post',
                        ],

                        'recalculate' => [
                            'give' => ':amount recebido da recalculação dos votos na publicação de modificações :post',
                            'reset' => ':amount perdido da recalculação de votos na publicação de modificações :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':amount recebido de :giver por uma publicação em :post',
                        'reset' => 'Kudosu reiniciado por :giver para a publicação :post',
                        'revoke' => 'Kudosu negado por :giver para a publicação :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Baseado no quão o utilizador contribuiu para a moderação do beatmap. Veja :link para mais informações.',
                    'link' => 'esta página',
                ],
            ],
            'me' => [
                'title' => 'eu!',
            ],
            'medals' => [
                'empty' => "Este utilizador ainda não conseguiu nenhuma. ;_;",
                'recent' => 'As mais recentes',
                'title' => 'Medalhas',
            ],
            'playlists' => [
                'title' => 'Lista de reprodução de partidas',
            ],
            'posts' => [
                'title' => 'Publicações',
                'title_longer' => 'Publicações recentes',
                'show_more' => 'ver mais publicações',
            ],
            'ranked-play' => [
                'title' => 'Partidas Classificadas',
            ],
            'recent_activity' => [
                'title' => 'Recente',
            ],
            'realtime' => [
                'title' => 'Jogos multijogador',
            ],
            'top_ranks' => [
                'download_replay' => 'Transferir repetição',
                'not_ranked' => 'Somente mapas classificados é que dão pp',
                'pp_weight' => ':percentage ponderada',
                'view_details' => 'Ver detalhes',
                'title' => 'Classificações',

                'best' => [
                    'title' => 'Melhor desempenho',
                ],
                'first' => [
                    'title' => 'Classificações de primeiro lugar',
                ],
                'pin' => [
                    'to_0' => 'Desafixar',
                    'to_0_done' => 'Pontuação desafixada',
                    'to_1' => 'Afixar',
                    'to_1_done' => 'Pontuação fixada',
                ],
                'pinned' => [
                    'title' => 'Pontuações fixadas',
                ],
            ],
            'votes' => [
                'given' => 'Votos dados (últimos 3 meses)',
                'received' => 'Votos recebidos (últimos 3 meses)',
                'title' => 'Votos',
                'title_longer' => 'Votos recentes',
                'vote_count' => ':count_delimited voto|:count_delimited votos',
            ],
            'account_standing' => [
                'title' => 'Reputação da conta',
                'bad_standing' => "A conta de :username não tem uma boa reputação :(",
                'remaining_silence' => ':username será capaz de falar outra vez em :duration.',

                'recent_infringements' => [
                    'title' => 'Infrações recentes',
                    'date' => 'data',
                    'action' => 'ação',
                    'length' => 'duração',
                    'length_indefinite' => 'Indefinido',
                    'description' => 'descrição',
                    'actor' => 'por :username',

                    'actions' => [
                        'restriction' => 'Banido',
                        'silence' => 'Silenciado',
                        'tournament_ban' => 'Exclusão do torneio',
                        'note' => 'Notificado',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interesses',
            'location' => 'Localização atual',
            'occupation' => 'Ocupação',
            'twitter' => '',
            'website' => 'Página',
        ],

        'matchmaking' => [
            'title' => 'Partida Classificada',
        ],

        'not_found' => [
            'reason_1' => 'É capaz de ter mudado o nome de utilizador.',
            'reason_2' => 'A conta poderá estar indisponível devido a problemas de segurança ou de abuso.',
            'reason_3' => 'Poderá ter cometido um erro de escrita!',
            'reason_header' => 'Há algumas possíveis razões para isto:',
            'title' => 'Utilizador não encontrado! ;_;',
        ],
        'page' => [
            'button' => 'editar a página de perfil',
            'description' => '<strong>eu!</strong> é uma área pessoal personalizável na sua página de perfil.',
            'edit_big' => 'Edite-me!',
            'placeholder' => 'Escreva o conteúdo da página aqui',

            'restriction_info' => [
                '_' => 'Precisa de ser um :link para desbloquear esta funcionalidade.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Contribuiu em :link',
            'count' => ':count_delimited publicação no fórum|:count_delimited publicações no fórum',
        ],
        'rank' => [
            'country' => 'Classificação nacional para :mode',
            'country_simple' => 'Classificação nacional',
            'global' => 'Classificação global para :mode',
            'global_simple' => 'Classificação global',
            'highest' => 'Classificação mais alta: :rank em :date',
        ],
        'season_stats' => [
            'division_top_percentage' => 'Topo :value',
            'total_score' => 'Pontuação total',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisão de acertos',
            'hits_per_play' => 'Cliques por partida',
            'level' => 'Nível :level',
            'level_progress' => 'Progresso ao próximo nível',
            'maximum_combo' => 'Combinação máxima',
            'medals' => 'Medalhas',
            'play_count' => 'Número de partidas',
            'play_time' => 'Tempo total de jogo',
            'ranked_score' => 'Pontuação classificada',
            'replays_watched_by_others' => 'Repetições vistas por outros',
            'score_ranks' => 'Classificações das pontuações',
            'total_hits' => 'Acertos totais',
            'total_score' => 'Pontuação total',
            // modding stats
            'graveyard_beatmapset_count' => 'Mapas no cemitério',
            'loved_beatmapset_count' => 'Mapas adorados',
            'pending_beatmapset_count' => 'Mapas pendentes',
            'ranked_beatmapset_count' => 'Mapas classificados e aprovados',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Está agora silenciado.',
        'message' => 'Algumas ações podem não estar disponíveis.',
    ],

    'status' => [
        'all' => 'Todos',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'from_client' => 'Registe-se através do cliente do jogo!',
        'from_web' => 'Registe-se através da página.',
        'saved' => 'Criado por utilizadores',
    ],
    'verify' => [
        'title' => 'Verificação da conta',
    ],

    'view_mode' => [
        'brick' => 'Vista em blocos',
        'card' => 'Vista do cartão',
        'list' => 'Vista da lista',
    ],
];
