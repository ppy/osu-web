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
    'discussion-posts' => [
        'store' => [
            'error' => 'Falha ao guardar a publicação',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Falha ao actualizar voto',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permitir kudosu',
        'delete' => 'eliminar',
        'deleted' => 'Eliminado por :editor :delete_time.',
        'deny_kudosu' => 'recusar kudosu',
        'edit' => 'editar',
        'edited' => 'Editado pela ultima vez por :editor :update_time.',
        'kudosu_denied' => 'Recusado de obter kudosu.',
        'message_placeholder' => 'Escreve aqui para publicar',
        'message_placeholder_deleted_beatmap' => 'Esta dificuldade foi eliminada por isso poderá não ser mais discutida.',
        'message_type_select' => 'Seleccionar Tipo de Comentário',
        'reply_notice' => 'Prime ENTER para responder.',
        'reply_placeholder' => 'Escreve a tua resposta aqui',
        'require-login' => 'Por favor inicia sessão para publicar ou responder',
        'resolved' => 'Decomposto',
        'restore' => 'restaurar',
        'title' => 'Discussões',

        'collapse' => [
            'all-collapse' => 'Colapsar tudo',
            'all-expand' => 'Expandir tudo',
        ],

        'empty' => [
            'empty' => 'Ainda sem discussões!',
            'hidden' => 'Nenhuma discussão corresponde ao filtro seleccionado.',
        ],

        'message_hint' => [
            'in_general' => 'Esta publicação irá para a discussão geral do beatmapset. Para modificar este beatmap, começa uma mensagem com uma hora (ex: 00:12:345).',
            'in_timeline' => 'Para modificar múltiplas marcas de tempo, publica várias vezes (uma publicação por marca de tempo).',
        ],

        'message_type' => [
            'disqualify' => 'Desqualificar',
            'hype' => 'Hype!',
            'mapper_note' => 'Nota',
            'nomination_reset' => 'Reiniciar Nomeação',
            'praise' => 'Glorificar',
            'problem' => 'Problema',
            'suggestion' => 'Sugestão',
        ],

        'mode' => [
            'events' => 'Historial',
            'general' => 'Geral :scope',
            'timeline' => 'Cronologia',
            'scopes' => [
                'general' => 'Esta dificultade',
                'generalAll' => 'Todas as dificuldades',
            ],
        ],

        'new' => [
            'timestamp' => 'Marca de tempo',
            'timestamp_missing' => 'faz ctrl-c no modo de edição e cola na tua mensagem para adicionares uma timestamp!',
            'title' => 'Nova Discussão',
        ],

        'show' => [
            'title' => ':title mapeado por :mapper',
        ],

        'sort' => [
            '_' => 'Ordenado por:',
            'created_at' => 'hora da criação',
            'timeline' => 'cronologia',
            'updated_at' => 'última actualização',
        ],

        'stats' => [
            'deleted' => 'Eliminado',
            'mapper_notes' => 'Notas',
            'mine' => 'Meu',
            'pending' => 'Pendente',
            'praises' => 'Glorificações',
            'resolved' => 'Resolvido',
            'total' => 'Todos',
        ],

        'status-messages' => [
            'approved' => 'Este beatmap foi aprovado a :date!',
            'graveyard' => "Este beatmap não é atualizado desde :date e provavelmente foi abandonado pelo criador...",
            'loved' => 'Este beatmap foi adicionado a loved a :date!',
            'ranked' => 'Este beatmap foi classificado como ranked a :date!',
            'wip' => 'Nota: Este beatmap está marcado como um trabalho em progresso pelo criador.',
        ],

    ],

    'hype' => [
        'button' => 'Faz Hype a este Beatmap!',
        'button_done' => 'Já está em Hype!',
        'confirm' => "Tens a certeza? Isto usará um dos teus :n restantes e não pode ser desfeito.",
        'explanation' => 'Dá hype neste beatmap para torná-lo mais visível para a nomeação e ranking!',
        'explanation_guest' => 'Regista-te e dá hype neste beatmap para torná-lo mais visível para a nomeação e ranking!',
        'new_time' => "Vais ter outro hype :new_time.",
        'remaining' => 'Tens :remaining hypes restantes.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Comboio do Hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Deixar Feedback',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Razão pela desqualificação?',
        'disqualified_at' => 'Desqualificado :time_ago (:reason).',
        'disqualified_no_reason' => 'nenhuma razão especificada',
        'disqualify' => 'Desqualificar',
        'incorrect_state' => 'Erro ao desempenhar essa acção, tenta recarregar a página.',
        'nominate' => 'Nomear',
        'nominate_confirm' => 'Nomear este beatmap?',
        'nominated_by' => 'nomeado por :users',
        'qualified' => 'Estima-se para ser ranked em :date, se não forem encontrados problemas.',
        'qualified_soon' => 'Estima-se para ser ranked em breve, se não forem encontrados problemas.',
        'required_text' => 'Nomeações: :current/:required',
        'reset_message_deleted' => 'apagado',
        'title' => 'Estado da nomeação',
        'unresolved_issues' => 'Existem problemas ainda não resolvidos que devem ser abordados primeiro.',

        'reset_at' => [
            'nomination_reset' => 'Processo de nomeação redefinido :time_ago por :user com um novo problema :discussion (:message).',
            'disqualify' => 'Desclassificado :time_ago por :user com um novo problema :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Tens a certeza? Postar um novo problema irá reiniciar o processo de nomeação.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'digita em palavras-chave...',
            'options' => 'Mais opções de pesquisa',
            'not-found' => 'nenhum resultado',
            'not-found-quote' => '... não, nada encontrado.',
            'filters' => [
                'general' => 'Geral',
                'mode' => 'Modo',
                'status' => 'Rank Status',
                'genre' => 'Género',
                'language' => 'Idioma',
                'extra' => 'extra',
                'rank' => 'Rank alcançado',
                'played' => 'Jogado',
            ],
            'sorting' => [
                'title' => 'título',
                'artist' => 'artista',
                'difficulty' => 'dificuldade',
                'updated' => 'atualizado',
                'ranked' => 'ranked',
                'rating' => 'classificação',
                'plays' => 'plays',
                'relevance' => 'relevância',
                'nominations' => 'nomeações',
            ],
        ],
        'mode' => 'Modo',
        'status' => 'Rank Status',
        'source' => 'de :source',
        'load-more' => 'Carregar mais...',
    ],
    'general' => [
        'recommended' => 'Dificuldade recomendada',
        'converts' => 'Inclui beatmaps convertidos',
    ],
    'mode' => [
        'any' => 'Qualquer',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Qualquer',
        'ranked-approved' => 'Classificado & Aprovado',
        'approved' => 'Aprovado',
        'qualified' => 'Qualificado',
        'loved' => 'Adorado',
        'faves' => 'Favoritos',
        'pending' => 'Pendente',
        'graveyard' => 'Cemitério',
        'my-maps' => 'Meus Mapas',
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
        'electronic' => 'Electrónica',
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
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'Inglês',
        'chinese' => 'Chinês',
        'french' => 'Francês',
        'german' => 'Alemão',
        'italian' => 'Italiano',
        'japanese' => 'Japonês',
        'korean' => 'Coreano',
        'spanish' => 'Espanhol',
        'swedish' => 'Sueco',
        'instrumental' => 'Instrumental',
        'other' => 'Outro',
    ],
    'played' => [
        'any' => 'Qualquer',
        'played' => 'Jogado',
        'unplayed' => 'Não Jogado',
    ],
    'extra' => [
        'video' => 'Possui Vídeo',
        'storyboard' => 'Possui Storyboard',
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
];
