<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Aprovado.',
        'beatmap_owner_change' => 'Dono da dificuldade :beatmap mudado para :new_user.',
        'discussion_delete' => 'Moderador eliminou a discussão :discussion.',
        'discussion_lock' => 'A discussão para este beatmap foi desativada. (:text)',
        'discussion_post_delete' => 'Moderador eliminou uma publicação da discussão :discussion.',
        'discussion_post_restore' => 'Moderador restaurou uma publicação da discussão :discussion.',
        'discussion_restore' => 'Moderador restaurou a discussão :discussion.',
        'discussion_unlock' => 'A discussão para este beatmap foi ativada.',
        'disqualify' => 'Desqualificado por :user. Motivo: :discussion (:text).',
        'disqualify_legacy' => 'Desqualificado por :user. Motivo: :text.',
        'genre_edit' => 'Género alterado de :old para :new.',
        'issue_reopen' => 'Problema resolvido :discussion por :discussion_user reaberto por :user.',
        'issue_resolve' => 'Problema :discussion por :discussion_user marcado como resolvido por :user.',
        'kudosu_allow' => 'A rejeição de Kudosu para a discussão :discussion foi removida.',
        'kudosu_deny' => 'A discussão :discussion foi rejeitada para kudosu.',
        'kudosu_gain' => 'A discussão :discussion por :user obteve votos suficientes para kudosu.',
        'kudosu_lost' => 'A discussão :discussion por :user perdeu votos e kudosu concedido foi removido.',
        'kudosu_recalculate' => 'A discussão :discussion teve o seu kudosu concedido recalculado.',
        'language_edit' => 'Língua alterada de :old para :new.',
        'love' => 'Adorado por :user',
        'nominate' => 'Nomeado por :user.',
        'nominate_modes' => 'Nomeado por :user (:modes).',
        'nomination_reset' => 'Um novo problema :discussion (:text) acionou um reinício de nomeação.',
        'nomination_reset_received' => 'A nomeação de :user foi redefinida por :source_user (:text)',
        'nomination_reset_received_profile' => 'A nomeação foi redefinida por :user (:text)',
        'qualify' => 'Este beatmap atingiu o número necessário de nomeações e foi qualificado.',
        'rank' => 'Classificado.',
        'remove_from_loved' => 'Removido de Adorado por :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Marca explícita removida',
            'to_1' => 'Marcado como explícito',
        ],
    ],

    'index' => [
        'title' => 'Eventos de Beatmapset',

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
        'beatmap_owner_change' => 'Mudar dono da dificuldade',
        'discussion_delete' => 'Eliminação da discussão',
        'discussion_post_delete' => 'Eliminação da resposta da discussão',
        'discussion_post_restore' => 'Restauração da resposta da discussão',
        'discussion_restore' => 'Restauração da discussão',
        'disqualify' => 'Desqualificação',
        'genre_edit' => 'Editar género',
        'issue_reopen' => 'Reabertura da discussão',
        'issue_resolve' => 'Resolução da discussão',
        'kudosu_allow' => 'Pensão de kudosu',
        'kudosu_deny' => 'Rejeição de kudosu',
        'kudosu_gain' => 'Ganho de kudosu',
        'kudosu_lost' => 'Perda de kudosu',
        'kudosu_recalculate' => 'Recalculação de kudosu',
        'language_edit' => 'Editar língua',
        'love' => 'Adorar',
        'nominate' => 'Nomeação',
        'nomination_reset' => 'Reinicialização da nomeação',
        'nomination_reset_received' => 'Redefinição de nomeação recebida',
        'nsfw_toggle' => 'Marca explícita',
        'qualify' => 'Qualificação',
        'rank' => 'Classificação',
        'remove_from_loved' => 'Adorado removido',
    ],
];
