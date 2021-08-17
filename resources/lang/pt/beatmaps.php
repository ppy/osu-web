<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Falha ao atualizar voto',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permitir kudosu',
        'beatmap_information' => 'Página do beatmap',
        'delete' => 'eliminar',
        'deleted' => 'Eliminado por :editor :delete_time.',
        'deny_kudosu' => 'recusar kudosu',
        'edit' => 'editar',
        'edited' => 'Editado pela última vez por :editor :update_time.',
        'guest' => 'Dificuldade de convidado feita por :user',
        'kudosu_denied' => 'Estás recusado de obter kudosu.',
        'message_placeholder_deleted_beatmap' => 'Esta dificuldade foi eliminada por isso poderá não ser mais discutida.',
        'message_placeholder_locked' => 'A discussão para este beatmap foi desativada.',
        'message_placeholder_silenced' => "Não é possível publicar uma discussão enquanto estiveres silenciado.",
        'message_type_select' => 'Selecionar tipo de comentário',
        'reply_notice' => 'Prime ENTER para responder.',
        'reply_placeholder' => 'Escreve a tua resposta aqui',
        'require-login' => 'Por favor inicia sessão para publicar ou responder',
        'resolved' => 'Resolvida',
        'restore' => 'restaurar',
        'show_deleted' => 'Exibir eliminados',
        'title' => 'Discussões',

        'collapse' => [
            'all-collapse' => 'Colapsar tudo',
            'all-expand' => 'Expandir tudo',
        ],

        'empty' => [
            'empty' => 'Ainda sem discussões!',
            'hidden' => 'Nenhuma discussão corresponde ao filtro selecionado.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Bloquear discussão',
                'unlock' => 'Desbloquear discussão',
            ],

            'prompt' => [
                'lock' => 'Razão para o bloqueio',
                'unlock' => 'Tens a certeza que queres desbloquear?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Esta publicação irá para a discussão geral do beatmapset. Para modificares este beatmap, começa a mensagem com uma hora (ex: 00:12:345).',
            'in_timeline' => 'Para modificar múltiplas marcas de tempo, publica várias vezes (uma publicação por marca de tempo).',
        ],

        'message_placeholder' => [
            'general' => 'Escreve aqui para publicar em Geral (:version)',
            'generalAll' => 'Escreve aqui para publicar em Geral (Todas as dificuldades)',
            'review' => 'Escreve aqui para publicar uma análise',
            'timeline' => 'Escreve aqui para publicar na Cronologia (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Desqualificar',
            'hype' => 'Prioridade',
            'mapper_note' => 'Nota',
            'nomination_reset' => 'Reiniciar nomeação',
            'praise' => 'Glorificar',
            'problem' => 'Problema',
            'review' => 'Análise',
            'suggestion' => 'Sugestão',
        ],

        'mode' => [
            'events' => 'Historial',
            'general' => 'Geral :scope',
            'reviews' => 'Análises',
            'timeline' => 'Cronologia',
            'scopes' => [
                'general' => 'Esta dificuldade',
                'generalAll' => 'Todas as dificuldades',
            ],
        ],

        'new' => [
            'pin' => 'Afixar',
            'timestamp' => 'Marca de tempo',
            'timestamp_missing' => 'faz ctrl-c no modo de edição e cola na tua mensagem para adicionares uma marca de tempo!',
            'title' => 'Nova discussão',
            'unpin' => 'Desafixar',
        ],

        'review' => [
            'new' => 'Nova Análise',
            'embed' => [
                'delete' => 'Apagar',
                'missing' => '[DISCUSSÃO ELIMINADA]
',
                'unlink' => 'Desvincular',
                'unsaved' => 'Não guardado',
                'timestamp' => [
                    'all-diff' => 'As publicações em "Todas as dificuldades" não podem ter carimbo da hora.',
                    'diff' => 'Se este :type começa com um carimbo da hora, será mostrado na barra cronológica.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'inserir parágrafo',
                'praise' => 'inserir elogio',
                'problem' => 'inserir problema',
                'suggestion' => 'inserir sugestão',
            ],
        ],

        'show' => [
            'title' => ':title mapeado por :mapper',
        ],

        'sort' => [
            'created_at' => 'Data de criação',
            'timeline' => 'Cronologia',
            'updated_at' => 'Última atualização',
        ],

        'stats' => [
            'deleted' => 'Eliminadas',
            'mapper_notes' => 'Notas',
            'mine' => 'Minhas',
            'pending' => 'Pendentes',
            'praises' => 'Elogios',
            'resolved' => 'Resolvidas',
            'total' => 'Todas',
        ],

        'status-messages' => [
            'approved' => 'Este beatmap foi aprovado a :date!',
            'graveyard' => "Este beatmap não tem sido atualizado desde :date e muito provavelmente foi abandonado pelo criador...",
            'loved' => 'Este beatmap foi adicionado a adorado em :date!',
            'ranked' => 'Este beatmap foi classificado em :date!',
            'wip' => 'Nota: Este beatmap está marcado como um trabalho em progresso pelo criador.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Ainda sem votos negativos',
                'up' => 'Ainda sem votos positivos',
            ],
            'latest' => [
                'down' => 'Últimos votos negativos',
                'up' => 'Últimos votos positivos',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hypear o beatmap!',
        'button_done' => 'Já foi hypeado!',
        'confirm' => "Tens a certeza? Isto usará um dos teus :n hypes restantes e não pode ser desfeito.",
        'explanation' => 'Dá hype neste beatmap para torná-lo mais visível para a nomeação e classificação!',
        'explanation_guest' => 'Regista-te e dá hype neste beatmap para torná-lo mais visível para a nomeação e classificação!',
        'new_time' => "O próximo beatmap estará disponível em :new_time.",
        'remaining' => 'Tens :remaining publicações restantes.',
        'required_text' => 'Prioridade: :current/:required',
        'section_title' => 'Comboio do hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Deixar feedback',
    ],

    'nominations' => [
        'delete' => 'Apagar',
        'delete_own_confirm' => 'Tens a certeza? O beatmap será apagado e serás redirecionado de volta para o teu perfil.',
        'delete_other_confirm' => 'Tens a certeza? O beatmap será apagado e serás redirecionado de volta para o perfil de utilizador.',
        'disqualification_prompt' => 'Qual a razão pela desqualificação?',
        'disqualified_at' => 'Desqualificado :time_ago (:reason).',
        'disqualified_no_reason' => 'nenhuma razão especificada',
        'disqualify' => 'Desqualificar',
        'incorrect_state' => 'Erro ao desempenhar essa ação, tenta recarregar a página.',
        'love' => 'Adorar',
        'love_choose' => '',
        'love_confirm' => 'Queres adorar este beatmap?',
        'nominate' => 'Nomear',
        'nominate_confirm' => 'Pretendes nomear este beatmap?',
        'nominated_by' => 'nomeado por :users',
        'not_enough_hype' => "Não há hype suficiente.",
        'remove_from_loved' => 'Removido de Adorado',
        'remove_from_loved_prompt' => 'Motivo pela remoção de Adorado:',
        'required_text' => 'Nomeações: :current/:required',
        'reset_message_deleted' => 'apagado',
        'title' => 'Estado da nomeação',
        'unresolved_issues' => 'Existem problemas ainda não resolvidos que devem ser abordados primeiro.',

        'rank_estimate' => [
            '_' => 'Este mapa está estimado a ser classificado em :date se não forem descobertos quaisquer problemas. Está em #:position na :queue.',
            'queue' => 'fila de classificação',
            'soon' => 'em breve',
        ],

        'reset_at' => [
            'nomination_reset' => 'Processo de nomeação redefinido :time_ago por :user com um novo problema :discussion (:message).',
            'disqualify' => 'Desclassificado :time_ago por :user com um novo problema :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Tens a certeza? Publicar um novo problema irá reiniciar o processo de nomeação.',
            'disqualify' => 'Tens a certeza? Isto irá remover o beatmap de qualificar-se e reiniciará o processo de nomeação.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'escreve em palavras-chave...',
            'login_required' => 'Inicia sessão para procurares.',
            'options' => 'Mais opções de pesquisa',
            'supporter_filter' => 'Filtrar por :filters requer uma etiqueta osu!supporter',
            'not-found' => 'sem resultados',
            'not-found-quote' => '... não, nada encontrado.',
            'filters' => [
                'extra' => 'extra',
                'general' => 'Geral',
                'genre' => 'Género',
                'language' => 'Língua',
                'mode' => 'Modo',
                'nsfw' => 'Mapas explícitos',
                'played' => 'Jogado',
                'rank' => 'Classificação alcançada',
                'status' => 'Categorias',
            ],
            'sorting' => [
                'title' => 'Título',
                'artist' => 'Artista',
                'difficulty' => 'Dificuldade',
                'favourites' => 'Favoritos',
                'updated' => 'Atualizado',
                'ranked' => 'Classificados',
                'rating' => 'Avaliação',
                'plays' => 'Partidas',
                'relevance' => 'Relevância',
                'nominations' => 'Nomeações',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrar por :filters requer um :link ativo',
                'link_text' => 'etiqueta de osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Incluir beatmaps convertidos',
        'follows' => 'Mapeadores subscritos',
        'recommended' => 'Dificuldade recomendada',
    ],
    'mode' => [
        'all' => 'Todos',
        'any' => 'Qualquer',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Qualquer',
        'approved' => 'Aprovados',
        'favourites' => 'Favoritos',
        'graveyard' => 'Cemitério',
        'leaderboard' => 'Possui uma tabela de classificações',
        'loved' => 'Adorados',
        'mine' => 'Os meus mapas',
        'pending' => 'Pendente e Trabalho em progresso',
        'qualified' => 'Qualificados',
        'ranked' => 'Classificados',
    ],
    'genre' => [
        'any' => 'Qualquer',
        'unspecified' => 'Não especificado',
        'video-game' => 'Vídeojogo',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Outro',
        'novelty' => 'Inovação',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Eletrónica',
        'metal' => 'Metal',
        'classical' => 'Clássica',
        'folk' => 'Música popular',
        'jazz' => 'Jazz',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
    ],
    'language' => [
        'any' => 'Qualquer',
        'english' => 'Inglês',
        'chinese' => 'Chinês',
        'french' => 'Francês',
        'german' => 'Alemão',
        'italian' => 'Italiano',
        'japanese' => 'Japonês',
        'korean' => 'Coreano',
        'spanish' => 'Espanhol',
        'swedish' => 'Sueco',
        'russian' => 'Russa',
        'polish' => 'Polaca',
        'instrumental' => 'Instrumental',
        'other' => 'Outro',
        'unspecified' => 'Não especificada',
    ],

    'nsfw' => [
        'exclude' => 'Ocultar',
        'include' => 'Mostrar',
    ],

    'played' => [
        'any' => 'Qualquer',
        'played' => 'Jogado',
        'unplayed' => 'Não jogado',
    ],
    'extra' => [
        'video' => 'Possui vídeo',
        'storyboard' => 'Possui storyboard',
    ],
    'rank' => [
        'any' => 'Qualquer',
        'XH' => 'SS Prata',
        'X' => '',
        'SH' => 'S Prata',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Partidas jogadas: :count',
        'favourites' => 'Favoritos: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Todos',
        ],
    ],
];
