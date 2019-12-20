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
    'event' => [
        'approve' => 'Aprovado.',
        'discussion_delete' => 'O moderador eliminou a discussão :discussion.',
        'discussion_lock' => 'A discussão para este beatmap foi desativada. (:text)',
        'discussion_post_delete' => 'O moderador eliminou uma publicação da discussão :discussion.',
        'discussion_post_restore' => 'O moderador restaurou uma publicação da discussão :discussion.',
        'discussion_restore' => 'O moderador restaurou a discussão :discussion.',
        'discussion_unlock' => 'A discussão para este beatmap foi ativada.',
        'disqualify' => 'Desqualificado por :user. Motivo: :discussion (:text).',
        'disqualify_legacy' => 'Desqualificado por :user. Motivo: :text.',
        'issue_reopen' => 'O problema resolvido :discussion foi reaberto.',
        'issue_resolve' => 'O problema :discussion foi marcado como resolvido.',
        'kudosu_allow' => 'A rejeição de Kudosu para a discussão :discussion foi removida.',
        'kudosu_deny' => 'A discussão :discussion foi rejeitada para kudosu.',
        'kudosu_gain' => 'A discussão :discussion por :user obteve votos suficientes para kudosu.',
        'kudosu_lost' => 'A discussão :discussion por :user perdeu votos e kudosu concedido foi removido.',
        'kudosu_recalculate' => 'A discussão :discussion teve o seu kudosu concedido recalculado.',
        'love' => 'Adorado por :user',
        'nominate' => 'Nomeado por :user.',
        'nomination_reset' => 'Um novo problema :discussion (:text) acionou um reinício de nomeação.',
        'qualify' => 'Este beatmap atingiu o número necessário de nomeações e foi qualificado.',
        'rank' => 'Classificado.',
    ],

    'index' => [
        'title' => 'Eventos do conjunto de beatmaps',

        'form' => [
            'period' => 'Período',
            'types' => 'Tipos',
        ],
    ],

    'item' => [
        'content' => 'Conteúdo',
        'discussion_deleted' => '[eliminado]',
        'type' => 'Tipo',
    ],

    'type' => [
        'approve' => 'Aprovação',
        'discussion_delete' => 'Eliminação da discussão',
        'discussion_post_delete' => 'Eliminação da resposta da discussão',
        'discussion_post_restore' => 'Restauração da resposta da discussão',
        'discussion_restore' => 'Restauração da discussão',
        'disqualify' => 'Desqualificação',
        'issue_reopen' => 'Reabertura da discussão',
        'issue_resolve' => 'Resolução da discussão',
        'kudosu_allow' => 'Pensão de kudosu',
        'kudosu_deny' => 'Rejeição de kudosu',
        'kudosu_gain' => 'Ganho de kudosu',
        'kudosu_lost' => 'Perda de kudosu',
        'kudosu_recalculate' => 'Recalculação de kudosu',
        'love' => 'Adorar',
        'nominate' => 'Nomeação',
        'nomination_reset' => 'Reiniciação da nomeação',
        'qualify' => 'Qualificação',
        'rank' => 'Classificação',
    ],
];
