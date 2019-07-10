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
                'beatmapset_discussion_lock' => 'A discussão do beatmap ":title" foi trancada.',
                'beatmapset_discussion_post_new' => ':username publicou uma nova mensagem na discussão do beatmap ":title".',
                'beatmapset_discussion_unlock' => 'A discussão do beatmap ":title" foi destrancada.',
            ],

            'beatmapset_state' => [
                '_' => 'Estado do beatmap alterado',
                'beatmapset_disqualify' => 'O beatmap ":title" foi desqualificado por :username.',
                'beatmapset_love' => 'O beatmap ":title" foi promovido para Loved por :username.',
                'beatmapset_nominate' => 'O beatmap ":title" foi nomeado por :username.',
                'beatmapset_qualify' => 'O beatmap ":title" recebeu indicações suficientes e, portanto, está na fila para se tornar ranqueado.',
                'beatmapset_reset_nominations' => 'Um problema publicado por :username reiniciou a nomeação do beatmap ":title" ',
            ],
        ],

        'forum_topic' => [
            '_' => 'Tópico do fórum',

            'forum_topic_reply' => [
                '_' => 'Nova resposta no fórum',
                'forum_topic_reply' => ':username respondeu ao tópico ":title" do fórum.',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Mensagens Privadas do Fórum Legado',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited Mensagem não lida.|:count_delimited Mensagens não lidas.',
            ],
        ],
    ],
];
