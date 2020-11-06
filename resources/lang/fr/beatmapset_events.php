<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approuvé.',
        'discussion_delete' => 'Un modérateur a supprimé la discussion :discussion.',
        'discussion_lock' => 'La discussion pour cette beatmap a été désactivée. (:text)',
        'discussion_post_delete' => 'Un modérateur a supprimé le post de la discussion :discussion.',
        'discussion_post_restore' => 'Un modérateur a restauré le post de la discussion :discussion.',
        'discussion_restore' => 'Un modérateur a restauré la discussion :discussion.',
        'discussion_unlock' => 'La discussion pour cette beatmap a été activée.',
        'disqualify' => 'Disqualifié par :user. Raison: :discussion (:text).',
        'disqualify_legacy' => 'Disqualifié par :user. Raison: :text.',
        'genre_edit' => 'Genre changé de :old à :new.',
        'issue_reopen' => 'Le problème résolu :discussion a été rouvert.',
        'issue_resolve' => 'Le problème :discussion a été marqué comme résolu.',
        'kudosu_allow' => 'Le refus de Kudosu pour la discussion :discussion a été supprimé.',
        'kudosu_deny' => 'La discussion :discussion a été refusée pour le kudosu.',
        'kudosu_gain' => 'La discussion :discussion par :user a obtenu assez de votes pour le kudosu.',
        'kudosu_lost' => 'La discussion :discussion par :user a perdu ses votes et le kudosu accordé a été retiré.',
        'kudosu_recalculate' => 'La discussion :discussion a vu ses kudosu accordés recalculés.',
        'language_edit' => 'Langue passée de :old à :new.',
        'love' => 'Aimé par :user',
        'nominate' => 'Nominée par :user.',
        'nomination_reset' => 'Le nouveau problème :discussion a déclenché une réinitialisation du processus de nomination.',
        'qualify' => 'Cette beatmap a atteint le nombre requis de nominations et a été qualifiée.',
        'rank' => 'Classée.',
        'remove_from_loved' => '',
    ],

    'index' => [
        'title' => 'Événements du beatmapset',

        'form' => [
            'period' => 'Période',
            'types' => 'Types',
        ],
    ],

    'item' => [
        'content' => 'Contenu',
        'discussion_deleted' => '[supprimée]',
        'type' => 'Type',
    ],

    'type' => [
        'approve' => 'Approbation',
        'discussion_delete' => 'Suppression de la discussion',
        'discussion_post_delete' => 'Suppression de la réponse de discussion',
        'discussion_post_restore' => 'Restauration de réponse de discussion',
        'discussion_restore' => 'Restauration de la discussion',
        'disqualify' => 'Disqualification',
        'genre_edit' => 'Édition du genre',
        'issue_reopen' => 'Réouverture de la discussion',
        'issue_resolve' => 'Résolution de la discussion',
        'kudosu_allow' => 'Allocation de Kudosu',
        'kudosu_deny' => 'Déni de Kudosu',
        'kudosu_gain' => 'Gain de Kudosu',
        'kudosu_lost' => 'Perte de Kudosu',
        'kudosu_recalculate' => 'Recalcul du Kudosu',
        'language_edit' => 'Modifier la langue',
        'love' => 'Aimé',
        'nominate' => 'Nomination',
        'nomination_reset' => 'Réinitialisation de la nomination',
        'qualify' => 'Qualification',
        'rank' => 'Classement',
        'remove_from_loved' => '',
    ],
];
