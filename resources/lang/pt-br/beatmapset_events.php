<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Aprovado.',
        'beatmap_owner_change' => 'Dono(a) da dificuldade :beatmap mudado(a) para :new_user.',
        'discussion_delete' => 'Moderador excluiu a discussão :discussion.',
        'discussion_lock' => 'A discussão para este beatmap foi desabilitada. (:text)',
        'discussion_post_delete' => 'Um moderador excluiu a publicação da discussão :discussion.',
        'discussion_post_restore' => 'Um moderador restaurou a publicação da discussão :discussion.',
        'discussion_restore' => 'Moderador restaurou discussão :discussion.',
        'discussion_unlock' => 'A discussão para este beatmap foi habilitada.',
        'disqualify' => 'Desqualificado por :user. Motivo: :discussion (:text).',
        'disqualify_legacy' => 'Desqualificado por :user. Motivo: :text.',
        'genre_edit' => 'Gênero alterado de :old para :new.',
        'issue_reopen' => 'Reaberto problema :discussion já resolvido.',
        'issue_resolve' => 'Problema :discussion marcado como resolvido.',
        'kudosu_allow' => 'Negação de kudosu na discussão :discussion foi removida.',
        'kudosu_deny' => 'Negado kudosu da discussão :discussion.',
        'kudosu_gain' => 'Discussão :discussion por :user obteve kudosu por votação.',
        'kudosu_lost' => 'Discussão :discussion por :user perdeu votos e kudosu obtido foi removido.',
        'kudosu_recalculate' => 'Discussão :discussion teve seu kudosu obtido recalculado.',
        'language_edit' => 'Língua alterada de :old para :new.',
        'love' => 'Loved por :user',
        'nominate' => 'Nomeado por :user.',
        'nominate_modes' => 'Nomeado por :user (:modes).',
        'nomination_reset' => 'Novo problema :discussion reiniciou a contagem de nomeação.',
        'nomination_reset_received' => 'Nomeação por :user foi redefinida por :source_user (:text)',
        'nomination_reset_received_profile' => 'A nomeação foi redefinida por :user (:text)',
        'qualify' => 'Este beatmap alcançou o número de nomeações necessárias e se tornou qualificado.',
        'rank' => 'Ranqueado.',
        'remove_from_loved' => 'Removido dos Loved por :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Marcação explícita removida',
            'to_1' => 'Marcado como explícito',
        ],
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
        'beatmap_owner_change' => 'Mudar dono(a) da dificuldade',
        'discussion_delete' => 'Exclusão de Discussão',
        'discussion_post_delete' => 'Exclusão de respostas da discussão',
        'discussion_post_restore' => 'Restauração de respostas da discussão',
        'discussion_restore' => 'Restauração de discussão',
        'disqualify' => 'Desqualificação',
        'genre_edit' => 'Edição de gênero',
        'issue_reopen' => 'Reabrir discussão',
        'issue_resolve' => 'Resolver discussão',
        'kudosu_allow' => 'Abono de Kudosu',
        'kudosu_deny' => 'Negação de Kudosu',
        'kudosu_gain' => 'Ganho de Kudosu',
        'kudosu_lost' => 'Perda de Kudosu',
        'kudosu_recalculate' => 'Recalculação de Kudosu',
        'language_edit' => 'Edição de língua',
        'love' => 'Love',
        'nominate' => 'Nomeação',
        'nomination_reset' => 'Redefinição de nomeação',
        'nomination_reset_received' => 'Redefinição de nomeação recebida',
        'nsfw_toggle' => 'Marcação explícita',
        'qualify' => 'Qualificações',
        'rank' => 'Classificação',
        'remove_from_loved' => 'Remoção de Loved',
    ],
];
