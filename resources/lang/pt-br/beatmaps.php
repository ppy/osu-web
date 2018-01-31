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
    'discussion-posts' => [
        'store' => [
            'error' => 'Falha ao salvar postagem',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Falha ao atualizar votos',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permitir kudosu',
        'delete' => 'excluir',
        'deleted' => 'Excluído por :editor às :delete_time.',
        'deny_kudosu' => 'negar kudosu',
        'edit' => 'editar',
        'edited' => 'Última vez editado por :editor às :update_time.',
        'kudosu_denied' => 'Impossibilitado de receber kudosu',
        'message_placeholder' => 'Digite aqui para postar',
        'message_placeholder_deleted_beatmap' => 'Essa dificuldade foi deletada e uma dicussão não poderá ser aberta.',
        'message_type_select' => 'Selecione o tipo de comentário',
        'reply_notice' => 'Pressione enter para responder.',
        'reply_placeholder' => 'Digite sua resposta aqui',
        'require-login' => 'Por favor, conecte-se para responder',
        'resolved' => 'Resolvido',
        'restore' => 'restaurar',
        'title' => 'Discussões',

        'collapse' => [
            'all-collapse' => 'Juntar',
            'all-expand' => 'Expandir',
        ],

        'empty' => [
            'empty' => 'Nenhuma discussão ainda!',
            'hidden' => 'Nenhuma discussão com o filtro selecionado.',
        ],

        'message_hint' => [
            'in_general' => 'Essa postagem vai para a discussão geral do mapa. Para fazer uma sugestão nesse mapa, inicie a mensagem com uma marcação de tempo (ex.: 00:12:345).',
            'in_timeline' => 'Para fazer várias sugestões ao mesmo tempo, poste várias marcações (uma postagem por marcação de tempo).',
        ],

        'message_type' => [
            'hype' => 'Hype!',
            'mapper_note' => 'Nota',
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Sugestão',
        ],

        'mode' => [
            'events' => 'Histórico',
            'general' => 'Geral',
            'general_all' => 'Geral (todas as dificuldades)',
            'timeline' => 'Linha do tempo',
        ],

        'new' => [
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl-c in edit mode and paste in your message to add a timestamp!',
            'title' => 'Nova discussão',
        ],

        'show' => [
            'title' => ':title mapeado por :mapper',
        ],

        'sort' => [
            '_' => 'Filtrar by:',
            'created_at' => 'data de criação',
            'timeline' => 'linha do tempo',
            'updated_at' => 'última atualização',
        ],

        'stats' => [
            'deleted' => 'Excluído',
            'mapper_notes' => 'Notas',
            'mine' => 'Meu',
            'pending' => 'Pendentes',
            'praises' => 'Elogios',
            'resolved' => 'Resolvidos',
            'total' => 'Tudo',
        ],

        'status-messages' => [
            'approved' => 'Esse mapa foi aprovado em :date!',
            'graveyard' => 'Esse mapa não foi atualizado desde :date e provavelmente já foi abandonado pelo seu criador...',
            'loved' => 'Esse mapa foi adicionado ao loved em :date!',
            'ranked' => 'Esse mapa foi ranqueado em :date!',
            'wip' => 'Nota: Esse mapa ainda não finalizado pelo seu criador.',
        ],

    ],

    'hype' => [
        'button' => 'Dar um Hype!',
        'button_done' => 'Já tem um Hype!',
        'confirm' => 'Você tem certeza? Isso irá consumir um dos seus :n hypes e não poderá ser desfeito.',
        'explanation' => 'Adicione um Hype nesse mapa e torne-o mais visível para que um Beatmap Nominator possa ranqueá-lo!',
        'explanation_guest' => 'Conecte-se e adicione um Hype nesse mapa e torne-o mais visível para que um Beatmap Nominator possa ranqueá-lo!',
        'new_time' => 'Você terá um novo hype em :new_time.',
        'remaining' => 'Você ainda tem :remaining hypes sobrando.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Trenzinho do Hype',
        'title' => 'Hype',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Motivo da desqualificação?',
        'disqualified_at' => 'Desqualificado :time_ago (:reason).',
        'disqualified_no_reason' => 'sem motivo específico',
        'disqualify' => 'Desqualificar',
        'incorrect_state' => 'Erro ao realizar essa ação, tente atualizar a página',
        'nominate' => 'Nomear',
        'nominate_confirm' => 'Nomear esse mapa?',
        'nominated_by' => 'nomeado por :users',
        'qualified' => 'Esse mapa será ranqueado em :date, caso nenhum problema seja encontrado.',
        'qualified_soon' => 'Estimado para ser ranqueado em breve, caso nenhum problema for encontrado.',
        'required_text' => 'Nomeações: :current/:required',
        'reset_at' => 'Nomeações reiniciadas :time_ago por causa de um novo problema :discussion.',
        'reset_confirm' => 'Você tem certeza? Postar um novo problema reiniciará as nomeações.',
        'title' => 'Estado de nomeação',
        'unresolved_issues' => 'Ainda há problemas não resolvidos que precisam de uma resposta.',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'digite palavra-chave...',
            'options' => 'Mais opções de busca',
            'not-found' => 'nenhum resultado',
            'not-found-quote' => '... não, nada encontrado.',
            'filters' => [
                'mode' => 'Modo',
                'status' => 'Estado de ranqueamento',
                'genre' => 'Gênero',
                'language' => 'Idioma',
                'extra' => 'extra',
                'rank' => 'Ranque conquistado',
            ],
        ],
        'mode' => 'Modo',
        'status' => 'Estado de ranqueamento',
        'mapped-by' => 'mapeado por :mapper',
        'source' => 'de :source',
        'load-more' => 'Carregar mais...',
    ],
    'mode' => [
        'any' => 'Todos',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Todos',
        'ranked-approved' => 'Ranqueado & Aprovado',
        'approved' => 'Aprovado',
        'qualified' => 'Qualificado',
        'loved' => 'Loved',
        'faves' => 'Favoritos',
        'pending' => 'Pendente',
        'graveyard' => 'Desatualizado',
        'my-maps' => 'Meus mapas',
    ],
    'genre' => [
        'any' => 'Todos',
        'unspecified' => 'Não específico',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Outro',
        'novelty' => 'Atual',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electrônica',
    ],
    'mods' => [
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'Sem modificações',
    ],
    'language' => [
        'any' => 'Todos',
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
    'extra' => [
        'video' => 'Possui vídeo',
        'storyboard' => 'Possui Storyboard',
    ],
    'rank' => [
        'any' => 'Todos',
        'XH' => 'Silver SS',
        'X' => 'SS',
        'SH' => 'Silver S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
