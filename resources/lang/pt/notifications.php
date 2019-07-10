<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'all_read' => 'Todas as notificações foram lidas!',
    'mark_all_read' => 'Limpar tudo',
    'message_multi' => ':count_delimited nova atualização em ":title".|:count_delimited novas atualizações em ":title".',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Discussão do beatmap',
                'beatmapset_discussion_lock' => 'O beatmap ":title" foi bloqueado para discussão.',
                'beatmapset_discussion_post_new' => ':username publicou uma nova mensagem na discussão do beatmap ":title".',
                'beatmapset_discussion_unlock' => 'O beatmap ":title" foi desbloqueado para discussão.',
            ],

            'beatmapset_state' => [
                '_' => 'Estado do beatmap alterado',
                'beatmapset_disqualify' => 'O beatmap ":title" foi desqualificado por :username.',
                'beatmapset_love' => 'O beatmap ":title" foi promovido e também adorado por :username.',
                'beatmapset_nominate' => 'O beatmap ":title" foi nomeado por :username.',
                'beatmapset_qualify' => 'O beatmap ":title" obteve nomeações suficiente e portanto, entrou na fila para ser classificado.',
                'beatmapset_reset_nominations' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Tópico do fórum',

            'forum_topic_reply' => [
                '_' => 'Nova resposta do fórum',
                'forum_topic_reply' => ':username respondeu ao tópico do fórum ":title".',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Fórum de legado de mensagens privadas',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited mensagem não lida.|:count_delimited mensagens não lidas.',
            ],
        ],
    ],
];
