<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'deleted' => '[utilizador eliminado]',

    'beatmapset_activities' => [
        'title' => "Histórico de Modificações do :user",
        'title_compact' => 'Modding',

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
        'banner_text' => 'Tu bloqueaste este utilizador.',
        'blocked_count' => 'utilizadores bloqueados (:count)',
        'hide_profile' => 'ocultar perfil',
        'not_blocked' => 'Esse utilizador não está bloqueado.',
        'show_profile' => 'mostrar perfil',
        'too_many' => 'Limite de bloqueios atingido.',
        'button' => [
            'block' => 'bloquear',
            'unblock' => 'desbloquear',
        ],
    ],

    'card' => [
        'loading' => 'A carregar...',
        'send_message' => 'enviar mensagem',
    ],

    'login' => [
        '_' => 'Iniciar sessão',
        'locked_ip' => 'o teu endereço de IP foi bloqueado. Por favor espera uns minutos.',
        'username' => 'Nome de utilizador',
        'password' => 'Palavra-passe',
        'button' => 'Iniciar sessão',
        'button_posting' => 'A iniciar sessão...',
        'remember' => 'Lembrar este computador',
        'title' => 'Por favor inicia sessão para proceder',
        'failed' => 'Início de sessão incorreto',
        'register' => "Não tens uma conta osu? Cria uma nova",
        'forgot' => 'Esqueceste-te da palavra-passe?',
        'beta' => [
            'main' => 'O acesso beta está atualmente restrito a utilizadores privilegiados.',
            'small' => '(osu!supporters terão acesso em breve)',
        ],

        'here' => 'aqui', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Publicações de :username',
    ],

    'anonymous' => [
        'login_link' => 'clica para iniciar sessão',
        'login_text' => 'iniciar sessão',
        'username' => 'Convidado',
        'error' => 'Precisas de ter sessão iniciada para fazer isto.',
    ],
    'logout_confirm' => 'Tens a certeza que queres terminar a sessão? :(',
    'report' => [
        'button_text' => 'denunciar',
        'comments' => 'Comentários Adicionais',
        'placeholder' => 'Por favor fornece qualquer informação que acredites ser útil.',
        'reason' => 'Motivo',
        'thanks' => 'Obrigado pela tua denúncia!',
        'title' => 'Denunciar :username?',

        'actions' => [
            'send' => 'Enviar Relatório',
            'cancel' => 'Cancelar',
        ],

        'options' => [
            'cheating' => 'Jogada suja / Fazer batota',
            'insults' => 'Insultar-me / outros',
            'spam' => 'Spamar',
            'unwanted_content' => 'Enviar ligações com conteúdo impróprio',
            'nonsense' => 'Disparate',
            'other' => 'Outro (escreve abaixo)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'A tua conta foi restrita!',
        'message' => 'Enquanto restrito(a), estarás incapaz de interagir com outros jogadores e as tuas pontuações só serão visíveis para ti. Isto é habitualmente o resultado dum processo automático e irá ser levantado geralmente em 24 horas. Se quiseres apelar a tua restrição, por favor <a href="mailto:accounts@ppy.sh">contacta a assistência</a>.',
    ],
    'show' => [
        'age' => ':age anos',
        'change_avatar' => 'muda o teu avatar!',
        'first_members' => 'Aqui desde o princípio',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Juntou-se em :date',
        'lastvisit' => 'Visto pela última vez em :date',
        'lastvisit_online' => 'Atualmente online',
        'missingtext' => 'Poderás ter escrito mal! (ou o utilizador poderá ter sido banido)',
        'origin_country' => 'De :country',
        'page_description' => 'osu! - Tudo o que sempre quiseste saber sobre :username!',
        'previous_usernames' => 'antigamente conhecido como',
        'plays_with' => 'Joga com :devices',
        'title' => "Perfil de :username",

        'edit' => [
            'cover' => [
                'button' => 'Mudar a Capa do Perfil',
                'defaults_info' => 'Mais opções de capa estarão disponíveis no futuro',
                'upload' => [
                    'broken_file' => 'Falha ao processar imagem. Verifica a imagem carregada e tenta outra vez.',
                    'button' => 'Carregar imagem',
                    'dropzone' => 'Larga aqui para carregar',
                    'dropzone_info' => 'Também podes largar aqui a tua imagem para carregar',
                    'size_info' => 'O tamanho da capa deveria ser 2800x620',
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
        ],

        'extra' => [
            'none' => 'nenhum',
            'unranked' => 'Nenhuma partida recente',

            'achievements' => [
                'achieved-on' => 'Conseguida em :date',
                'locked' => 'Bloqueado',
                'title' => 'Proezas',
            ],
            'beatmaps' => [
                'by_artist' => 'por :artist',
                'none' => 'Nenhuns... por agora.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps Favoritos',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps no Cemitério',
                ],
                'loved' => [
                    'title' => 'Beatmaps Adorados',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps Classificados e Aprovados',
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
                'empty' => 'Sem registos de desempenho. :(',
                'title' => 'Historial',

                'monthly_playcounts' => [
                    'title' => 'Histórico de Jogos',
                    'count_label' => 'Partidas',
                ],
                'most_played' => [
                    'count' => 'vezes jogados',
                    'title' => 'Beatmaps Mais Jogados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisão: :percentage',
                    'title' => 'Partidas Recentes (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historial de Repetições Vistas',
                    'count_label' => 'Repetições Assistidas',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Disponível',
                'available_info' => "Os kudosus podem ser trocados por estrelas de kudosu, que irão ajudar o teu beatmap a ganhar mais atenção. Este é o número de kudosus que ainda não trocaste.",
                'recent_entries' => 'Historial Recente de Kudosu',
                'title' => 'Kudosu!',
                'total' => 'Total de Kudosu Ganhos',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Este utilizador não recebeu nenhum kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Recebido :amount da revogação negada de kudosu da publicação modificada :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Negado :amount da publicação modificada :post',
                        ],

                        'delete' => [
                            'reset' => 'Perdido :amount de modificares a eliminação da publicação de :post',
                        ],

                        'restore' => [
                            'give' => 'Recebido :amount de modificares a restauração da publicação de :post',
                        ],

                        'vote' => [
                            'give' => 'Recebido :amount de obteres votos em modificares a publicação de :post',
                            'reset' => 'Perdido :amount de perderes votos em modificares a publicação de :post',
                        ],

                        'recalculate' => [
                            'give' => 'Recebido :amount da recalculação dos votos em modificares a publicação de :post',
                            'reset' => 'Perdido :amount da recalculação de votos em modificares a publicação de :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Recebido :amount de :giver por uma publicação em :post',
                        'reset' => 'Kudosu reiniciado por :giver para a publicação :post',
                        'revoke' => 'Kudosu negado por :giver para a publicação :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Baseado no quão o utilizador contribuiu para a moderação do beatmap. Vê :link para mais informações.',
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
            'posts' => [
                'title' => 'Publicações',
                'title_longer' => 'Publicações Recentes',
                'show_more' => 'ver mais publicações',
            ],
            'recent_activity' => [
                'title' => 'Recente',
            ],
            'top_ranks' => [
                'download_replay' => 'Transferir Repetição',
                'empty' => 'Nenhum registo de desempenhos espectaculares ainda. :(',
                'not_ranked' => 'Somente beatmaps classificados é que dão pp.',
                'pp_weight' => 'ponderada :percentage',
                'title' => 'Classificações',

                'best' => [
                    'title' => 'Melhor Desempenho',
                ],
                'first' => [
                    'title' => 'Classificações de Primeiro Lugar',
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
                'title' => 'Reputação da Conta',
                'bad_standing' => "A conta de <strong>:username</strong> não tem uma boa reputação :(",
                'remaining_silence' => '<strong>:username</strong> será capaz de falar outra vez em :duration.',

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
                        'silence' => 'Silenciado',
                        'note' => 'Nota',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => 'Jogador :info',
            'info' => 'Informação',
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interesses',
            'lastfm' => 'Last.fm',
            'location' => 'Localização Atual',
            'occupation' => 'Ocupação',
            'skype' => '',
            'twitter' => '',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'Ele/ela poderá ter mudado de nome de utilizador.',
            'reason_2' => 'A conta poderá estar indisponível devido a problemas de segurança ou de abuso.',
            'reason_3' => 'Poderás ter cometido um erro de escrita!',
            'reason_header' => 'Há algumas possíveis razões para isto:',
            'title' => 'Utilizador não encontrado! ;_;',
        ],
        'page' => [
            'button' => 'Editar a página de perfil',
            'description' => '<strong>eu!</strong> é uma área pessoal personalizável na tua página de perfil.',
            'edit_big' => 'Edita-me!',
            'placeholder' => 'Escreve o conteúdo da página aqui',

            'restriction_info' => [
                '_' => 'Tu precisas de ser um :link para desbloquear esta funcionalidade.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Contribuiu em :link',
            'count' => ':count publicação no fórum|:count publicações no fórum',
        ],
        'rank' => [
            'country' => 'Classificação nacional para :mode',
            'country_simple' => 'Classificação Nacional',
            'global' => 'Classificação global para :mode',
            'global_simple' => 'Classificação Global',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisão de Acertos',
            'level' => 'Nível :level',
            'level_progress' => 'Progresso para o próximo nível',
            'maximum_combo' => 'Combo Máximo',
            'medals' => 'Medalhas',
            'play_count' => 'Número de Partidas',
            'play_time' => 'Tempo Total de Jogo',
            'ranked_score' => 'Pontuação Classificada',
            'replays_watched_by_others' => 'Repetições Vistas por Outros',
            'score_ranks' => 'Classificações de Pontuação',
            'total_hits' => 'Acertos Totais',
            'total_score' => 'Pontuação Total',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Beatmaps Classificados e Aprovados',
            'loved_beatmapset_count' => 'Beatmaps Adorados',
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
        'saved' => 'Criado por utilizadores',
    ],
    'verify' => [
        'title' => 'Verificação da Conta',
    ],

    'view_mode' => [
        'card' => 'Vista do cartão',
        'list' => 'Vista da lista',
    ],
];
