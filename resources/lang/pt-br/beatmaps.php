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
            'error' => 'Falha ao salvar publicação',
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
        'deleted' => 'Excluída por :editor :delete_time',
        'deny_kudosu' => 'recusar kudosu',
        'edit' => 'editar',
        'edited' => 'Última edição por :editor :update_time',
        'message_placeholder' => 'Digite aqui para publicar',
        'message_type_select' => 'Selecione o tipo de comentário',
        'reply_placeholder' => 'Digite a sua resposta aqui',
        'require-login' => 'Por favor, inicie a sessão para publicar ou responder',
        'resolved' => 'Resolvido',
        'restore' => 'recuperar',
        'title' => 'Discussões',

        'collapse' => [
            'all-collapse' => 'Recolher todas',
            'all-expand' => 'Expandir todas',
        ],

        'empty' => [
            'empty' => 'Nenhuma discussão ainda!',
            'hidden' => 'Nenhuma discussão corresponde ao filtro selecionado.',
        ],

        'message_hint' => [
            'in_general' => 'Esta publicação irá para a discussão geral de beatmaps. Para modificar este beatmap, inicie a mensagem com o timestamp (ex: 00:12:345).',
            'in_timeline' => 'Para modificar vários timestamps, publique várias vezes (uma publicação por timestamp).',
        ],

        'message_type' => [
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Sugestão',
        ],

        'mode' => [
            'general' => 'Geral',
            'timeline' => 'Linha do tempo',
        ],

        'new' => [
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl-c no modo de edição e cole na sua mensagem para adicionar um timestamp!',
            'title' => 'Nova discussão',
        ],

        'show' => [
            'title' => ':title mapeado por :mapper',
        ],

        'stats' => [
            'deleted' => 'Excluídos',
            'mine' => 'Meus',
            'pending' => 'Pendentes',
            'praises' => 'Elogios',
            'resolved' => 'Resolvidos',
            'total' => 'Total',
        ],
    ],

    'nominations' => [
        'disqualifed-at' => 'desqualificado :time_ago (:reason).',
        'disqualifed_no_reason' => 'nenhuma razão especificada',
        'disqualification-prompt' => 'Motivo da desqualificação?',
        'disqualify' => 'Desqualificar',
        'incorrect-state' => 'Erro ao executar essa ação, tente atualizar a página.',
        'nominate' => 'Nomear',
        'nominate-confirm' => 'Nomear este beatmap?',
        'qualified' => 'Estimado para ser ranqueado em :date, caso nenhum problema for encontrado.',
        'qualified-soon' => 'Estimado para ser ranqueado em breve, caso nenhum problema for encontrado.',
        'required-text' => 'Nomeações: :current/:required',
        'title' => 'Estado da nomeação',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'digite palavras-chave...',
            'options' => 'Mais opções de busca',
            'not-found' => 'sem resultados',
            'not-found-quote' => '... não, nada encontrado.',
        ],
        'mode' => 'Modo',
        'status' => 'Estado de rank',
        'mapped-by' => 'mapeado por :mapper',
        'source' => 'de :source',
        'load-more' => 'Carregar mais...',
    ],
    'mode' => [
        'any' => 'Qualquer',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Qualquer',
        'ranked-approved' => 'Ranqueados e aprovados',
        'approved' => 'Aprovados',
        'loved' => 'Amados',
        'faves' => 'Favoritos',
        'modreqs' => 'Pedidos de mod',
        'pending' => 'Pendentes',
        'graveyard' => 'Cemitério',
        'my-maps' => 'Meus mapas',
    ],
    'genre' => [
        'any' => 'Qualquer',
        'unspecified' => 'Indefinido',
        'video-game' => 'Jogo',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Outros',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Eletrônica',
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
        'NM' => 'Sem mods',
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
    'instrumental' => 'Instrumental',
    'other' => 'Outros',
    ],
    'extra' => [
        'video' => 'Possui vídeo',
        'storyboard' => 'Possui storyboard',
    ],
    'rank' => [
        'any' => 'Qualquer',
        'XH' => 'SS Prateado',
        'X' => 'SS',
        'SH' => 'S Prateado',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
