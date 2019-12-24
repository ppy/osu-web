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
        'discussion_delete' => 'Moderador excluiu a discussão :discussion.',
        'discussion_lock' => 'A discussão para este beatmap foi desabilitada. (:text)',
        'discussion_post_delete' => 'Um moderador excluiu a publicação da discussão :discussion.',
        'discussion_post_restore' => 'Um moderador restaurou a publicação da discussão :discussion.',
        'discussion_restore' => 'Moderador restaurou discussão :discussion.',
        'discussion_unlock' => 'A discussão para este beatmap foi habilitada.',
        'disqualify' => 'Desqualificado por :user. Motivo: :discussion (:text).',
        'disqualify_legacy' => 'Desqualificado por :user. Motivo: :text.',
        'issue_reopen' => 'Reaberto problema :discussion já resolvido.',
        'issue_resolve' => 'Problema :discussion marcado como resolvido.',
        'kudosu_allow' => 'Negação de kudosu na discussão :discussion foi removida.',
        'kudosu_deny' => 'Negado kudosu da discussão :discussion.',
        'kudosu_gain' => 'Discussão :discussion por :user obteve kudosu por votação.',
        'kudosu_lost' => 'Discussão :discussion por :user perdeu votos e kudosu obtido foi removido.',
        'kudosu_recalculate' => 'Discussão :discussion teve seu kudosu obtido recalculado.',
        'love' => 'Amado por :user',
        'nominate' => 'Nomeado por :user.',
        'nomination_reset' => 'Novo problema :discussion reiniciou a contagem de nomeação.',
        'qualify' => 'Este beatmap alcançou o número de nomeações necessárias e se tornou qualificado.',
        'rank' => 'Ranqueado.',
    ],

    'index' => [
        'title' => 'Eventos ocorridos no beatmap',

        'form' => [
            'period' => 'Período',
            'types' => 'Tipos',
        ],
    ],

    'item' => [
        'content' => 'Conteúdo',
        'discussion_deleted' => '[excluído]',
        'type' => 'Tipo',
    ],

    'type' => [
        'approve' => 'Aprovação',
        'discussion_delete' => 'Exclusão de Discussão',
        'discussion_post_delete' => 'Exclusão de respostas da discussão',
        'discussion_post_restore' => 'Restauração de respostas da discussão',
        'discussion_restore' => 'Restauração de discussão',
        'disqualify' => 'Desqualificação',
        'issue_reopen' => 'Reabrir discussão',
        'issue_resolve' => 'Resolver discussão',
        'kudosu_allow' => 'Abono de Kudosu',
        'kudosu_deny' => 'Negação de Kudosu',
        'kudosu_gain' => 'Ganho de Kudosu',
        'kudosu_lost' => 'Perda de Kudosu',
        'kudosu_recalculate' => 'Recalculação de Kudosu',
        'love' => 'Amar',
        'nominate' => 'Nomeação',
        'nomination_reset' => 'Redefinir Nomeação',
        'qualify' => 'Qualificações',
        'rank' => 'Classificação',
    ],
];
