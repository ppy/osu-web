<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approuvé.',
        'beatmap_owner_change' => 'Propriétaire de la difficulté :beatmap remplacé par :new_user.',
        'discussion_delete' => 'Un modérateur a supprimé la discussion :discussion.',
        'discussion_lock' => 'La discussion pour cette beatmap a été désactivée. (:text)',
        'discussion_post_delete' => 'Un modérateur a supprimé le post de la discussion :discussion.',
        'discussion_post_restore' => 'Un modérateur a restauré le post de la discussion :discussion.',
        'discussion_restore' => 'Un modérateur a restauré la discussion :discussion.',
        'discussion_unlock' => 'La discussion pour cette beatmap a été activée.',
        'disqualify' => 'Disqualifié par :user. Raison: :discussion (:text).',
        'disqualify_legacy' => 'Disqualifié par :user. Raison: :text.',
        'genre_edit' => 'Genre changé de :old à :new.',
        'issue_reopen' => 'Le problème :discussion a été résolu par :discussion_user et rouvert par :user.',
        'issue_resolve' => 'Le problème :discussion écrit par :discussion_user a été marqué comme résolu par :user.',
        'kudosu_allow' => 'Le refus de Kudosu pour la discussion :discussion a été supprimé.',
        'kudosu_deny' => 'L\'attribution de kudosu pour la discussion :discussion a été refusée.',
        'kudosu_gain' => 'La discussion :discussion par :user a obtenu assez de votes pour obtenir un kudosu.',
        'kudosu_lost' => 'La discussion :discussion par :user a perdu ses votes et le kudosu accordé a été retiré.',
        'kudosu_recalculate' => 'La discussion :discussion a vu ses kudosu accordés recalculés.',
        'language_edit' => 'Langue passée de :old à :new.',
        'love' => 'Loved par :user.',
        'nominate' => 'Nominée par :user.',
        'nominate_modes' => 'Nominée par :user (:modes).',
        'nomination_reset' => 'Le nouveau problème :discussion (:text) a déclenché une réinitialisation de la nomination.',
        'nomination_reset_received' => 'La nomination de :user a été réinitialisée par :source_user (:text)',
        'nomination_reset_received_profile' => 'La nomination a été réinitialisée par :user (:text)',
        'qualify' => 'Cette beatmap a atteint le nombre requis de nominations et a été qualifiée.',
        'rank' => 'Classée.',
        'remove_from_loved' => 'Retirée de la catégorie Loved par :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'N\'est plus marquée comme explicite',
            'to_1' => 'Marquée comme explicite',
        ],
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
        'discussion_deleted' => '[deleted]',
        'type' => 'Type',
    ],

    'type' => [
        'approve' => 'Approbation',
        'beatmap_owner_change' => 'Changement du propriétaire de la difficulté',
        'discussion_delete' => 'Suppression de la discussion',
        'discussion_post_delete' => 'Suppression des réponses aux discussions',
        'discussion_post_restore' => 'Restauration des réponses aux discussions',
        'discussion_restore' => 'Restauration de la discussion',
        'disqualify' => 'Disqualification',
        'genre_edit' => 'Changement de genre',
        'issue_reopen' => 'Réouverture de la discussion',
        'issue_resolve' => 'Résolution de la discussion',
        'kudosu_allow' => 'Attribution de Kudosu',
        'kudosu_deny' => 'Refus de Kudosu',
        'kudosu_gain' => 'Gain de Kudosu',
        'kudosu_lost' => 'Perte de Kudosu',
        'kudosu_recalculate' => 'Recalcul de Kudosu',
        'language_edit' => 'Modification de la langue',
        'love' => 'Loved',
        'nominate' => 'Nomination',
        'nomination_reset' => 'Réinitialisation de la nomination',
        'nomination_reset_received' => 'La nomination a été réinitialisée',
        'nsfw_toggle' => 'Explicite',
        'qualify' => 'Qualification',
        'rank' => 'Classement',
        'remove_from_loved' => 'Retirée de la catégorie Loved',
    ],
];
