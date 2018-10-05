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
    'deleted' => '[utilizador eliminado]',

    'beatmapset_activities' => [
        'title' => "Histórico de Modificações do :user",

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
        'failed' => 'Início de sessão incorrecto',
        'register' => "Não tens uma conta osu? Cria uma nova",
        'forgot' => 'Esqueceste-te da palavra-passe?',
        'beta' => [
            'main' => 'O acesso beta está actualmente restrito a utilizadores privilegiados.',
            'small' => '(osu!supporters terão acesso em breve)',
        ],

        'here' => 'aqui', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Publicações de :username',
    ],

    'signup' => [
        '_' => 'Registar',
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
        'lastvisit' => 'Visto pela ultima vez em :date',
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
                    'restriction_info' => "Carregamento disponível para <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a> só",
                    'size_info' => 'O tamanho da capa deveria ser 2000x700',
                    'too_large' => 'O ficheiro carregado é demasiado grande.',
                    'unsupported_format' => 'Formato não suportado.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'modo de jogo por omissão',
                'set' => 'definir :mode como perfil de modo de jogo por omissão',
            ],
        ],

        'extra' => [
            'followers' => '1 seguidor|:count seguidores',
            'unranked' => 'Nenhuma partida recente',

            'achievements' => [
                'title' => 'Proezas',
                'achieved-on' => 'Conseguida em :date',
            ],
            'beatmaps' => [
                'none' => 'Nenhuns... por agora.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps Favoritos (:count)',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps no Cemitério (:count)',
                ],
                'loved' => [
                    'title' => 'Beatmaps Adorados (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps Classificados & Aprovados (:count)',
                ],
                'unranked' => [
                    'title' => 'Beatmaps Pendentes (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Sem registos de desempenho. :(',
                'title' => 'Historial',

                'monthly_playcounts' => [
                    'title' => 'Histórico de Jogos',
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
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Disponível',
                'available_info' => "Os kudosus podem ser trocados por estrelas de kudosu, que irão ajudar o teu beatmap a ganhar mais atenção. Este é o número de kudosus que ainda não trocaste.",
                'recent_entries' => 'Historial Recente de Kudosu',
                'title' => 'Kudosu!',
                'total' => 'Total de Kudosu Ganhos',
                'total_info' => 'Baseado no quão o utilizador contribuiu para a moderação do beatmap. Confirma em <a href="'.osu_url('user.kudosu').'">esta página</a> para mais informação.',

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
            ],
            'me' => [
                'title' => 'eu!',
            ],
            'medals' => [
                'empty' => "Este utilizador ainda não conseguiu nenhuma. ;_;",
                'title' => 'Medalhas',
            ],
            'recent_activity' => [
                'title' => 'Recente',
            ],
            'top_ranks' => [
                'empty' => 'Nenhum registo de desempenhos espectaculares ainda. :(',
                'not_ranked' => 'Somente beatmaps classificados é que dão pp.',
                'pp' => '',
                'title' => 'Classificações',
                'weighted_pp' => 'ponderado: :pp (:percentage)',

                'best' => [
                    'title' => 'Melhor Desempenho',
                ],
                'first' => [
                    'title' => 'Classificações de Primeiro Lugar',
                ],
            ],
            'account_standing' => [
                'title' => 'Reputação da Conta',
                'bad_standing' => "A conta de <strong>:username</strong> não tem uma boa reputação :(",
                'remaining_silence' => '<strong>:username</strong> será capaz de falar outra vez em :duration.',

                'recent_infringements' => [
                    'title' => 'Infracções Recentes',
                    'date' => 'data',
                    'action' => 'acção',
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
        'info' => [
            'discord' => '',
            'interests' => 'Interesses',
            'lastfm' => 'Last.fm',
            'location' => 'Localização Actual',
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
            'description' => '<strong>eu!</strong> é uma área pessoal personalizável na tua página de perfil.',
            'edit_big' => 'Edita-me!',
            'placeholder' => 'Escreve o conteúdo da página aqui',
            'restriction_info' => "Precisas de ser um <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> para desbloquear esta funcionalidade.",
        ],
        'post_count' => [
            '_' => 'Contribuiu em :link',
            'count' => ':count publicação no fórum|:count publicações no fórum',
        ],
        'rank' => [
            'country' => 'Classificação nacional para :mode',
            'global' => 'Classificação global para :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisão de Acertos',
            'level' => 'Nível :level',
            'maximum_combo' => 'Combo Máximo',
            'play_count' => 'Número de Partidas',
            'play_time' => 'Tempo Total de Jogo',
            'ranked_score' => 'Pontuação Classificada',
            'replays_watched_by_others' => 'Repetições Vistas por Outros',
            'score_ranks' => 'Classificações de Pontuação',
            'total_hits' => 'Acertos Totais',
            'total_score' => 'Pontuação Total',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Criado por utilizadores',
    ],
    'verify' => [
        'title' => 'Verificação da Conta',
    ],
];
